<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Throwable;

class HomeController extends Controller
{
    public function index()
    {
        try {
            return view('home');
        } catch (Throwable $e) {
            throw $e;
        }
    }
}
