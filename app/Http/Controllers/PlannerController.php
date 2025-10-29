<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Planner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Expense Planner | Your Budgeter',
            'entries' => Planner::where('user_id', Auth::id())->get(),
            'current_balance' => User::where('id', Auth::id())->value('balance'),
        ];
        return view('planner', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = [
            'title' => 'Expense Planner | Your Budgeter',
            'entries' => Planner::where('user_id', Auth::id())->get(),
            'current_balance' => User::where('id', Auth::id())->value('balance'),
            'date' => $request['date']
        ];
        return view('planner', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set("Etc/GMT-4");

        $data = $request->validate([
            'title' => 'required|string',
            'amount' => 'required|numeric',
            'when' => 'required|date',
         ]);
         $data['user_id'] = Auth::id();

         Planner::create($data);

         return redirect('/planner')->with('success', 'Entry created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'title' => 'Expense Planner | Your Budgeter',
            'entries' => Planner::where('user_id', Auth::id())->get(),
            'current_balance' => User::where('id', Auth::id())->value('balance'),
            // 'edit_entry' => Planner::where('user_id', Auth::id())->where('id', $id)->get()
            'edit_entry' => Planner::where('user_id', Auth::id())->find($id)
        ];
        // return $data['edit_entry'];
        return view('planner', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        date_default_timezone_set("Etc/GMT-4");

        $data = $request->validate([
            'title' => 'required|string',
            'amount' => 'required|numeric',
            'when' => 'required|date',
         ]);

         Planner::where('id', $id)->update($data);

         return redirect('/planner')->with('success', 'Entry updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {   
        $id = $request['id'];
        Planner::where('user_id', Auth::id())->where('id',$id)->delete();
        return redirect('/planner')->with('success', 'Entry deleted!');
    }
}
