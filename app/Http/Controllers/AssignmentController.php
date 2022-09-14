<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignmentRequest;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Privilege;
use App\Models\PrivilegeRole;
use App\Models\PrivilegeHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

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

        $privileges = Privilege::all();

        if ($privileges->count() > 0) {
            if ($request->get('priv_id')) {
                $selected = Privilege::findOrFail($request->get('priv_id'));
            }
            else {
                $selected = $privileges->first();
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
                        ->select('people.id', 'first_name', 'second_name', 'third_name', 'first_surname', 'second_surname', 'cellphone', 'privilege_roles.name as role', 'privilege_histories.start_date', 'privilege_histories.end_date', 'disciplines.id as disciplined', 'act_number', 'address', 'zone', 'phone_number', 'family_members.family_id as family_id')
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

        return view('privilegehistory.current');
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

        return view('privilegehistory.index', compact('person'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssignmentRequest $request)
    {
        //Gate::authorize('administer');

        $data = $request->validated();

        $privilege = new PrivilegeHistory();
        $privilege->fill($data);
        $privilege->created_by = Auth::id();
        $privilege->save();

        $person = Person::findOrFail($data['person_id']);

        return view('privilegehistory.index', compact('person'));
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

        $privileges = $privileges_tmp;

        $privilege_roles = PrivilegeRole::all();

        return view('privilegehistory.edit', compact('the_privilege', 'privileges', 'privilege_roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssignmentRequest $request, $id)
    {
        //Gate::authorize('administer');
        $data = $request->validated();

        $privilege = PrivilegeHistory::findOrFail($id);
        $privilege->fill($data);
        $privilege->updated_by = Auth::id();
        $privilege->save();

        $person = $privilege->person;

        return view('privilegehistory.index', compact('person'));
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

        return view('privilegehistory.index', compact('person'));
    }
}
