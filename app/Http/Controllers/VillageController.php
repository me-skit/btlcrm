<?php

namespace App\Http\Controllers;

use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class VillageController extends Controller
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

        $villages = Village::all();

        return view('villages.index', compact('villages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('administer');

        return view('villages.create');
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
            'name' => 'required'
        ]);

        $data['created_by'] = Auth::id();
        Village::create($data);

        return redirect('/villages');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function edit(Village $village)
    {
        Gate::authorize('administer');

        return view('villages.edit', compact('village'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Village $village)
    {
        Gate::authorize('administer');

        $data = $request->validate([
            'name' => 'required'
        ]);

        $data['updated_by'] = Auth::id();
        $village->fill($data);
        $village->save();

        return redirect('/villages');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Village  $village
     * @return \Illuminate\Http\Response
     */
    public function destroy(Village $village)
    {
        Gate::authorize('administer');

        if ($village->campuses->count() || $village->families->count()) {
            return back()->with('warning', 'No es posible borrar "' . $village->name . '", se encuentra asociado a alguna sede o familia');
        }

        $village->delete();

        return redirect('/villages');
    }
}
