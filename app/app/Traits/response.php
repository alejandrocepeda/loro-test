<?php

namespace App\Traits;

trait response {

    protected function errorResponse($mesaage,$code){
        return response()->json(['error' => $mesaage,'code' => $code],$code);
    }
    
    protected function successResponse($data,$code){
        return response()->json($data,$code);
    }

    public function showOne($model,$code = 200){
        return $this->successResponse($model,$code);
    }

    protected function showAll($collection,$code = 200){
    
        return $this->successResponse($collection, $code);  
    }
}
