<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.home'); // menampilkan view resources/views/home.blade.php
    }
}

