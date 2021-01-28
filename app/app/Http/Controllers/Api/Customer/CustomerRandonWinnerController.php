<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Customer;


use Illuminate\Support\Facades\DB;

class CustomerRandonWinnerController extends ApiController
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        if (Customer::count() < 5){
            return $this->errorResponse("Se necesitan un minimo de 5 clientes registrados",500);    
        }


        $customer = Customer::all()->random(1)->first();

        DB::table('customers')            
            ->update(array('winner' => false));

        DB::table('customers')
            ->where('id', $customer->id)
            ->update(array('winner' => true));


        return $this->showOne($customer,200);
    }
}
