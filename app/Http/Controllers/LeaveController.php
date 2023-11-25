<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use App\Http\Requests\StoreLeaveRequest;
use App\Http\Requests\UpdateLeaveRequest;
use Carbon\Carbon;


class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $filters = [
            'search' => request('search'), 'search1' => request('search1'),
            'search2' => request('search2')
        ];

        $leave = Leave::latest()->filter($filters)->get();
        return view('pages.leaves',  compact('leave'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function approved(Leave $leave, $id)
    {
        $leave = Leave::find($id);

        $leave->update(['status' => 'approved']);

        return to_route('leave.index')->with('message', 'leave status change to approved !');
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeaveRequest $request)
    {
        $soldierId = $request->id;
        $enconge = Leave::where('soldier_id', $soldierId)->first();
        if ($enconge) {
            return to_route('leave.index')->with('message', ' this soldier has already a leave just update it !');
        }

        $leave = Leave::create([
            'type' => $request->type,
            'from' => $request->from,
            'to' => $request->to,
            'reason' => $request->reason,
            'remaining_leave' => 12,
            'number_of_days' => Carbon::createFromFormat('j/m/Y', $request->from)->diffInDays(Carbon::createFromFormat('j/m/Y', $request->to)),
            'soldier_id' => $request->id,
        ]);

        return to_route('leave.index')->with('message', ' Leave added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaveRequest $request, Leave $leave)
    {
        $leave->update($request->validated());
        $leave->update([
            'number_of_days' => Carbon::createFromFormat('j/m/Y', $request->from)->diffInDays(Carbon::createFromFormat('j/m/Y', $request->to))
        ]);
        return to_route('leave.index')->with('message', 'Leave edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leave $leave)
    {
        $leave->delete();
        return to_route('leave.index')->with('message', 'Leave deleted successfully');
    }
}
