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

        $Medicines = Medicine::all();

        return $this->returnData("Medicines", $Medicines,'Request Done');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'caliber' => 'required',
            'Type' => 'required',
            'manufacture_company' => 'required',
            'Composition' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }


        $Medicine = new Medicine;
        $Medicine->name = $request->name;
        $Medicine->caliber= $request->caliber;
        $Medicine->Type = $request->Type;
        $Medicine->manufacture_company = $request->manufacture_company;
        $Medicine->Composition = $request->Composition;

        $Medicine->save();

        return $this->returnSuccesMessage('Medicine Added.');
    }

    public function show($id)
    {
        $Medicine = Medicine::find($id);
        if(!empty($Medicine))
        {
            return $this->returnData('Medicine', $Medicine,'Request Done');
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
            $Medicine->Type = is_null($request->Type) ? $Medicine->Type : $request->Type;
            $Medicine->manufacture_company = is_null($request->manufacture_company) ? $Medicine->manufacture_company : $request->manufacture_company;
            $Medicine->Composition= is_null($request->Composition) ? $Medicine->Composition : $request->Composition;
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
