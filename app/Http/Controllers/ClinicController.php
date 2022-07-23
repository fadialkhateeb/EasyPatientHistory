<?php

namespace App\Http\Controllers;

use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
class ClinicController extends Controller
{
    use GeneralTrait;
    public function index()
    {

        $Clinics = Clinic::all();

        return $this->returnData("Clinics", $Clinics,'Request Done');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cli_name' => 'required|string|min:2|max:100',
            'cli_address' => 'required|string|max:100',
            'cli_PhoneNo' => 'required',

        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $Clinic = new Clinic;
        $Clinic->cli_name = $request->cli_name;
        $Clinic-> cli_address= $request->cli_address;
        $Clinic->cli_PhoneNo = $request->cli_PhoneNo;
        $Clinic->save();

        return $this->returnSuccesMessage('Clinic Added.');
    }

    public function show($id)
    {
        $Clinic = Clinic::find($id);
        if(!empty($Clinic))
        {
            return $this->returnData('Clinic', $Clinic,'Request Done');
        }
        else
        {
            return $this->returnError(404, 'clinic not found');
        }
    }

    public function update(Request $request, $id)
    {
        if (Clinic::where('cli_id', $id)->exists()) {
            $Clinic = Clinic::find($id);
            $Clinic->cli_name = is_null($request->cli_name) ? $Clinic->cli_name : $request->cli_name;
            $Clinic->cli_address = is_null($request->cli_address) ? $Clinic->cli_address : $request->cli_address;
            $Clinic->cli_PhoneNo = is_null($request->cli_PhoneNo) ? $Clinic->cli_PhoneNo : $request->cli_PhoneNo;
            $Clinic->save();

            return $this-> returnSuccesMessage("Clinic Updated.");
        }
        else{
            return $this->returnError(404,"Clinic Not Found.");

        }
    }

    public function destroy($id)
    {
        if(Clinic::where('cli_id', $id)->exists()) {
            $Clinic = Clinic::find($id);
            $Clinic->delete();
            return $this->returnSuccesMessage("records deleted.");
        } else {
            return $this->returnError(404, "Clinic not found.");
        }
    }
}

