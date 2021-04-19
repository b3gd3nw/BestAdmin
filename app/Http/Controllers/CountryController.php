<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Gets all countries from db and returns them.
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function fetchAll()
    {
        $countries = Country::all();
        return response()->json($countries);
    }
}