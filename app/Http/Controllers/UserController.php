<?php

namespace App\Http\Controllers;

use App\Mail\RegistrationLink;
use App\Mail\UserRegistration;
use App\Models\EmploymentDetails;
use App\Models\Fee;
use App\Models\NextOfKin;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * @todo: This should be gotten from settings
     */
    private $membershipFee = 2000;
    private $minAmountToSave = 2000;
    private $linkExpirationDuration = 24;

    /**
     * Returns view for all users
     */
    public function index(){
        $this->authorize('viewAny', User::class);
        $users = User::all();
        return view("pages.users.index", [
            'users' => $users,
        ]);
    }

    /**
     * Shows a user
     */
    public function show($id){
        $user = User::with(['employmentDetails', 'nextOfKin'])->where('mainone_id', $id)->first();

        $this->authorize('view', $user);

        $employment = EmploymentDetails::where('mainone_id', $id)->first();
        $nok = NextOfKin::where('mainone_id', $id)->first();
        return view("pages.users.show", [
            'user' => $user,
            'employment' => $employment,
            'nok' => $nok,
            'min_save_amount' => $this->minAmountToSave
        ]);
    }

    /**
     * Returns view to create a user
     */
    public function create(){
        return view("pages.users.user-new", [
            'membership_fee' => $this->membershipFee,
            'min_save_amount' => $this->minAmountToSave
        ]);
    }

    /**
     * Creates a new user
     */
    public function store(Request $request){
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

            'save_amount' => "required|numeric|min:$this->minAmountToSave",

            'nok_firstname' => 'required|string',
            'nok_lastname' => 'required|string',
            'nok_dob' => 'required',
            'nok_email' => 'required|email',
            'nok_phone' => 'required|string',
            'nok_address' => 'required|string',

            'consent' => 'required'
        ]);

        $password = Str::random(12);

        try{
            DB::beginTransaction();
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
                'password' => $password,
                'save_amount' => $request->post('save_amount')
            ]);

            // save employment details
            EmploymentDetails::create([
                'mainone_id' => $request->post('mainone_id'),
                'department' => $request->post('department'),
                'resumption_date' => $request->post('resumption_date'),
                'job_title' => $request->post('job_title')
            ]);

            // Save next of kin details
            NextOfKin::create([
                'mainone_id' => $request->post('mainone_id'),
                'firstname' => $request->post('nok_firstname'),
                'lastname' => $request->post('nok_lastname'),
                'dob' => $request->post('nok_dob'),
                'email' => $request->post('nok_email'),
                'phone' => $request->post('nok_phone'),
                'address' => $request->post('nok_address')
            ]);

            /**
             * @todo move to queue
             */
            Mail::to($user->email)->send(new UserRegistration($user, $password));

            DB::commit();
            return redirect()->route('users.index')->with('success', 'User successfully added!');
        }catch(Exception $exception){
            DB::rollBack();
            report($exception);
            return back()->withInput();
        }
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
        try{
            DB::beginTransaction();
            $request->validate([
                'firstname' => 'required|string',
                'middlename' => 'string|nullable',
                'lastname' => 'required|string',
                'gender' => 'required',
                'dob' => 'required',
                'phone' => 'required|string',
                'country' => 'required|string',
                'state' => 'required|string',
                'city' => 'required|string',
                'address' => 'required|string',

                'employment_details.resumption_date' => 'required|date',
                'employment_details.department' => 'required|string',
                'employment_details.job_title' => 'required|string',

                'save_amount' => "required|numeric|min:$this->minAmountToSave",

                'next_of_kin.firstname' => 'required|string',
                'next_of_kin.lastname' => 'required|string',
                'next_of_kin.dob' => 'required',
                'next_of_kin.email' => 'required|email',
                'next_of_kin.phone' => 'required|string',
                'next_of_kin.address' => 'required|string'
            ]);

            User::where('mainone_id', $id)->update([
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
                'save_amount' => $request->post('save_amount')
            ]);

            $employmentDetails = $request->post('employment_details');
            $nok = $request->post('next_of_kin');
            EmploymentDetails::where('mainone_id', $id)->update([
                'department' => $employmentDetails['department'],
                'resumption_date' => $employmentDetails['resumption_date'],
                'job_title' => $employmentDetails['job_title']
            ]);
            NextOfKin::where('mainone_id', $id)->update([
                'firstname' => $nok['firstname'],
                'lastname' => $nok['lastname'],
                'dob' => $nok['dob'],
                'email' => $nok['email'],
                'address' => $nok['address'],
                'phone' => $nok['phone']
            ]);

            DB::commit();
            // return redirect()->route('users.show', $id)->with('success', 'Successfully updated user');
            return response()->json(['success' => true]);
        }catch(Exception $exception){
            report($exception);
            DB::rollBack();
            // return redirect()->route('users.show', $id)->with('error', $exception->getMessage());
            return response()->json(['success' => false, 'message' => $exception->getMessage()]);
        }
    }

    /**
     * This approves a pending user
     */
    public function approve($user){
        $this->authorize('updateStatus', auth()->user());
        User::where('mainone_id', $user)->update([
            'status' => User::ACTIVE,
            'date_approved' => now()
        ]);
        // Create membership fee record for approved user
        Fee::create([
            'mainone_id' => $user,
            'fee' => $this->membershipFee,
            'type' => Fee::MEMBERSHIP_FEE
        ]);
        return response()->json(['success' => true]);
    }

    /**
     * This activates a user. This is for user's that have been deactivated
     */
    public function activate($user){
        $this->authorize('updateStatus', auth()->user());

        User::where('mainone_id', $user)->update(['status' => User::ACTIVE]);
        // Create membership fee record for reactivated user
        Fee::create([
            'mainone_id' => $user,
            'fee' => $this->membershipFee * 2, //Membership fee is double for reactivated user
            'type' => Fee::MEMBERSHIP_FEE
        ]);
        return response()->json(['success' => true]);
    }

    /**
     * This declines a user registration request
     */
    public function decline($user){
        $this->authorize('updateStatus', auth()->user());

        User::where('mainone_id', $user)->update(['status' => User::DECLINED]);
        return response()->json(['success' => true]);
    }

    /**
     * This deactivates a user
     */
    public function deactivate($user){
        $this->authorize('updateStatus', auth()->user());

        User::where('mainone_id', $user)->update([
            'status' => User::INACTIVE,
            'date_deactivated' => now()
        ]);
        return response()->json(['success' => true]);
    }

    /**
     * Sends registration link to a new user
     */
    public function sendLink(Request $request){
        if($request->user()->cannot('sendLink', User::class)){
            abort(403);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users,email',
        ]);

        if($validator->fails()){
            return redirect()->route('users.index')->with('error', 'Invalid email or email already exist');
        }

        $email = $request->post('email');

        $expiresAt = now()->addHour($this->linkExpirationDuration);

        $url = URL::temporarySignedRoute('register', $expiresAt, ['user' => $email]);

        //send the url to the email
        /**
         * @todo Create a job?
         */
        Mail::to($email)->send(new RegistrationLink($url));

        return redirect()->route('users.index')->with('success', 'Link successfully sent to user');

    }
}
