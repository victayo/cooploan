<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
