<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Campus;
use App\Models\Privilege;
use Illuminate\Http\Request;
use App\Models\PrivilegeRole;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Database\QueryException;

class PersonController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        Gate::authorize('consult');

        $privileges = Privilege::where(function ($query) use ($person) {
                            $query->whereNull('preferred_sex')
                                  ->orWhere('preferred_sex', $person->sex);
                        })
                        ->where(function ($query) use ($person) {
                            $query->whereNull('preferred_status')
                                  ->orWhere('preferred_status', $person->status);
                        })
                        ->get();

        $privilege_roles = PrivilegeRole::all();

        return view('people.show', compact('person', 'privileges', 'privilege_roles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  $code
     * @return \Illuminate\Http\Response
     */
    public function info($code)
    {
        Gate::authorize('consult');

        $person_id = trim(base64_decode($code));
        $person = Person::find($person_id);

        if (!$person) {
            abort(404, "No person with code " . $code . " was found.");
        }

        return view('people.info', compact('person'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function edit(Person $person)
    {
        Gate::authorize('consult');

        $family = $person->family();
        $campuses = Campus::all();
        $privileges = Privilege::all();

        return view('people.edit', compact('person', 'family', 'campuses', 'privileges'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        Gate::authorize('consult');

        $person_data = $request->validate([
            'first_name' => 'required',
            'second_name' => 'nullable',
            'third_name' => 'nullable',
            'first_surname' => 'required',
            'second_surname' => 'nullable',
            'sex' => 'required',
            'status' => ['required', 'numeric'],
            'birthday' => ['required', 'date', 'before:today'],
            'death_date' => ['date', 'before:tomorrow', 'nullable'],
            'e_mail' => ['email', 'nullable'],
            'cellphone' => 'nullable',
            'diseases' => 'nullable',
            'handicaps' => 'nullable',
            'preferences' => 'nullable',
            'religion' => ['numeric', 'nullable']
        ]);

        if ($request->diseases)
        {
            $person_data['diseases'] = explode(',', $request->diseases);
        }

        if ($request->handicaps)
        {
            $person_data['handicaps'] = explode(',', $request->handicaps);
        }        

        $person_data['preferences'] = $request->preferences;

        $membership_data = $request->validate([
            'campus_id' => ['numeric', 'nullable'],
            'accepted' => ['required', 'numeric'],
            'date_accepted' =>['date', 'before:tomorrow', 'nullable'],
            'baptized' => ['required', 'numeric'],
            'date_baptized' =>['date', 'before:tomorrow', 'nullable'],
            'discipleship' => ['required', 'numeric'],
            'member' => 'required',
            'attend_church' => ['numeric', 'nullable'],
            'reason' => 'nullable'
        ]);

        if ($membership_data['member'] != Person::MEMBER) {
            $membership_data['attend_church'] = NULL;
            $membership_data['campus_id'] = NULL;
        }

        $relation_data = $request->validate([
            'family_role' => ['required', 'numeric']
        ]);

        $person_data['updated_by'] = Auth::id();
        $person->fill($person_data);
        $person->save();

        $membership = $person->membership;
        $membership_data['updated_by'] = Auth::id();
        $membership->fill( $membership_data);
        $membership->save();

        $family = $person->family();

        $family_members = $family->pivot;
        $relation_data['updated_by'] = Auth::id();
        $family_members->fill($relation_data);
        $family_members->save();

        // check if all family members are active, else the family got inactive (active=0)
        $active_members = $family->members()->where('death_date', null)->count();
        $family->active = $active_members ? 1 : 0;
        $family->save();

        return redirect('/members');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Person $person
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Person $person)
    {
        Gate::authorize('administer');

        $family_id = $request->get('family_id');

        try {
            if (($person->privilege_history()->count() > 0) or ($person->disciplines()->count() > 0 )) {
                return redirect('/family/' . $family_id)->with('error','No pudieron eliminarse datos de ' . $person->full_name . ', elimine primero privilegios o disciplinas asociadas.');
            }

            $person->membership()->delete();
            $person->families()->detach();
            $person->delete();
        } catch (QueryException $e) {
            return redirect('/family/' . $family_id)->with('error','No pudieron eliminarse datos de ' . $person->full_name . '.');
        }

        return redirect('/family/' . $family_id)->with('info', 'Datos de ' . $person->full_name . ' eliminados.');
    }
}
