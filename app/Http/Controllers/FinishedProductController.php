<?php

namespace App\Http\Controllers;

use App\Models\FinishedProduct;
use App\Http\Requests\StoreFinishedProductRequest;
use App\Http\Requests\UpdateFinishedProductRequest;

class FinishedProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreFinishedProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFinishedProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FinishedProduct  $finishedProduct
     * @return \Illuminate\Http\Response
     */
    public function show(FinishedProduct $finishedProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FinishedProduct  $finishedProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(FinishedProduct $finishedProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFinishedProductRequest  $request
     * @param  \App\Models\FinishedProduct  $finishedProduct
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFinishedProductRequest $request, FinishedProduct $finishedProduct)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FinishedProduct  $finishedProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinishedProduct $finishedProduct)
    {
        //
    }
}
