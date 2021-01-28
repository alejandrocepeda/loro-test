<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificationWinner;

use App\Customer;
use Illuminate\Support\Facades\DB;

class SendNotificationWinnerController extends ApiController
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
        

        try {
            $customerWinner = Customer::where('winner', true)->first();

            if (empty($customerWinner)){
                return $this->errorResponse(['message' => 'No existen ganadores en la base de datos'], 500);
            }

            $fullName = "$customerWinner->first_name $customerWinner->last_name";

            $data = ['message' => 'Usted fue el ganador del concurso de la marca Loro.','name' => $fullName];

            Mail::to($customerWinner->mail)->send(new NotificationWinner($data));

            DB::table('customers')
                ->where('id', $customerWinner->id)
                ->update(array('notification_success' => true));

            return $this->successResponse(['data' => $customerWinner,'message' => 'It was sent successfully'],200);
        }
        catch (Exception $e) {

            return $this->errorResponse(['message' => $e->getMessage()], 500);
        }
        
    }
}
