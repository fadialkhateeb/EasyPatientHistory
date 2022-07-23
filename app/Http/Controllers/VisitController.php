<?php

namespace App\Http\Controllers;

use App\Models\Visit;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;

class VisitController extends Controller
{
    use GeneralTrait;
    public function index()
    {

        $Visits = Visit::all();

        return $this->returnData("Clinics", $Visits,'Request Done');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'visit_time' => 'required',
            'pat_id' => 'required',
            'doc_id' => 'required',
            'recep_id' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $Visit = new Visit;
        $Visit->visit_time = $request->visit_time;
        $Visit-> Description= $request->Description;
        $Visit->pat_id = $request->pat_id;
        $Visit->doc_id = $request->doc_id;
        $Visit->recep_id = $request->recep_id;
        $Visit->save();

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

    public function update(Request $request, $id)
    {
        if (Visit::where('visit_id', $id)->exists()) {
            $Visit = Visit::find($id);
            $Visit->visit_time = is_null($request->visit_time) ? $Visit->visit_time : $request->visit_time;
            $Visit->Description = is_null($request->Description) ? $Visit->Description : $request->Description;
            $Visit->pat_id = is_null($request->pat_id) ? $Visit->pat_id : $request->pat_id;
            $Visit->doc_id = is_null($request->doc_id) ? $Visit->doc_id : $request->doc_id;
            $Visit->recep_id = is_null($request->recep_id) ? $Visit->recep_id : $request->recep_id;
            $Visit->save();

            return $this-> returnSuccesMessage("Visit Updated.");
        }
        else{
            return $this->returnError(404,"Visit Not Found.");

        }
    }

    public function destroy($id)
    {
        if(Visit::where('cli_id', $id)->exists()) {
            $Visit = Visit::find($id);
            $Visit->delete();
            return $this->returnSuccesMessage("records deleted.");
        } else {
            return $this->returnError(404, "Visit not found.");
        }
    }
}
