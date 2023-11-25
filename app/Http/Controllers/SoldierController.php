<?php

namespace App\Http\Controllers;

use App\Models\Soldier;
use App\Http\Requests\StoreSoldierRequest;
use App\Http\Requests\UpdateSoldierRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SoldierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $filters = ['search' => request('search'), 'search1'=> request('search1')];
    $soldier = Soldier::latest()->filter($filters)->get();
    return view('pages.soldier', compact('soldier'));
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
    public function store(StoreSoldierRequest $request)
    {

        // dd($request->all());

        $soldier = Soldier::create([
            'name' => $request->name,
            'position'=>$request->position,
            'rank'=>$request->rank,
            'matricular' =>$request->matricular,
            'gender' =>$request->gender,
            'nationality'=> $request->nationality,
            'specialization' =>$request->specialization,
            'bloodGroup' =>$request->bloodGroup,
            'marialStatus' =>$request->marialStatus,
            'date_of_birth'=>$request->date_of_birth,
            'regionOfBirth' =>$request->regionOfBirth,
        ]);
        if($request->file('photo')){
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
            $ext = $request->file('photo')->extension();
            $content = file_get_contents($request->file('photo'));
            $filename = str::random(10);
            $path = "soldierPhoto/.$filename.$ext";
            storage::disk('public')->put($path,$content);
            $soldier->update([
                'photo' =>$path
            ]);

        }

        return to_route('soldier.index')->with('message', 'personnal created successfully');






    }

    /**
     * Display the specified resource.
     */
    public function show(Soldier $soldier)
    {
        //
        return view('pages.soldier-show', compact('soldier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Soldier $soldier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSoldierRequest $request, Soldier $soldier)
    {
        //

        $soldier->update($request->validated());

        if($request->file('photo')){
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',]);
            Storage::disk('public')->delete($soldier->photo);
            $ext = $request->file('photo')->extension();
            $content = file_get_contents($request->file('photo'));
            $filename = str::random(10);
            $path = "soldierPhoto/.$filename.$ext";
            storage::disk('public')->put($path,$content);
            $soldier->update([
                'photo' =>$path
            ]);

        }
        return to_route('soldier.index')->with('message', 'Personnal informations edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Soldier $soldier)
    {
        //
        $soldier->delete();
        return to_route('soldier.index')->with('message', ' personnal deleted successfully');
    }
}
