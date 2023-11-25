<?php

namespace App\Http\Controllers;

use App\Models\Platoon;
use App\Http\Requests\StorePlatoonRequest;
use App\Http\Requests\UpdatePlatoonRequest;

class PlatoonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $platoon = Platoon::all();
        return view('pages.platoon', compact('platoon'));
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
    public function store(StorePlatoonRequest $request)
    {
        $platoon = Platoon::create([
            'name'=>$request->name,
            'functionality'=>$request->functionality,
            'unitCompany_id'=>$request->id,
        ]);
        return to_route('platoon.index')->with('message', 'Platoon added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Platoon $platoon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Platoon $platoon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlatoonRequest $request, Platoon $platoon)
    {
        $platoon->update($request->validated());
        return to_route('platoon.index')->with('message', 'Platoon edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Platoon $platoon)
    {
        $platoon->delete();
        return to_route('platoon.index')->with('message','Platoon deleted successfully');
    }
}
