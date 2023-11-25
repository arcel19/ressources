<?php

namespace App\Http\Controllers;

use App\Models\UnitCompany;
use App\Http\Requests\StoreUnitCompanyRequest;
use App\Http\Requests\UpdateUnitCompanyRequest;

class UnitCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = ['search' => request('search')];
        $unitCompany = UnitCompany::latest()->filter($filters)->get();
        return view('pages.unit-company', compact('unitCompany'));
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
    public function store(StoreUnitCompanyRequest $request)
    {
        $unitCompany = UnitCompany::create([
            'name'=>$request->name,
            'city'=>$request->city,
            'location'=>$request->location,
            'brigade_id'=>$request->id,
        ]);
        return to_route('unitCompany.index')->with('message', 'unit/Company added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(UnitCompany $unitCompany)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UnitCompany $unitCompany)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitCompanyRequest $request, UnitCompany $unitCompany)
    {
        $unitCompany->update($request->validated());
        return to_route('unitCompany.index')->with('message', 'Unit/Company edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UnitCompany $unitCompany)
    {
        $unitCompany->delete();
        return to_route('unitCompany.index')->with('message','Unit/Company deleted successfully');
    }
}
