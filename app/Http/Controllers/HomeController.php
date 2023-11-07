<?php

namespace App\Http\Controllers;

use App\Models\User;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = User::where('mainone_id', auth()->user()->mainone_id)->with('wallet')->first();
        return view('pages.dashboard', [
            'user' => $user
        ]);
    }
}
