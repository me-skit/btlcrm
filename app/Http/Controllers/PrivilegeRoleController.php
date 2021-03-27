<?php

namespace App\Http\Controllers;

use App\Models\PrivilegeRole;
use Illuminate\Http\Request;

class PrivilegeRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->get('query'))
        {
            $query = str_replace(" ", "%", $request->get('query'));
            $privilegeRoles = PrivilegeRole::where('description', 'like', '%' . $query . '%')
                            ->orderBy('description')
                            ->paginate(7);

            return view('privilegeroles.pagination', compact('privilegeRoles'));
        }

        if ($request->get('page'))
        {
            $privilegeRoles = PrivilegeRole::orderBy('description')->paginate(7);

            return view('privilegeroles.pagination', compact('privilegeRoles'));
        }

        $privilegeRoles = PrivilegeRole::orderBy('description')->paginate(7);

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
            'description' => ['required', 'unique:privilege_roles']
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
