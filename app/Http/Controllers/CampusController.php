<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use Illuminate\Http\Request;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campuses = Campus::all();

        return view('campuses.index', compact('campuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('campuses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'longitude' => ['numeric', 'nullable'],
            'latitude' => ['numeric', 'nullable']
        ]);

        Campus::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'longitude' => $data['longitude'],
            'latitude' => $data['latitude']
        ]);

        return redirect('/campus');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function edit(Campus $campus)
    {
        return view('campuses.edit', compact('campus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campus $campus)
    {
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'longitude' => ['numeric', 'nullable'],
            'latitude' => ['numeric', 'nullable']
        ]);

        $campus->fill($data);
        $campus->save();

        return redirect('/campus');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Campus  $campus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campus $campus)
    {
        $campus->delete();

        return redirect('/campus');
    }
}
