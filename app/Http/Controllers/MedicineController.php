<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
class MedicineController extends Controller
{
    use GeneralTrait;
    public function index()
    {

        $Medicines = Medicine::select('medic_id','name','caliber','type','manufactureCompany','composition','description')->get();

        return $this->returnData( $Medicines);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'caliber' => 'required',
            'type' => 'required',
            'manufactureCompany' => 'required',
            'composition' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }


        $Medicine = new Medicine;
        $Medicine->name = $request->name;
        $Medicine->caliber= $request->caliber;
        $Medicine->type = $request->type;
        $Medicine->manufactureCompany = $request->manufactureCompany;
        $Medicine->composition = $request->composition;
        $Medicine->description = is_null($request->description)? '' :$request->description;

        $Medicine->save();

        return $this->returnSuccesMessage('Medicine Added.');
    }

    public function show($id)
    {
        $Medicine = Medicine::find($id);
        if(!empty($Medicine))
        {
            return $this->returnData($Medicine);
        }
        else
        {
            return $this->returnError(404, 'Medicine not found');
        }
    }

    public function update(Request $request, $id)
    {
        if (Medicine::where('medic_id', $id)->exists()) {
            $Medicine = Medicine::find($id);
            $Medicine->name = is_null($request->name) ? $Medicine->name : $request->name;
            $Medicine->caliber= is_null($request->caliber) ? $Medicine->caliber : $request->caliber;
            $Medicine->type = is_null($request->type) ? $Medicine->type : $request->type;
            $Medicine->manufactureCompany = is_null($request->manufactureCompany) ? $Medicine->manufactureCompany : $request->manufactureCompany;
            $Medicine->composition= is_null($request->composition) ? $Medicine->composition : $request->composition;
            $Medicine->description = is_null($request->description) ? $Medicine->description : $request->description;
            $Medicine->save();

            return $this-> returnSuccesMessage("Medicine Updated.");
        }
        else{
            return $this->returnError(404,"Medicine Not Found.");

        }
    }

    public function destroy($id)
    {
        if(Medicine::where('medic_id', $id)->exists()) {
            $Clinic = Medicine::find($id);
            $Clinic->delete();
            return $this->returnSuccesMessage("records deleted.");
        } else {
            return $this->returnError(404, "Medicine not found.");
        }
    }
}
