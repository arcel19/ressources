<?php

namespace App\Http\Controllers;

use App\Models\NationalArmy;
use App\Http\Requests\StoreNationalArmyRequest;
use App\Http\Requests\UpdateNationalArmyRequest;

class NationalArmyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nationalArmy = NationalArmy::all();
        return view('pages.national-army', compact('nationalArmy'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNationalArmyRequest $request)
    {
        //
        $nationalArmy = NationalArmy::create([
            'name'=> $request->name,
        ]);
        return to_route('nationalArmy.index')->with('message', 'National Army added successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(NationalArmy $nationalArmy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NationalArmy $nationalArmy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNationalArmyRequest $request, NationalArmy $nationalArmy)
    {
        $nationalArmy->update($request->validated());

        return to_route('nationalArmy.index')->with('message', 'National army edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NationalArmy $nationalArmy)
    {
        $nationalArmy->delete();
        return to_route('nationalArmy.index')->with('message','national army deleted successfully');
    }
}
