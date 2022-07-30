<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PatientController extends Controller
{
    use GeneralTrait;
    public function index()
    {

        $Patients = Patient::all();

        return $this->returnData( $Patients);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone'=> 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $Patient = new Patient;
        $Patient->name = $request->name;
        $Patient->address = $request->address;
        $Patient->phone = $request->phone;
        $Patient->gender = $request->gender;
        $Patient->brithDate =  new Carbon($request->birthDate);
        $Patient->briefHistory = $request->briefHistory;
        $Patient->blood= $request->blood;
        $Patient->habit = $request->habit;
        $Patient->foodAllergy = $request->foodAllergy;
        $Patient->drugAllergy = $request->drugAllergy;
        $Patient->save();

        return $this->returnSuccesMessage('Patient Added.');
    }

    public function show($id)
    {
        $Patient = Patient::find($id);
        if(!empty($Patient))
        {
            return $this->returnData($Patient);
        }
        else
        {
            return $this->returnError(404, 'Patient Not Found');
        }
    }

    public function update(Request $request, $id)
    {
        if (Patient::where('patient_id	', $id)->exists()) {
            $Patient = Patient::find($id);
            $Patient->name = is_null($request->name) ? $Patient->name :$request->name;
            $Patient->address = is_null($request->address) ? $Patient->address :$request->address;
            $Patient->phone = is_null($request->phone) ? $Patient->phone :$request->phone;
            $Patient->gender = is_null($request->gender) ? $Patient->gender :$request->gender;
            $Patient->brithDate = is_null($request->brithDate) ?  $Patient->brithDate :$request->brithDate;
            $Patient->briefHistory = is_null($request->briefHistory) ? $Patient->briefHistory : $request->briefHistory;
            $Patient->blood = is_null($request->blood) ? $Patient->blood : $request->blood;
            $Patient->habit = is_null($request->habit) ? $Patient->habit : $request->habit;
            $Patient->foodAllergy = is_null($request->foodAllergy) ? $Patient->foodAllergy : $request->foodAllergy;
            $Patient->drugAllergy = is_null($request->drugAllergy) ? $Patient->drugAllergy : $request->drugAllergy;
            $Patient->save();

            return $this-> returnSuccesMessage("Patient Updated.");
        }
        else{
            return $this->returnError(404,"Patient Not Found.");

        }
    }

    public function destroy($id)
    {
        if(Patient::where('patient_id', $id)->exists()) {
            $Patient = Patient::find($id);
            $Patient->delete();
            return $this->returnSuccesMessage("Records Deleted.");
        } else {
            return $this->returnError(404, "Patient Not Found.");
        }
    }
}
