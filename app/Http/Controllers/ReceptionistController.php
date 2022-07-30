<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Receptionist;
use Illuminate\Support\Facades\Validator;
class ReceptionistController extends Controller
{
    use GeneralTrait;
    public function index()
    {

        $Receptionists = Receptionist::all();

        return $this->returnData("Receptionists", $Receptionists,'Request Done');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',

        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $Receptionist = new Receptionist;
        $Receptionist->qualification = $request->qualification;
        $Receptionist-> user_id= $request->user_id;
        $Receptionist->doc_id = $request->doc_id;

        $Receptionist->save();

        return $this->returnSuccesMessage('Receptionist Added.');
    }

    public function show($id)
    {
        $Receptionist = Receptionist::find($id);
        if(!empty($Receptionist))
        {
            return $this->returnData('Receptionist', $Receptionist,'Request Done');
        }
        else
        {
            return $this->returnError(404, 'Receptionist not found');
        }
    }

    public function update(Request $request, $id)
    {
        if (Receptionist::where('recep_id', $id)->exists()) {
            $Receptionist = Receptionist::find($id);
            $Receptionist->qualification = is_null($request->qualification) ? $Receptionist->qualification : $request->qualification;
            $Receptionist->user_id = is_null($request->user_id) ? $Receptionist->user_id : $request->user_id;
            $Receptionist->doc_id = is_null($request->doc_id) ? $Receptionist->doc_id : $request->doc_id;
            $Receptionist->save();

            return $this-> returnSuccesMessage("Receptionist Updated.");
        }
        else{
            return $this->returnError(404,"Receptionist Not Found.");

        }
    }

    public function destroy($id)
    {
        if(Receptionist::where('recep_id', $id)->exists()) {
            $Receptionist = Receptionist::find($id);
            $Receptionist->delete();
            return $this->returnSuccesMessage("records deleted.");
        } else {
            return $this->returnError(404, "Receptionist not found.");
        }
    }
}
