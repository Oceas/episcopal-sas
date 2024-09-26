<?php

namespace App\Http\Controllers;

use App\Models\Device;

class DevicesController extends Controller
{

    public function index() {

        // Fetch prayers with pagination
        $devices = Device::orderBy('created_at', 'desc')->paginate();

        return view('devices', compact('devices'));
    }
}