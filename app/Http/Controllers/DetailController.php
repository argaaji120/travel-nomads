<?php

namespace App\Http\Controllers;

use App\Models\TravelPackage;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index($slug)
    {
        $travel_package = TravelPackage::with('galleries')->where('slug', $slug)->first();
        // return $travel_package;
        return view('pages.frontend.detail', compact('travel_package'));
    }
}
