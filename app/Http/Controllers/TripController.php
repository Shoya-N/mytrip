<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function add ()
    {
        return view('trip.create'); 
    }
    
    public function create (Request $request)
    {
        return redirect('trip/create');
    }
}
