<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Business;
use App\Address;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class BusinessController extends Controller
{
    use RegistersUsers;

    public function index()
    {
        return view('auth/business_register');
    }

    public function register(Request $request)
    {

       $validatedData = $request->validate([
        'name' => ['required','string', 'max:255'],
        'contact' => ['required','string', 'max:255'],
        'phone' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','min:10'],
        'license' => ['unique:businesses,license_number','required', 'digits:12'],
        'category' => ['required', 'string', 'max:55'],
        'datetimepicker' => ['required', 'date','after:5 months'],
        'jurisdiction' => ['required', 'string', 'max:255'],
        'address' => ['required', 'string', 'max:255'],
        'city' => ['required', 'string', 'max:55'],
        'prov' => ['required', 'string', 'max:55'],
        'postcode' => ['required', 'regex:/^([a-zA-Z]\d[a-zA-Z])\ {0,1}(\d[a-zA-Z]\d)$/', 'min:6'],
        'type' => ['required', 'string', 'max:55'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
     ]);

        $user_id = User::create(array('password' => Hash::make($validatedData['password']), 'name' => $validatedData['name'], 'type'=>$validatedData['type'],'email'=>$validatedData['email']));

        $last = $this->create($validatedData, $user_id->id);

        $address = Address::create_address($request->all(), $user_id->id, 'Business');

        return view('/home');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Business
     */
    protected function create(array $data,$id)
    {
        return Business::create([
            'user_id' => $id,
            'company_name' => $data['name'],
            'contact_name' => $data['contact'],
            'phone' => $data['phone'],
            'license_number' => $data['license'],
            'license_category' => $data['category'],
            'license_expire' => $data['datetimepicker'],
            'jurisdiction' => $data['jurisdiction'],
        ]);
    }

    /**
     * Show the form for viewing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       $profile = Business::where('user_id', Auth::user()->id)->first();
       $address = Address::where('user_id', $profile['user_id'])->first();
       //dd($address);
       return view('auth/profile', ['profile' => $profile, 'address'=>$address]);
    }

}
