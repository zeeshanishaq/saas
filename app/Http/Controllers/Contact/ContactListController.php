<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\CurlRequestController;

class ContactListController extends CurlRequestController
{
    public function get()
    {
        $user = User::where('id', auth()->user()->id)->first();
        return view('dashboard',compact('user'));
    }

    public function edit($id)
    {
        $contact_list = User::findOrFail($id);
        return view('contact.edit', compact('contact_list'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:50',
            'phone' => 'required|max:50'
        ]);

        User::whereId($id)->update($validatedData);

        $params = http_build_query(['$phone_number' => $request->phone, 'id' => 1, '$first_name' => $request->name, 'api_key' => 'pk_58c01a5beb2830c77ee6cd4c14017efad2']);
        $this->setUrl('https://a.klaviyo.com/api/v1/person/01FSMP7A8G0SS067RJGFFPR4HG?'.$params);
        $this->setHeaders(['api_key: pk_58c01a5beb2830c77ee6cd4c14017efad2']);
        $this->setResponseMethod('PUT');
        $this->setBody([]);
        $response = $this->httpPost();

        return redirect('/dashboard')->with('success', 'Data is successfully updated');
    }

    public function curlRequest(Request $request)
    {
        # code...
    }
}
