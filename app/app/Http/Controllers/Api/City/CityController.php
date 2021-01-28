<?php

namespace App\Http\Controllers\Api\City;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\City;

class CityController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $relationships = ['state'];

    public function index()
    {
        //

        $cities = City::all();
        $cities->load($this->relationships);

        return $this->showAll($cities,200);
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
        //
        
        $rules = [
            'name'          => 'required|max:50|min:3|unique:cities,name',
            'state_id'      => 'required|integer|exists:states,id',
        ];

        $this->validate($request, $rules);

        $city = City::create($request->all());
        $city->load($this->relationships);
        
        return $this->successResponse(['message' => 'City is created'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
        $city->load($this->relationships);
        return $this->showOne($city);
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
    public function update(Request $request, City $city)
    {
        //
        
        $rules = [
            'name'          => 'max:50|min:3|unique:cities,name,' . $city->id,
            'state_id'      => 'integer|exists:states,id',
        ];

        $this->validate($request, $rules);

        

        $city->fill($request->all());

        $city->save();
        $city->load($this->relationships);

        return $this->successResponse(['data' => $city, 'message' => 'City is updated'], 201);
        

        //return $this->successResponse(['message' => 'City is updated'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
        $city->delete();
        $city->load($this->relationships);
        return $this->successResponse(['data' => $city, 'message' => 'City is deleted'], 201);
    }
}
