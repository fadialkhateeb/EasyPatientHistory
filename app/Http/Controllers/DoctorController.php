<?php

namespace App\Http\Controllers;

use App\Models\clinicDoctor;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Traits\GeneralTrait;
class DoctorController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        $Doctors = Doctor::all();
        return $this->returnData( $Doctors);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',


        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $Doctor = new Doctor;
        $Doctor->user_id = $request->user_id;
        $Doctor-> description= $request->description;
        $Doctor->specialtyName = $request->specialtyName;
        $Doctor->clinicName = $request->clinicName;
        $Doctor->clinicAddress = $request->clinicAddress;
        $Doctor->clinicPhone = $request->clinicPhone;
        $Doctor->save();

        return $this->returnSuccesMessage('Doctor Added..');
    }

    public function show($id)
    {
        $Doctor = Doctor::find($id);
        if(!empty($Doctor))
        {
            return $this->returnData($Doctor);
        }
        else
        {
            return $this->returnError(404, 'Doctor not found');
        }
    }

    public function update(Request $request, $id)
    {
        if (Doctor::where('doc_id', $id)->exists()) {
            $Doctor = Doctor::find($id);
            $Doctor-> user_id= is_null($request->user_id) ? $Doctor->user_id : $request->user_id;
            $Doctor-> description= is_null($request->description) ? $Doctor->description : $request->description;
            $Doctor->specialtyName = is_null($request->specialtyName) ? $Doctor->specialtyName : $request->specialtyName;
            $Doctor-> clinicName= is_null($request->clinicName) ? $Doctor->clinicName : $request->clinicName;
            $Doctor-> clinicAddress= is_null($request->clinicAddress) ? $Doctor->clinicAddress : $request->clinicAddress;
            $Doctor-> clinicPhone= is_null($request->clinicPhone) ? $Doctor->clinicPhone : $request->clinicPhone;
            $Doctor->save();

            return $this-> returnSuccesMessage("Doctor Updated.");
        }
        else{
            return $this->returnError(404,"Doctor Not Found.");
    }
}

    public function destroy($id)
    {
        if(Doctor::where('doc_id', $id)->exists()) {
            $Doctor = Doctor::find($id);
            $Doctor->delete();

            return $this->returnSuccesMessage("records deleted.");
        } else {
            return $this->returnError(404, "Doctor not found.");
        }
        }
    }

