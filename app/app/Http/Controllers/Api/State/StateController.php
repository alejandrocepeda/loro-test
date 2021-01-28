<?php

namespace App\Http\Controllers\Api\State;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\State;

class StateController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $states = State::all();
        return $this->showAll($states,200);
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
            'name' => 'required|max:50|min:3|unique:states,name'
        ];

        $this->validate($request, $rules);

        $city = State::create($request->all());
        
        return $this->successResponse(['message' => 'State is created'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(State $state)
    {
        //
        return $this->showOne($state);
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
    public function update(Request $request, State $state)
    {
        //
        $rules = [
            'name'  => 'max:50|min:3|unique:states,name,' . $state->id
        ];

        $this->validate($request, $rules);

        $state->fill($request->all());

        $state->save();

        return $this->successResponse(['data' => $state, 'message' => 'State is updated'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        //
        $state->delete();
        return $this->successResponse(['data' => $state, 'message' => 'State is deleted'], 201);
    }
}
