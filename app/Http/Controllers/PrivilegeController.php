<?php

namespace App\Http\Controllers;

use App\Models\Privilege;
use Illuminate\Http\Request;

class PrivilegeController extends Controller
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
        $privileges = Privilege::orderBy('description')->paginate(10);

        return view('privileges.index', compact('privileges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('privileges.create');
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
            'description' => ['required', 'unique:privileges'],
            'preferred_sex' => 'nullable',
            'preferred_status' => 'nullable',
            'min_age' => ['numeric', 'nullable'],
            'max_age' => ['numeric', 'nullable']
        ]);

        Privilege::create($data);

        return redirect('/privileges');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function edit(Privilege $privilege)
    {
        return view('privileges.edit', compact('privilege'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Privilege $privilege)
    {
        $date = $request->validate([
            'description' => 'required',
            'preferred_sex' => 'nullable',
            'preferred_status' => 'nullable',
            'min_age' => ['numeric', 'nullable'],
            'max_age' => ['numeric', 'nullable']            
        ]);

        $privilege->fill($date);
        $privilege->save();

        return redirect('/privileges');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Privilege  $privilege
     * @return \Illuminate\Http\Response
     */
    public function destroy(Privilege $privilege)
    {
        $privilege->delete();

        return redirect('/privileges');
    }
}
