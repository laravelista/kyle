<?php

namespace App\Http\Controllers;

use App\Client;
use App\Service;
use App\Http\Requests;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::orderBy('title')->with(['client'])->get();

        return view('services.index')->with(compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currencies = [
            'hrk' => 'HRK',
            'usd' => 'USD',
            'eur' => 'EUR',
        ];
        $clients = Client::orderBy('name')->pluck('name', 'id')->toArray();

        return view('services.create')->with(compact('currencies', 'clients'));
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
            'title' => 'required|max:255',
            'note' => 'string',
            'month' => 'required|integer|min:1|max:12',
            'day' => 'required|integer|min:1|max:31',
            'cost' => 'required|integer|min:0',
            'currency' => 'required|in:hrk,usd,eur',
            'active' => 'boolean',
            'client_id' => 'required|exists:clients,id'
        ]);

        $client = Client::find($request->get('client_id'));

        $service = new Service;
        $service->title = $request->get('title');
        $service->note = $request->get('note');
        $service->month = $request->get('month');
        $service->day = $request->get('day');
        $service->cost = $request->get('cost');
        $service->currency = $request->get('currency');
        $service->active = $request->get('active', false);
        $service->client()->associate($client);
        $service->save();

        flash()->success('Service created!');

        return redirect()->route('services.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        $currencies = [
            'hrk' => 'HRK',
            'usd' => 'USD',
            'eur' => 'EUR',
        ];
        $clients = Client::orderBy('name')->pluck('name', 'id')->toArray();

        return view('services.edit')->with(compact('service', 'currencies', 'clients'));
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
        $service = Service::findOrFail($id);

        $this->validate($request, [
            'title' => 'required|max:255',
            'note' => 'string',
            'month' => 'required|integer|min:1|max:12',
            'day' => 'required|integer|min:1|max:31',
            'cost' => 'required|integer|min:0',
            'currency' => 'required|in:hrk,usd,eur',
            'active' => 'boolean',
            'client_id' => 'required|exists:clients,id'
        ]);

        $service->update([
            'title' => $request->get('title'),
            'note' => $request->get('note'),
            'month' => $request->get('month'),
            'day' => $request->get('day'),
            'cost' => $request->get('cost'),
            'currency' => $request->get('currency'),
            'active' => $request->get('active', false),
        ]);

        $client = Client::find($request->get('client_id'));
        $service->client()->associate($client);

        flash()->success('Service Updated!');

        return redirect()->route('services.edit', $service->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        flash()->success('Service Deleted!');

        return redirect()->route('services.index');
    }
}
