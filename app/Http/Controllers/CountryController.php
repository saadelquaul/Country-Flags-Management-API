<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CountryController extends Controller implements HasMiddleware
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Country::all();
    }

    public static function middleware(){
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'capital' => 'required|max:255',
            'population' => 'required|numeric',
            'region' => 'required|max:255',
            'flag' => 'required|max:255',
            'currency' => 'required|max:255',
            'language' => 'required|max:255'
        ]);
        return Country::create($request->all());

    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        return $country;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|max:255',
            'capital' => 'required|max:255',
            'population' => 'required|numeric',
            'region' => 'required|max:255',
            'flag' => 'required|max:255',
            'currency' => 'required|max:255',
            'language' => 'required|max:255'
        ]);
        $country->update($request->all());
        return $country;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->delete();
        return response()->json();
    }
}
