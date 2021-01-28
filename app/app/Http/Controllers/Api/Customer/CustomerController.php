<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $relationships = ['state','city'];

    public function index()
    {
        //

        $customers = Customer::all();

        $customers->load($this->relationships);

        return $this->showAll($customers,200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $rules = [
            'first_name'                => 'required|max:50',
            'last_name'                 => 'required|max:50',          
            'identification'            => 'required|integer|unique:customers,identification',
            'state_id'                  => 'required|integer|exists:states,id',
            'city_id'                   => 'required|integer|exists:cities,id',
            'phone'                     => 'required|unique:customers,phone',
            'mail'                      => 'required|email|unique:customers,mail',
            'habeas_data'               => 'required|bool'
        ];


        $this->validate($request, $rules);

        $customer = Customer::create($request->all());
        $customer->load($this->relationships);
        return $this->successResponse(['data' => $customer, 'message' => 'Customer is created'], 201);
        

        //return $this->successResponse(['message' => 'Customer is created'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
        $customer->load($this->relationships);
        return $this->showOne($customer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        //
        $rules = [
            'first_name'                => 'max:50',
            'last_name'                 => 'max:50',          
            'identification'            => 'integer|unique:customers,identification,' . $customer->id,
            'state_id'                  => 'integer|exists:states,id',
            'city_id'                   => 'integer|exists:cities,id',
            'phone'                     => 'unique:customers,phone,' . $customer->id,
            'mail'                      => 'email|unique:customers,mail,' . $customer->id,
            'habeas_data'               => 'bool'
        ];

        $this->validate($request, $rules);

        $customer->fill($request->all());
        
        $customer->save();
        $customer->load($this->relationships);

        return $this->successResponse(['data' => $customer, 'message' => 'Customer is updated'],201);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //

        $customer->delete();
        $customer->load($this->relationships);
        return $this->successResponse(['data' => $customer, 'message' => 'Customer is deleted'], 201);

    }
}
