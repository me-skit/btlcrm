<?php

namespace App\Http\Controllers;

use App\Models\UnionType;
use Illuminate\Http\Request;

class UnionTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uniontypes = UnionType::all();

        return view('uniontypes.index', compact('uniontypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uniontypes.create');
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

        UnionType::create([
            'description' => $data['description']
        ]);

        return redirect('/uniontypes');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnionType  $unionType
     * @return \Illuminate\Http\Response
     */
    public function edit(UnionType $unionType)
    {
        return view('uniontypes.edit', compact('unionType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnionType  $unionType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UnionType $unionType)
    {
        $data = $request->validate([
            'description' => 'required'
        ]);

        $unionType->fill($data);
        $unionType->save();

        return redirect('/uniontypes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnionType  $unionType
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnionType $unionType)
    {
        $unionType->delete();
    
        return redirect('/uniontypes');
    }
}
