<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use App\Models\VisitDiagnosises;
use App\Models\VisitMedicines;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;

class VisitController extends Controller
{
    use GeneralTrait;
    public function index()
    {

        $Visits = Visit::all();

        return $this->returnData( $Visits);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'time' => 'required',
            'pat_id' => 'required',

        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $Visit = new Visit;
        $Visit->time = $request->time;
        $Visit->description= $request->description;
        $Visit->pat_id = $request->pat_id;

        if($Visit->save())
        {

            if($request->diagn_id)
            {
            $VisitDiagn = new VisitDiagnosises;
            $VisitDiagn->visit_id= $Visit->visit_id;
            $VisitDiagn->diagn_id = $request->diagn_id;
            $VisitDiagn->save();
            }
            if($request->medic_id)
            {
            $VisitMedic = new VisitMedicines;
            $VisitMedic->visit_id=$Visit->visit_id;
            $VisitMedic->medic_id = $request->medic_id;
            $VisitMedic->save();
            }
        }

        return $this->returnSuccesMessage('Visit Added.');
    }

    public function show($id)
    {
        $Visit = Visit::find($id);
        if(!empty($Visit))
        {
            return $this->returnData('Visit', $Visit,'Request Done');
        }
        else
        {
            return $this->returnError(404, 'Visit not found');
        }
    }

    public function getPatientVisit($patientId)
    {
        $Visit = Visit::where('pat_id',$patientId)->first();
        if(!empty($Visit))
        {
            return $this->returnData($Visit);
        }
        else
        {
            return $this->returnError(404, 'Visit not found');
        }
    }

    public function update(Request $request, $id)
    {
        if (Visit::where('visit_id', $id)->exists()) {
            $Visit = Visit::find($id);
            $Visit->time = is_null($request->time) ? $Visit->time : $request->time;
            $Visit->description = is_null($request->description) ? $Visit->description : $request->description;
            $Visit->pat_id = is_null($request->pat_id) ? $Visit->pat_id : $request->pat_id;
            $Visit->save();

            return $this-> returnSuccesMessage("Visit Updated.");
        }
        else{
            return $this->returnError(404,"Visit Not Found.");

        }
    }

}
