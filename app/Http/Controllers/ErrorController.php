<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function index($words)
    {
        $data = [
            'words'=>$words
        ];
        return view('layouts.error',$data);
    }
}
