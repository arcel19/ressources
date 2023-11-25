<?php

namespace App\Http\Controllers;

use App\Models\Squadron;
use App\Http\Requests\StoreSquadronRequest;
use App\Http\Requests\UpdateSquadronRequest;

class SquadronController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function index()
    {
        $squadron = Squadron::all();
        return view('pages.squadron',compact('squadron'));
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
    public function store(StoreSquadronRequest $request)
    {
        $squadron = Squadron::create([
            'name'=>$request->name,
            'functionality'=>$request->functionality,
            'platoon_id'=>$request->id,
        ]);
        return to_route('squadron.index')->with('message', 'Squadron added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Squadron $squadron)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Squadron $squadron)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSquadronRequest $request, Squadron $squadron)
    {
        $squadron->update($request->validated());
        return to_route('squadron.index')->with('message', 'Squadron edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Squadron $squadron)
    {
        $squadron->delete();
        return to_route('squadron.index')->with('message', 'squadron deleted successfully');
    }
}
