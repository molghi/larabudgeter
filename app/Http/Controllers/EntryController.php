<?php

namespace App\Http\Controllers;

use App\Models\Entry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'user_entries' => Entry::where('user_id', Auth::id())->get()
        ];
        return view('dashboard', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        date_default_timezone_set('Etc/GMT-4');

        $data = $request->validate([
            'amount' => 'required|numeric',
            'category' => 'required|string',
            'date' => 'required|date',
            'note' => 'nullable|string|max:255',
        ]);
        $data['user_id'] = Auth::id();

        Entry::create($data);

        return redirect('/dashboard')->with('success', 'Entry created!');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Entry::where('user_id', Auth::id())->where('id', $id)->delete();
        return redirect('/dashboard')->with('success', 'Entry deleted!');
    }

    public function read () {
        return Entry::where('user_id', Auth::id())->get();
    }


    public function total_income () {
        // return Entry::where('user_id', Auth::id())->where('category', 'income')->get();
        return Entry::where('user_id', Auth::id())->where('category', 'income')->sum('amount');
    }

    public function total_expense () {
        return Entry::where('user_id', Auth::id())->where('category', '!=', 'income')->sum('amount');
    }

    public function categorize_incomes () {
        // $data = [
        //     'categories' => Entry::where('user_id', Auth::id())->distinct()->pluck('category'), // get all cats, distinct
        //     'amounts' => Entry::where('user_id', Auth::id())->select('category', DB::raw('SUM(amount) as total'))->groupBy('category')->get(), // sum each cat
        // ];
        return Entry::where('user_id', Auth::id())
                ->select('category', DB::raw('SUM(amount) as total'))
                ->groupBy('category')
                ->pluck('total', 'category')->sortDesc();;
;
    }
}
