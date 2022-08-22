<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrivilegeRequest;
use App\Models\Privilege;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class PrivilegeController extends Controller
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
            $privileges = Privilege::where('description', 'like', '%' . $query . '%')
                            ->orderBy('description')
                            ->paginate(7);

            return view('privileges.pagination', compact('privileges'));
        }

        $privileges = Privilege::paginate(7);
        
        if ($request->get('page'))
        {
            return view('privileges.pagination', compact('privileges'));
        }

        return view('privileges.index', compact('privileges'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('administer');

        return view('privileges.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrivilegeRequest $request)
    {
        Gate::authorize('administer');

        $data = $request->validated();

        $data['created_by'] = Auth::id();
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
        Gate::authorize('administer');

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
        Gate::authorize('administer');

        $data = $request->validated();

        $data['updated_by'] = Auth::id();
        $privilege->fill($data);
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
        Gate::authorize('administer');

        $privilege->delete();

        return redirect('/privileges');
    }
}
