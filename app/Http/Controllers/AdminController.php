<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
        public function index()
    {
        return view('back.home-admin'); // view yang baru
    }

}
