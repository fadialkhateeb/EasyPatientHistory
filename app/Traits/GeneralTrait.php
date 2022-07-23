<?php
namespace app\Traits;
use Illuminate\Http\Request;

trait GeneralTrait
{
    public function returnError($errnum, $msg)
    {
        return response()->json([
            'status' => false,
            'errNum' => $errnum,
            'message' =>$msg
            ]);
    }

    public function returnSuccesMessage($msg = " ", $errnum = "0")
    {
        return ['status' => true,'errNum' =>$errnum, 'message' => $msg];
    }

    public function returnData($KEY, $value,$msg =" ")
    {
        return response()->json([
            'status' => true,
            'errNum' => "S000",
            'msg' => $msg,
            $KEY => $value
            ]);
    }



}
