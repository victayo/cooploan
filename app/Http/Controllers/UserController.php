<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Returns view for all users
     */
    public function index(){
        return view("pages.users.index");
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
        return view("pages.users.user-new");
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
