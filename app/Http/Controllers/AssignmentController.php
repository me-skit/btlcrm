<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Privilege;
use App\Models\PrivilegeRole;
use App\Models\PrivilegeHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function directory(Request $request)
    {
        Gate::authorize('consult');

        $privileges = Privilege::orderBy('description')->get();
        $selected = $privileges->first();

        if ($request->get('priv_id')) {
            $selected = Privilege::findOrFail($request->get('priv_id'));
        }

        $people = DB::table('privilege_histories')
                    ->join('people', function ($join) {
                        $join->on('privilege_histories.person_id', '=', 'people.id')
                             ->where(function ($query) {
                                $query->where('privilege_histories.end_date', null)
                                ->orWhereDate('privilege_histories.end_date', '>=', date('Y-m-d'));
                            });
                    })
                    ->join('privileges', function ($join) use ($selected) {
                        $join->on('privilege_histories.privilege_id', '=', 'privileges.id')
                             ->where('privileges.id', $selected->id);
                    })
                    ->leftJoin('privilege_roles', 'privilege_histories.privilege_role_id', '=', 'privilege_roles.id')
                    ->leftJoin('disciplines', function ($join) {
                        $join->on('people.id', '=', 'disciplines.person_id')
                             ->where('disciplines.ended', '0');
                    })
                    ->leftJoin('family_members', function ($join) {
                        $join->on('people.id', '=', 'family_members.person_id')
                             ->where('active', 1);
                    })
                    ->leftJoin('families', 'family_members.family_id', '=', 'families.id')
                    ->select('people.id', 'first_name', 'second_name', 'third_name', 'first_surname', 'second_surname', 'cellphone', 'privilege_roles.description as role', 'privilege_histories.start_date', 'privilege_histories.end_date', 'disciplines.id as disciplined', 'act_number', 'address', 'phone_number')
                    ->orderBy('first_name')
                    ->orderBy('second_name')
                    ->orderBy('third_name')
                    ->orderBy('first_surname')
                    ->orderBy('second_surname')
                    ->get();

        if ($request->get('priv_id')) {
            return view('privilegehistory.cards', compact('people'));
        }

        return view('privilegehistory.current', compact('privileges', 'people', 'selected'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('administer');
        
        $person = Person::findOrFail($request->get('userid'));
        $has_discipline = $person->discipline();
        $privs_assigned = $person->privileges;

        return view('privilegehistory.index', compact('privs_assigned', 'has_discipline'));
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
            'person_id' => 'required',
            'privilege_id' => 'required',
            'privilege_role_id' => 'nullable',
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date']
        ]);

        PrivilegeHistory::create($data);

        $person = Person::findOrFail($data['person_id']);
        $has_discipline = $person->discipline();
        $privs_assigned = $person->privileges;

        return view('privilegehistory.index', compact('privs_assigned', 'has_discipline'));
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
        $has_discipline = $person->discipline();
        $privs_assigned = $person->privileges;

        return view('privilegehistory.index', compact('privs_assigned', 'has_discipline'));
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
        $has_discipline = $person->discipline();
        $privs_assigned = $person->privileges;

        return view('privilegehistory.index', compact('privs_assigned', 'has_discipline'));
    }
}
