<?php

namespace App\Http\Controllers;

use App\Models\DisciplineType;
use Illuminate\Http\Request;

class DisciplineTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $disciplineTypes = DisciplineType::all();

        return view('disciplinetypes.index', compact('disciplineTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('disciplinetypes.create');
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
            'description' => 'required',
            'months' => ['required', 'numeric']
        ]);

        DisciplineType::create([
            'description' => $data['description'],
            'months' => $data['months']
        ]);

        return redirect('/disciplinetypes');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DisciplineType  $disciplineType
     * @return \Illuminate\Http\Response
     */
    public function edit(DisciplineType $disciplineType)
    {
        return view('disciplinetypes.edit', compact('disciplineType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DisciplineType  $disciplineType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DisciplineType $disciplineType)
    {
        $data = $request->validate([
            'description' => 'required',
            'months' => ['required', 'numeric']
        ]);

        $disciplineType->fill($data);
        $disciplineType->save();

        return redirect('/disciplinetypes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DisciplineType  $disciplineType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DisciplineType $disciplineType)
    {
        $disciplineType->delete();

        return redirect('/disciplinetypes');
    }
}
