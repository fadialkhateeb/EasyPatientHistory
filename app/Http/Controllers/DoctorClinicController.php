<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\clinicDoctor;
use Illuminate\Support\Facades\Validator;
class DoctorClinicController extends Controller
{
    public function index()
    {
        $DoctorsClinic = clinicDoctor::all();
        return response()->json($DoctorsClinic);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'doc_id' => 'required',
            'clinic_id' => 'required',

        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $DoctorClinic = new clinicDoctor;
        $DoctorClinic->clinic_id = $request->clinic_id;
        $DoctorClinic->doc_id= $request->doc_id;
        $DoctorClinic->work_hours = $request->work_hours;


        $DoctorClinic->save();

        return response()->json([
            "message" => "Doctor Added to clinic"
        ], 201);
    }

}
