<?php

namespace App\Http\Controllers;

use App\Models\Medical;
use App\Http\Requests\StoreMedicalRequest;
use App\Http\Requests\UpdateMedicalRequest;

class MedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $medical = Medical::all();
       return view('pages.medical',compact('medical'));
    }

    /**

    * Show the form for creating a new resource.
     */

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
    public function store(StoreMedicalRequest $request)
    {
        $medical = Medical::create([
            'physicalHealth'=>$request->physicalHealth,
            'immunization' =>$request->immunization,
            'hiv_test'=>$request->hiv_test,
            'others'=>$request->others,
            'soldier_id'=>$request->id,
        ]);
        if($medical){
            return to_route('medical.index')->with('message', 'Medical situation added successfully');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Medical $medical)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medical $medical)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMedicalRequest $request, Medical $medical)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medical $medical)
    {
        $medical->delete();
        return to_route('medical.index')->with('message', 'medical situation deleted successfully');
    }
}
