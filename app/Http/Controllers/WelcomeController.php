<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Throwable;

class WelcomeController extends Controller
{
    public function index ()
    {
        try {
            return view('welcome');
        } catch(Throwable $e) {
            throw $e;
        }
    }
}
