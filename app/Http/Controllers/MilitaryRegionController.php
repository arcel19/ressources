<?php

namespace App\Http\Controllers;

use App\Models\MilitaryRegion;
use App\Http\Requests\StoreMilitaryRegionRequest;
use App\Http\Requests\UpdateMilitaryRegionRequest;

class MilitaryRegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $militaryRegion = MilitaryRegion::all();
        return view('pages.military-region', compact('militaryRegion'));
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
    public function store(StoreMilitaryRegionRequest $request)
    {
// dd($request->all());

        $militaryRegion = MilitaryRegion::create([
            'name'=>$request->name,
            'city'=>$request->city,
            'location'=>$request->location,
            'nationalArmy_id'=>$request->id,
        ]);


        return to_route('militaryRegion.index')->with('message','military region added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(MilitaryRegion $militaryRegion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MilitaryRegion $militaryRegion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMilitaryRegionRequest $request, MilitaryRegion $militaryRegion)
    {

        $militaryRegion->update($request->validated());
        return to_route('militaryRegion.index')->with('message', 'military region edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MilitaryRegion $militaryRegion)
    {
        //
        $militaryRegion->delete();
        return to_route('militaryRegion.index')->with('message', 'military region deleted successfully');
    }
}
