<?php

namespace App\Http\Controllers;

use App\Models\clinicDoctor;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class DoctorController extends Controller
{
    public function index()
    {
        $Doctors = Doctor::all();
        return response()->json($Doctors);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'spec_id' => 'required',

        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $Doctor = new Doctor;
        $Doctor->user_id = $request->user_id;
        $Doctor-> Description= $request->Description;
        $Doctor->specialty_id = $request->spec_id;


        $Doctor->save();

        return response()->json([
            "message" => "Doctor Added."
        ], 201);
    }

    public function show($id)
    {
        $Doctor = Doctor::find($id);
        if(!empty($Doctor))
        {
            return response()->json($Doctor);
        }
        else
        {
            return response()->json([
                "message" => "Doctor not found"
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        if (Doctor::where('cli_id', $id)->exists()) {
            $Doctor = Doctor::find($id);
            $Doctor->cli_name = is_null($request->cli_name) ? $Doctor->cli_name : $request->cli_name;
            $Doctor->cli_address = is_null($request->cli_address) ? $Doctor->cli_address : $request->cli_address;
            $Doctor->cli_PhoneNo = is_null($request->cli_PhoneNo) ? $Doctor->cli_PhoneNo : $request->cli_PhoneNo;
            $Doctor->save();
            return response()->json([
                "message" => "Doctor Updated."
            ], 404);
        }else{
            return response()->json([
                "message" => "Doctor Not Found."
            ], 404);
        }
    }

    public function destroy($id)
    {
        if(Doctor::where('cli_id', $id)->exists()) {
            $Doctor = Doctor::find($id);
            $Doctor->delete();

            return response()->json([
              "message" => "records deleted."
            ], 202);
        } else {
            return response()->json([
              "message" => "Doctor not found."
            ], 404);
        }
    }
}
