<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $logger = Logger()->debug('logger');
        return view('clients.principal');
    }

    public function getClients()
    {
        return view('clients.add-clients');
    }

    public function postClients(Request $request)
    {
        dd($request->all());
    }
}
