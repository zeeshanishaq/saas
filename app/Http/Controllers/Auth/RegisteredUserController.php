<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Http\Controllers\CurlRequestController;

class RegisteredUserController extends CurlRequestController
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:50'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $params = http_build_query(['$phone_number' => $request->phone, 'id' => 1, '$first_name' => $request->name, 'api_key' => 'pk_58c01a5beb2830c77ee6cd4c14017efad2']);
        $this->setUrl('https://a.klaviyo.com/api/v1/person/01FSMP7A8G0SS067RJGFFPR4HG?'.$params);
        $this->setHeaders(['api_key: pk_58c01a5beb2830c77ee6cd4c14017efad2']);
        $this->setResponseMethod('PUT');
        $this->setBody([]);
        $response = $this->httpPost();

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
