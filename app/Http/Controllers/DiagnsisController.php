<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Diagnsis;
use Illuminate\Support\Facades\Validator;
class DiagnsisController extends Controller
{
    use GeneralTrait;

    public function index()
    {

        $Diagnsises = Diagnsis::all();

        return $this->returnData($Diagnsises);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $Diagnsis = new Diagnsis;
        $Diagnsis->name = $request->name;
        $Diagnsis->description = $request->description;

        $Diagnsis->save();

        return $this->returnSuccesMessage('Diagnsis Added.');
    }

    public function show($id)
    {
        $Diagnsis = Diagnsis::find($id);
        if(!empty($Diagnsis))
        {
            return $this->returnData('Diagnsis', $Diagnsis,'Request Done');
        }
        else
        {
            return $this->returnError(404, 'Diagnsis Not Found');
        }
    }

    public function update(Request $request, $id)
    {
        if (Diagnsis::where('diagn_id', $id)->exists()) {
            $Diagnsis = Diagnsis::find($id);
            $Diagnsis->name = is_null($request->name) ? $Diagnsis->name : $request->name;
            $Diagnsis->description = is_null($request->description) ? $Diagnsis->description : $request->description;
            $Diagnsis->save();

            return $this-> returnSuccesMessage("Diagnsis Updated.");
        }
        else{
            return $this->returnError(404,"Diagnsis Not Found.");

        }
    }

    public function destroy($id)
    {
        if(Diagnsis::where('diagn_id', $id)->exists()) {
            $Diagnsis = Diagnsis::find($id);
            $Diagnsis->delete();
            return $this->returnSuccesMessage("Records Deleted.");
        } else {
            return $this->returnError(404, "Diagnsis Not Found.");
        }
    }

}
