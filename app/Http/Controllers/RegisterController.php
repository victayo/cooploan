<?php

namespace App\Http\Controllers;

// use App\Http\Requests\RegisterRequest;

use App\Models\EmploymentDetails;
use App\Models\Fee;
use App\Models\NextOfKin;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class RegisterController extends Controller
{
    /**
     * @todo: This should be gotten from settings
     */
    private $membershipFee = 2000;
    private $minAmountToSave = 2000;

    public function create(Request $request, $user)
    {
        /**
         * @todo Create a view for this
         */
        $userM = User::where('email', $user)->first();
        if (!$request->hasValidSignature() || !is_null($userM)) { //if the signature is not valid or user already exist, abort.
            abort(401);
        }

        return view('auth.register', [
            'min_save_amount' => $this->minAmountToSave,
            'membership_fee' => $this->membershipFee,
            'email' => $user,
            'signature' => $request->query('signature'),
            'expires' => $request->query('expires')
        ]);
    }

    public function store(Request $request)
    {
        $prevRequest = Request::create(URL::previous());
        /**
         * @todo Create a view for this
         * Validate the signature of the previous request.
         */
        if(!URL::hasValidSignature($prevRequest)){
            abort(410, 'Invalid/Expired Registration Link');
        };
        $attributes = $request->validate([
            'mainone_id' => 'required|unique:users,mainone_id',
            'firstname' => 'required|string',
            'middlename' => 'string|nullable',
            'lastname' => 'required|string',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'gender' => 'required',
            'dob' => 'required',
            'phone' => 'required|string',
            'country' => 'required|string',
            'state' => 'required|string',
            'city' => 'required|string',
            'address' => 'required|string',

            'resumption_date' => 'required|date',
            'department' => 'required|string',
            'job_title' => 'required|string',
            'contract_staff' => 'required|min:0|max:1',

            'save_amount' => "required|numeric|min:$this->minAmountToSave",

            'nok_firstname' => 'required|string',
            'nok_lastname' => 'required|string',
            'nok_dob' => 'required',
            'nok_email' => 'required|email',
            'nok_phone' => 'required|string',
            'nok_address' => 'required|string',

            'consent' => 'required',
            'expires_at' => 'required',
            'signature' => 'required',
            'url_email' => 'required|email'
        ]);

        /**
         * @todo Create a view for this
         */
        if($attributes['email'] != $attributes['url_email']){
            abort(410);
        }

        try{
            DB::beginTransaction();
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
                'status' => User::PENDING,
                'city' => $request->post('city'),
                'address' => $request->post('address'),
                'password' => $request->post('password'),
                'save_amount' => $request->post('save_amount'),
            ]);

            // save employment details
            EmploymentDetails::create([
                'mainone_id' => $request->post('mainone_id'),
                'department' => $request->post('department'),
                'resumption_date' => $request->post('resumption_date'),
                'job_title' => $request->post('job_title'),
                'is_permanent_staff' => $request->post('contract_staff')
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

            // Create membership fee record
            Fee::create([
                'mainone_id' => $request->post('mainone_id'),
                'fee' => $this->membershipFee,
                'type' => Fee::MEMBERSHIP_FEE
            ]);


            DB::commit();
            /**
             * @todo Notify user on successful registration
             */
            auth()->login($user);

            /**
             * @todo notify user on successful registration
             */
            return redirect('/dashboard');
        }catch(Exception $exception){
            DB::rollBack();
            report($exception);
            return back()->withInput();
        }
    }
}
