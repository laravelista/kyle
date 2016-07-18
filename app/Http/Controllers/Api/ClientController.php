<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Client;

class ClientController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255'
        ]);

        $client = Client::create([
            'name' => $request->get('name')
        ]);

        return $client->toArray();
    }
}
