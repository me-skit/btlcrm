<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Privilege;
use App\Models\PrivilegeRole;
use App\Models\PrivilegeHistory;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $the_privilege = PrivilegeHistory::findOrFail($id);
        $person = $the_privilege->person;
        $privileges = Privilege::orderBy('description')
                        ->where(function ($query) use ($person) {
                            $query->whereNull('preferred_sex')
                                  ->orWhere('preferred_sex', $person->sex);
                        })
                        ->where(function ($query) use ($person) {
                            $query->whereNull('preferred_status')
                                  ->orWhere('preferred_status', $person->status);
                        })
                        ->get();
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
        //
    }
}
