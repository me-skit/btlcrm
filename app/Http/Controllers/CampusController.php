<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class CampusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('administer');

        $campuses = Campus::with('village')->get();

        return view('campuses.index', compact('campuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('administer');

        $villages = Village::all();

        return view('campuses.create', compact('villages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('administer');

        $data = $request->validate([
            'name' => 'required',
            'village_id' => 'required',
            'address' => 'nullable',
            'phone_number' => 'nullable'
        ]);

        if ($request->input('location'))
        {
            $location = explode(",", $request->input('location'));
            $data['longitude'] = $location[0];
            $data['latitude'] = $location[1];
        }

        $data['created_by'] = Auth::id();
        Campus::create($data);

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
        Gate::authorize('administer');

        $villages = Village::all();

        return view('campuses.edit', compact('campus', 'villages'));
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
        Gate::authorize('administer');

        $data = $request->validate([
            'name' => 'required',
            'village_id' => 'required',
            'address' => 'nullable',
            'phone_number' => 'nullable'
        ]);

        if ($request->input('location'))
        {
            $location = explode(",", $request->input('location'));
            $data['longitude'] = $location[0];
            $data['latitude'] = $location[1];
        }
        else
        {
            $data['longitude'] = null;
            $data['latitude'] = null;
        }

        $data['updated_by'] = Auth::id();
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
        Gate::authorize('administer');

        if ($campus->memberships->count()) {
            return back()->with('warning', 'No es posible borrar "' . $campus->name . '", se encuentra asociado a alguna membresía');
        }

        $campus->delete();

        return redirect('/campus');
    }
}
