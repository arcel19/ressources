<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Http\Requests\StoreTrainingRequest;
use App\Http\Requests\UpdateTrainingRequest;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $training = Training::all();
        return view("pages.training", compact('training'));
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
    public function store(StoreTrainingRequest $request)
    {
        $soldierId = $request->id;
        $train = Training::where('soldier_id', $soldierId)->first();
        if ($train) {
            return to_route('training.index')->with('message', ' this training has already a leave just update it !');
        }
        
        $training = new Training;

        // Affectation des valeurs
        $training->trainingType = $request->input('trainingType');
        $training->schoolCompleted = $request->has('schoolCompleted');
        $training->schoolName = $request->input('schoolName');
        $training->schoolYear = $request->input('schoolYear');
        $training->soldier_id = $request->input('id');


        // Enregistrement dans la base de données
        $training->save();

        return to_route('training.index')->with('message', 'training added successfully to a soldier');
    }

    /**
     * Display the specified resource.
     */
    public function show(Training $training)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Training $training)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTrainingRequest $request, Training $training)
    {
        $training->update($request->validated());
        return to_route('training.index')->with('message', 'Training edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Training $training)
    {
        $training->delete();
        return to_route('training.index')->with('message', 'Training deleted successfully');
    }
}
