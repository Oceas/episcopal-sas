<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {

        // Fetch prayers with pagination
        $admins = User::orderBy('created_at', 'desc')->paginate(20);

        return view('admins', compact('admins'));
    }
}
