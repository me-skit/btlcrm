<?php

namespace App\Http\Controllers;

use App\Models\FamilyRole;
use Illuminate\Http\Request;

class FamilyRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $familyroles = FamilyRole::all();
    
        return view('familyroles.index', compact('familyroles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('familyroles.create');
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
            'description' => 'required'
        ]);

        FamilyRole::create([
            'description' => $data['description']
        ]);

        return redirect('/familyroles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FamilyRole  $familyRole
     * @return \Illuminate\Http\Response
     */
    public function edit(FamilyRole $familyRole)
    {
        return view('familyroles.edit', compact('familyRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FamilyRole  $familyRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FamilyRole $familyRole)
    {
        $data = $request->validate([
            'description' => 'required'
        ]);

        $familyRole->fill($data);
        $familyRole->save();

        return redirect('/familyroles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FamilyRole  $familyRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(FamilyRole $familyRole)
    {
        $familyRole->delete();

        return redirect('/familyroles');
    }
}
