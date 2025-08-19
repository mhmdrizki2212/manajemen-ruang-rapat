<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RuangUserController extends Controller
{
    public function zona1()
    {
        return view('front.ruang.zona1');
    }
    public function field()
    {
        return view('front.ruang.field');
    }
}
