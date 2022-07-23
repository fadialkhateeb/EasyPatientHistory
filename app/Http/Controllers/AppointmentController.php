<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;
class AppointmentController extends Controller
{
    use GeneralTrait;
    public function index()
    {

        $Appointments = Appointment::all();

        return $this->returnData("Appointments", $Appointments,'Request Done');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'appoint_time' => 'required',
            'recep_id' => 'required',
            'pat_id'=>'required',
            'doc_id'=>'required'

        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $Appointment = new Appointment;
        $Appointment->appoint_time = $request->appoint_time;
        $Appointment-> state= $request->state;
        $Appointment->description = $request->description;
        $Appointment->recep_id = $request->recep_id;
        $Appointment->pat_id = $request->pat_id;
        $Appointment->doc_id = $request->doc_id;

        $Appointment->save();

        return $this->returnSuccesMessage('Appointment Added.');
    }

    public function show($id)
    {
        $Appointment = Appointment::find($id);
        if(!empty($Appointment))
        {
            return $this->returnData('Appointment', $Appointment,'Request Done');
        }
        else
        {
            return $this->returnError(404, 'Appointment Not Found');
        }
    }

    public function update(Request $request, $id)
    {
        if (Appointment::where('appoint_id', $id)->exists()) {
            $Appointment = Appointment::find($id);
            $Appointment->appoint_time = is_null($request->appoint_time) ? $Appointment->appoint_time : $request->appoint_time;
            $Appointment->state = is_null($request->state) ? $Appointment->state : $request->state;
            $Appointment->description = is_null($request->description) ? $Appointment->description : $request->description;
            $Appointment->recep_id = is_null($request->recep_id) ? $Appointment->recep_id : $request->recep_id;
            $Appointment->pat_id = is_null($request->pat_id) ? $Appointment->pat_id : $request->pat_id;
            $Appointment->doc_id = is_null($request->doc_id) ? $Appointment->doc_id : $request->doc_id;
            $Appointment->save();

            return $this-> returnSuccesMessage("Appointment Updated.");
        }
        else{
            return $this->returnError(404,"Appointment Not Found.");

        }
    }

    public function destroy($id)
    {
        if(Appointment::where('appoint_id', $id)->exists()) {
            $Clinic = Appointment::find($id);
            $Clinic->delete();
            return $this->returnSuccesMessage("Records Deleted.");
        } else {
            return $this->returnError(404, "Appointment Not Found.");
        }
    }
}
