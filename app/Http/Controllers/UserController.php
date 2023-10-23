<?php

namespace App\Http\Controllers;

use App\Mail\UserRegistration;
use App\Models\EmploymentDetails;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Returns view for all users
     */
    public function index(){
        $users = User::all();
        return view("pages.users.index", [
            'users' => $users,
        ]);
    }

    /**
     * Shows a user
     */
    public function show($id){
        return view("pages.users.show");
    }

    /**
     * Returns view to create a user
     */
    public function create(){
        $membershipFee = 2000; //todo: Get it from a settings field
        $minAmountToSave = 5000; //todo: Get it from a settings field
        return view("pages.users.user-new", [
            'membership_fee' => $membershipFee,
            'min_save_amount' => $minAmountToSave
        ]);
    }

    /**
     * Creates a new user
     */
    public function store(Request $request){
        $minAmountToSave = 5000; //todo: Get it from a settings field

        $validated = $request->validate([
            'mainone_id' => 'required|unique:users,mainone_id',
            'firstname' => 'required|string',
            'middlename' => 'string|nullable',
            'lastname' => 'required|string',
            'gender' => 'required',
            'dob' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',

            'resumption_date' => 'required|date',
            'department' => 'required|string',
            'job_title' => 'required|string',
            'how_long' => 'required|numeric|min:1',

            'save_amount' => "required|numeric|min:$minAmountToSave",
            'save_amount_words' => "required|string",

            'membership_fee' => 'required',
            'nok_firstname' => 'required|string',
            'nok_lastname' => 'required|string',
            'nok_dob' => 'required',
            'nok_email' => 'required|email',
            'nok_phone' => 'required|string',
        ]);

        $password = Str::random(12);

        // Save user details
        $user = User::create([
            'mainone_id' => $request->post('mainone_id'),
            'firstname' => $request->post('firstname'),
            'middlename' => $request->post('middlename'),
            'lastname' => $request->post('lastname'),
            'gender' => $request->post('gender'),
            'dob' => $request->post('dob'),
            'email' => $request->post('email'),
            'phone' => $request->post('phone'),
            'country' => $request->post('country'),
            'state' => $request->post('state'),
            'city' => $request->post('city'),
            'address' => $request->post('address'),
            'password' => $password
        ]);

        // save employment details
        $employmentDetails = EmploymentDetails::create([
            'mainone_id' => $request->post('mainone_id'),
            'department' => $request->post('department'),
            'resumption_date' => $request->post('resumption_date'),
            'job_title' => $request->post('job_title')
        ]);

        dd($employmentDetails);

        /**
         * @todo move to queue
         */
        Mail::to($user->email)->send(new UserRegistration($user, $password));
    }

    /**
     * Returns view to edit a user
     */
    public function edit($id){

    }

    /**
     * Edits a user
     */
    public function update($id, Request $request){

    }

    /**
     * Deletes a user
     */
    public function delete($id){

    }
}
