<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('name')->get();

        return view('clients.index')->with(compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'oib' => 'required|size:11|unique:clients',
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|integer',
        ]);

        $client = Client::create([
            'name' => $request->get('name'),
            'oib' => $request->get('oib'),
            'street' => $request->get('street'),
            'city' => $request->get('city'),
            'postal_code' => $request->get('postal_code'),
        ]);

        flash()->success('Client created!');

        return redirect()->route('clients.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);

        return view('clients.edit')->with(compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|max:255',
            'oib' => 'required|size:11|unique:clients,oib' . $client->id,
            'street' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|integer',
        ]);

        $client->update([
            'name' => $request->get('name'),
            'oib' => $request->get('oib'),
            'street' => $request->get('street'),
            'city' => $request->get('city'),
            'postal_code' => $request->get('postal_code'),
        ]);

        flash()->success('Client Updated!');

        return redirect()->route('clients.edit', $client->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        flash()->success('Client Deleted!');

        return redirect()->route('clients.index');
    }
}
