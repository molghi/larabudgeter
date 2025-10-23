<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    // =========================================================

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    // =========================================================

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    // =========================================================

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

    // =========================================================

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

    // =========================================================

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

    // =========================================================

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // =========================================================

    public function signup (Request $request) {
        date_default_timezone_set('Etc/GMT-4');

        // get form data, validate, ready
        $data = $request->validate([
            'email' => 'required|email|max:100|unique:users,email',
            'password' => 'required|confirmed',
        ]);
        $data['name'] = explode('@', $data['email'])[0];

        // hash pw
        $data['password'] = bcrypt($data['password']);

        // store in db
        $user = User::create($data);

        // store in session
        Auth::login($user);

        // redirect
        return redirect('/dashboard')->with('success', 'Signup successful!');
    }

    // =========================================================

    public function show_auth_forms () {
        $data = [
            'title' => 'Auth | Your Budgeter'
        ];
        return view('auth', $data);
    }

    // =========================================================

    public function show_dashboard () {
        $data = [
            'title' => 'Dashboard | Your Budgeter'
        ];
        return view('dashboard', $data);
    }

    // =========================================================

    public function login (Request $request) {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate(); // prevent session fixation
            return redirect()->intended('/dashboard')->with('success', 'Logged in!'); // redirect logged-in user
        }

        return back()->withErrors([
            'email-login' => 'The provided credentials do not match our records.',
        ]);
    }
    
    // =========================================================
    
    public function logout () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/')->with('success', 'Logged out!');
    }

}