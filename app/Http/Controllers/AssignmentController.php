<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Privilege;
use App\Models\PrivilegeRole;
use App\Models\PrivilegeHistory;
use Illuminate\Support\Facades\Gate;

class AssignmentController extends Controller
{
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
            'person_id' => 'required',
            'privilege_id' => 'required',
            'privilege_role_id' => 'nullable',
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date']
        ]);

        PrivilegeHistory::create($data);

        $person = Person::findOrFail($data['person_id']);
        $privs_assigned = $person->privileges;

        return view('privilegehistory.index', compact('privs_assigned'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('administer');
        
        $the_privilege = PrivilegeHistory::findOrFail($id);
        $person = $the_privilege->person;
        $privilege = Privilege::findOrFail($the_privilege->privilege_id);
        $privileges_tmp = Privilege::where(function ($query) use ($person) {
                                        $query->whereNull('preferred_sex')
                                        ->orWhere('preferred_sex', $person->sex);
                                     })
                                   ->where(function ($query) use ($person) {
                                        $query->whereNull('preferred_status')
                                        ->orWhere('preferred_status', $person->status);
                                     })
                                   ->get();

        if (! $privileges_tmp->search($privilege)) {
            $privileges_tmp = $privileges_tmp->concat([$privilege]);
        }

        $privileges = $privileges_tmp->sortBy('description');

        $privilege_roles = PrivilegeRole::orderBy('description')->get();        

        return view('privilegehistory.edit', compact('the_privilege', 'privileges', 'privilege_roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Gate::authorize('administer');

        $data = $request->validate([
            'privilege_id' => 'required',
            'privilege_role_id' => 'nullable',
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date']
        ]);

        $privilege = PrivilegeHistory::findOrFail($id);
        $privilege->fill($data);
        $privilege->save();

        $person = $privilege->person;
        $privs_assigned = $person->privileges;

        return view('privilegehistory.index', compact('privs_assigned'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('administer');
        
        $privilege = PrivilegeHistory::findOrFail($id);
        $privilege->delete();

        $person = $privilege->person;
        $privs_assigned = $person->privileges;

        return view('privilegehistory.index', compact('privs_assigned'));
    }
}
