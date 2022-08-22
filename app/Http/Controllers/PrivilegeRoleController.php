<?php

namespace App\Http\Controllers;

use App\Models\PrivilegeRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

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
        Gate::authorize('administer');

        if ($request->get('query'))
        {
            $query = str_replace(" ", "%", $request->get('query'));
            $privilegeRoles = PrivilegeRole::where('description', 'like', '%' . $query . '%')
                            ->orderBy('description')
                            ->paginate(7);

            return view('privilegeroles.pagination', compact('privilegeRoles'));
        }

        $privilegeRoles = PrivilegeRole::paginate(7);

        if ($request->get('page'))
        {
            return view('privilegeroles.pagination', compact('privilegeRoles'));
        }

        return view('privilegeroles.index', compact('privilegeRoles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('administer');

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
        Gate::authorize('administer');

        $data = $request->validate([
            'name' => ['required', 'unique:privilege_roles']
        ]);

        $data['created_by'] = Auth::id();
        PrivilegeRole::create($data);

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
        Gate::authorize('administer');

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
        Gate::authorize('administer');

        $data = $request->validate([
            'name' => 'required'
        ]);

        $data['updated_by'] = Auth::id();
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
        Gate::authorize('administer');

        $privilegeRole->delete();

        return redirect('/privilegeroles');
    }
}
