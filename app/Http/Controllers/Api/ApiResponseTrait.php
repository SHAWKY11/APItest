<?php
namespace App\Http\Controllers\Api;

trait ApiResponseTrait
{
    public function apiResponse($data=null,$msg=null,$status=null){
           $array=[
            'Data'=>$data,
            'message'=>$msg,
            'status'=>$status
        ];
        
        return response($array,$status);
    }
}