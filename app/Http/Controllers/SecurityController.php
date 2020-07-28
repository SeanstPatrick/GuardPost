<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Providers\RouteServiceProvider;
use App\Security;
use App\Address;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SecurityController extends Controller
{
    use RegistersUsers;

    public function index()
    {
        return view('auth/security_register');
    }

    public function register(Request $request)
    {

       $validatedData = $request->validate([
        'name' => ['required','string', 'max:255'],
        'phone' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','min:10'],
        'e_phone' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','min:10'],
        'cpr' => ['required','digits:1'],
        'height' => ['required', 'digits:3'],
        'weight' => ['required', 'digits:3'],
        'license' => ['unique:businesses,license_number','required', 'digits:12'],
        'license_type' => ['required', 'string', 'max:255'],
        'datetimepicker' => ['required', 'date','after:5 months'],
        'jurisdiction' => ['required', 'string', 'max:255'],
        'gender' => ['required', 'string', 'max:25'],
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

        $address = Address::create_address($request->all(), $user_id->id, 'Security');

       return view('/home');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Security
     */
    protected function create(array $data, $id)
    {
        return Security::create([
            'user_id' => $id,
            'name' => $data['name'],
            'license_type' => $data['license_type'],
            'license_number' => $data['license'],
            'license_expire' => $data['datetimepicker'],
            'jurisdiction' => $data['jurisdiction'],
            'gender' => $data['gender'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'emergency_phone'=>$data['e_phone'],
            'rating' => 3,
            'cpr' => $data['cpr'],
            'height' => $data['height'],
            'weight' => $data['weight'],
        ]);
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
     * Show the form for viewing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
       $profile = Security::where('user_id', Auth::user()->id)->first();
       $address = Address::where('user_id', $profile['user_id'])->first();

       return view('auth/security_profile', ['profile' => $profile, 'address'=>$address]);
    }
}
