<?php

namespace App\Http\Controllers;

use App\Models\TravelPackage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $travel_packages = TravelPackage::with(['galleries'])->take(4)->get();

        return view('pages.frontend.home', compact('travel_packages'));
    }
}
