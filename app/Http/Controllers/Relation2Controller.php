<?php

namespace App\Http\Controllers;

use App\Relation2;
use Illuminate\Http\Request;

class Relation2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('relation.ekip');
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Relation2  $relation2
     * @return \Illuminate\Http\Response
     */
    public function show(Relation2 $relation2)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Relation2  $relation2
     * @return \Illuminate\Http\Response
     */
    public function edit(Relation2 $relation2)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Relation2  $relation2
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Relation2 $relation2)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Relation2  $relation2
     * @return \Illuminate\Http\Response
     */
    public function destroy(Relation2 $relation2)
    {
        //
    }
}
