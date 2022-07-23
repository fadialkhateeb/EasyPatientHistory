<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialty;
use Illuminate\Support\Facades\Validator;
class SpecialtyController extends Controller
{
    public function index()
    {
        $Specialties = Specialty::all();
        return response()->json($Specialties);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Spec_name' => 'required|string|min:2|max:100',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $Specialty = new Specialty;
        $Specialty->Spec_name = $request->Spec_name;
        $Specialty->save();
        return response()->json([
            "message" => "Doctor Specialty Added."
        ], 201);
    }

    public function show($id)
    {
        $Specialty = Specialty::find($id);
        if(!empty($Specialty))
        {
            return response()->json($Specialty);
        }
        else
        {
            return response()->json([
                "message" => "Doctor Specialty not found"
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        if (Specialty::where('Spec_id', $id)->exists()) {
            $Specialty = Specialty::find($id);
            $Specialty->Spec_name = is_null($request->Spec_name) ? $Specialty->Spec_name : $request->Spec_name;

            $Specialty->save();
            return response()->json([
                "message" => "Doctor Specialty Updated."
            ], 404);
        }else{
            return response()->json([
                "message" => "Doctor Specialty Not Found."
            ], 404);
        }
    }

    public function destroy($id)
    {
        if(Specialty::where('Spec_id', $id)->exists()) {
            $Doctor = Specialty::find($id);
            $Doctor->delete();

            return response()->json([
              "message" => "records deleted."
            ], 202);
        } else {
            return response()->json([
              "message" => "Doctor Specialty not found."
            ], 404);
        }
    }
}
