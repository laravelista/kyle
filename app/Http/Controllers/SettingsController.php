<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SettingsController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = auth()->user();
        $currencies = [
            'hrk' => 'HRK',
            'usd' => 'USD',
            'eur' => 'EUR'
        ];

        return view('settings.edit')->with(compact('user', 'currencies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->user()->id,
            'password' => 'min:6|confirmed',
            'preferred_currency' => 'required|in:hrk,usd,eur',
            'email_notifications' => 'boolean'
        ]);

        auth()->user()->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'preferred_currency' => $request->get('preferred_currency'),
            'email_notifications' => $request->get('email_notifications', false)
        ]);

        if($request->get('password', "") != "") {
            auth()->user()->password = bcrypt($request->get('password'));
            auth()->user()->save();
        }

        flash()->success('Settings updated!');

        return redirect('/settings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
