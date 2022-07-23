<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;
class PatientController extends Controller
{
    use GeneralTrait;
    public function index()
    {

        $Patients = Patient::all();

        return $this->returnData("Patients", $Patients,'Request Done');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $Patient = new Patient;
        $Patient->brief_history = $request->brief_history;
        $Patient->blood= $request->blood;
        $Patient->habit = $request->habit;
        $Patient->user_id = $request->user_id;
        $Patient->save();

        return $this->returnSuccesMessage('Patient Added.');
    }

    public function show($id)
    {
        $Patient = Patient::find($id);
        if(!empty($Patient))
        {
            return $this->returnData('Patient', $Patient,'Request Done');
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
            $Patient->brief_history = is_null($request->brief_history) ? $Patient->brief_history : $request->brief_history;
            $Patient->blood = is_null($request->blood) ? $Patient->blood : $request->blood;
            $Patient->habit = is_null($request->habit) ? $Patient->habit : $request->habit;
            $Patient->user_id = is_null($request->user_id) ? $Patient->user_id : $request->user_id;
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
