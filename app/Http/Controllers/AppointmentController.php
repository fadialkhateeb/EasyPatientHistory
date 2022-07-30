<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Appointment;
use App\Models\Patient;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;
class AppointmentController extends Controller
{
    use GeneralTrait;
    public function index()
    {
        $Appointments = Appointment::with('patient')->get();

        return $this->returnData( $Appointments);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'time' => 'required',
            'recep_id' => 'required',
            'pat_id'=>'required'

        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $Appointment = new Appointment;
        $Appointment->time = new Carbon($request->time);
        $Appointment->description = $request->description;
        $Appointment->recep_id = $request->recep_id;
        $Appointment->pat_id = $request->pat_id;
        $Appointment->save();

        return $this->returnSuccesMessage('Appointment Added.');
    }

    public function show($id)
    {
        $Appointment = Appointment::find($id);
        if(!empty($Appointment))
        {
            return $this->returnData( $Appointment);
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
            $Appointment->time = new Carbon(is_null($request->time) ? $Appointment->time : $request->time);
            $Appointment->description = is_null($request->description) ? $Appointment->description : $request->description;
            $Appointment->recep_id = is_null($request->recep_id) ? $Appointment->recep_id : $request->recep_id;
            $Appointment->pat_id = is_null($request->pat_id) ? $Appointment->pat_id : $request->pat_id;
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
            $Appointment = Appointment::find($id);
            $Appointment->delete();
            return $this->returnSuccesMessage("Records Deleted.");
        } else {
            return $this->returnError(404, "Appointment Not Found.");
        }
    }
}
