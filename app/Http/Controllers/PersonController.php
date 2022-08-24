<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Campus;
use App\Models\Privilege;
use Illuminate\Http\Request;
use App\Models\PrivilegeRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class PersonController extends Controller
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
        Gate::authorize('consult');

        if ($request->get('type') and $request->get('type') > 1)
        {
            $query_type = $request->get('type');
            $people = null;

            if ($query_type == 2) {
                $people = Person::where('death_date', null)
                            ->join('memberships', function($query) use ($request) {
                                $query->on('people.id', '=', 'memberships.person_id')
                                    ->where('memberships.member', 1)
                                    ->where('campus_id', $request->get('id'));
                            })
                            ->orderBy('first_name')
                            ->orderBy('second_name')
                            ->orderBy('third_name')
                            ->orderBy('first_surname')
                            ->orderBy('second_surname')
                            ->with('membership')
                            ->paginate(7);
            }
            else if ($query_type == 3) {
                $people = Person::where('death_date', null)
                            ->where('preferences', 'like', '%\"' . $request->get('id') . '\"%')
                            ->join('memberships', function($query) {
                                $query->on('people.id', '=', 'memberships.person_id')
                                    ->where('memberships.member', 1);
                            })
                            ->orderBy('first_name')
                            ->orderBy('second_name')
                            ->orderBy('third_name')
                            ->orderBy('first_surname')
                            ->orderBy('second_surname')
                            ->with('membership')
                            ->paginate(7);
            }
            else if ($query_type >= 4 and $query_type <= 7) {
                $field = ($query_type == 4 || $query_type == 5) ? 'baptized' : 'accepted';
                $value = ($query_type % 2) ? 0 : 1;

                $people = Person::where('death_date', null)
                            ->join('memberships', function($query) use ($field, $value) {
                                $query->on('people.id', '=', 'memberships.person_id')
                                    ->where('memberships.member', 1)
                                    ->where($field, $value);
                            })
                            ->orderBy('first_name')
                            ->orderBy('second_name')
                            ->orderBy('third_name')
                            ->orderBy('first_surname')
                            ->orderBy('second_surname')
                            ->with('membership')
                            ->paginate(7);
            }
            else if ($query_type == 8 or $query_type == 9) {
                $field = ($query_type == 8) ? 'diseases' : 'handicaps';

                $people = Person::where('death_date', null)
                            ->whereNotNull($field)
                            ->join('memberships', function($query) {
                                $query->on('people.id', '=', 'memberships.person_id')
                                    ->where('memberships.member', 1);
                            })
                            ->orderBy('first_name')
                            ->orderBy('second_name')
                            ->orderBy('third_name')
                            ->orderBy('first_surname')
                            ->orderBy('second_surname')
                            ->with('membership')
                            ->paginate(7);
            }

            return view('people.pagination', compact('people'));
        }

        if ($request->get('query'))
        {
            $query = str_replace(" ", "%", $request->get('query'));
            $people = Person::where('death_date', null)
                        ->join('memberships', function($query) {
                            $query->on('people.id', '=', 'memberships.person_id')
                                ->where('memberships.member', 1);
                        })
                        ->where(DB::raw('CONCAT_WS(" ", first_name, second_name, third_name, first_surname, second_surname)'), 'like', '%' . $query . '%')
                        ->orderBy('first_name')
                        ->orderBy('second_name')
                        ->orderBy('third_name')
                        ->orderBy('first_surname')
                        ->orderBy('second_surname')
                        ->with('membership')
                        ->paginate(7);

            return view('people.pagination', compact('people'));            
        }

        $people = Person::where('death_date', null)
                    ->join('memberships', function($query) {
                        $query->on('people.id', '=', 'memberships.person_id')
                             ->where('memberships.member', 1);
                    })
                    ->orderBy('first_name')
                    ->orderBy('second_name')
                    ->orderBy('third_name')
                    ->orderBy('first_surname')
                    ->orderBy('second_surname')
                    ->with('membership')
                    ->paginate(7);

        if ($request->get('page'))
        {
            return view('people.pagination', compact('people'));
        }

        $campuses = Campus::all();
        $privileges = Privilege::all();

        return view('people.index', compact('people', 'campuses', 'privileges'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function no_members(Request $request)
    {
        Gate::authorize('consult');

        if ($request->get('query'))
        {
            $query = str_replace(" ", "%", $request->get('query'));
            $people = Person::where('death_date', null)
                        ->join('memberships', function($query) {
                            $query->on('people.id', '=', 'memberships.person_id')
                                ->where('memberships.attend_church', 0);
                        })
                        ->where(DB::raw('CONCAT_WS(" ", first_name, second_name, third_name, first_surname, second_surname)'), 'like', '%' . $query . '%')
                        ->orderBy('first_name')
                        ->orderBy('second_name')
                        ->orderBy('third_name')
                        ->orderBy('first_surname')
                        ->orderBy('second_surname')
                        ->paginate(7);

            return view('people.nomembers.pagination', compact('people'));
        }

        $people = Person::where('death_date', null)
                    ->join('memberships', function($query) {
                        $query->on('people.id', '=', 'memberships.person_id')
                             ->where('memberships.attend_church', 0);
                    })
                    ->orderBy('first_name')
                    ->orderBy('second_name')
                    ->orderBy('third_name')
                    ->orderBy('first_surname')
                    ->orderBy('second_surname')
                    ->paginate(7);
        
        if ($request->get('page'))
        {
            return view('people.nomembers.pagination', compact('people'));
        }

        return view('people.nomembers.index', compact('people'));
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

    public function show_nomember(Person $person)
    {
        Gate::authorize('consult');

        $family = $person->family();
        return view('people.nomembers.show', compact('person', 'family'));
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
            'dpi' => ['numeric', 'nullable'],
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
            'preferences' => 'nullable'
        ]);

        if ($request->diseases)
        {
            $person_data['diseases'] = explode(',', $request->diseases);
        }

        if ($request->handicaps)
        {
            $person_data['handicaps'] = explode(',', $request->handicaps);
        }        

        $membership_data = $request->validate([
            'campus_id' => ['numeric', 'nullable'],
            'accepted' => ['required', 'numeric'],
            'date_accepted' =>['date', 'before:tomorrow', 'nullable'],
            'baptized' => ['required', 'numeric'],
            'date_baptized' =>['date', 'before:tomorrow', 'nullable'],
            'discipleship' => ['required', 'numeric'],
            'attend_church' => ['required', 'numeric'],
            'reason' => 'nullable'
        ]);

        // attend_church in membership could be: 0:no, 1:yes, 2:occasionally, 3:problem attending, -1:another church
        $attend = $membership_data['attend_church'];
        if ($attend == '0' or $attend == '-1')
        {
            // status in membership could be: 0:inactive, 1:active, 2:passed away
            $membership_data['status'] = '0';
        }
        else
        {
            $membership_data['status'] = '1';
        }

        $relation_data = $request->validate([
            'family_role' => ['required', 'numeric']
        ]);

        // setting death_date means the person passed away
        if ($person_data['death_date'])
        {
            // status in membership and family_members could be: 0:inactive, 1:active, 2:passed away
            $membership_data['status'] = '2';
            $relation_data['active'] = '2';
        }
        
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

        // check if all family members are active=0, if there is no one family is set inactive (active=0)
        $plucked = $family->members()->pluck('active')->toArray();
        if (!in_array(1, $plucked))
        {
            $family->active = 0;
            $family->save();
        }

        return redirect('/members');
    }
}
