<?php

namespace App\Http\Controllers;

use App\Models\PrivilegeRole;
use Illuminate\Http\Request;

class PrivilegeRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $privilegeRoles = PrivilegeRole::all();

        return view('privilegeroles.index', compact('privilegeRoles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('privilegeroles.create');
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

        PrivilegeRole::create([
            'description' => $data['description']
        ]);

        return redirect('/privilegeroles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PrivilegeRole  $privilegeRole
     * @return \Illuminate\Http\Response
     */
    public function edit(PrivilegeRole $privilegeRole)
    {
        return view('privilegeroles.edit', compact('privilegeRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PrivilegeRole  $privilegeRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PrivilegeRole $privilegeRole)
    {
        $data = $request->validate([
            'description' => 'required'
        ]);

        $privilegeRole->fill($data);
        $privilegeRole->save();

        return redirect('/privilegeroles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PrivilegeRole  $privilegeRole
     * @return \Illuminate\Http\Response
     */
    public function destroy(PrivilegeRole $privilegeRole)
    {
        $privilegeRole->delete();

        return redirect('/privilegeroles');
    }
}
