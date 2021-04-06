<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function fetchAll()
    {
        $countries = Country::all();
        return response()->json($countries);
    }
}
