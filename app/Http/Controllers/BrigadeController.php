<?php

namespace App\Http\Controllers;

use App\Models\Brigade;
use App\Http\Requests\StoreBrigadeRequest;
use App\Http\Requests\UpdateBrigadeRequest;

class BrigadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brigade = Brigade::all();
        return view('pages.brigade', compact('brigade'));
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
    public function store(StoreBrigadeRequest $request)
    {
        $brigade = Brigade::create([
            'name'=>$request->name,
            'city'=>$request->city,
            'location'=>$request->location,
            'militaryRegion_id'=>$request->id,
        ]);
        return redirect()->route('brigade.index')->with('message','Brigades added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brigade $brigade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brigade $brigade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrigadeRequest $request, Brigade $brigade)
    {
        $brigade->update($request->validated());
        return to_route('brigade.index')->with('message', 'Brigade edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brigade $brigade)
    {
        $brigade->delete();
        return to_route('brigade.index')->with('message', 'Brigade deleted successfully');
    }
}
