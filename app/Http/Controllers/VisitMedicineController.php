<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
class VisitMedicineController extends Controller
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
