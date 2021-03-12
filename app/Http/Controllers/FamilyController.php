<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Village;
use App\Models\Campus;
use App\Models\Person;
use App\Models\Privilege;
use App\Models\Membership;
use App\Models\FamilyMember;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $families = Family::with('village')->get();

        return view('families.index', compact('families'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $villages = Village::all();

        return view('families.create', compact('villages'));
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
            'village_id' => 'required',
            'union_type' => 'required',
            'family_name' => 'required',
            'address' => 'required',
            'phone_number' => 'nullable',
            'longitude' => ['numeric', 'nullable'],
            'latitude' => ['numeric', 'nullable']
        ]);
        
        $family = Family::create($data);

        return redirect('/family/' . $family->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $family = Family::findOrFail($id);
        $villages = Village::all();
        $campuses = Campus::all();
        $privileges = Privilege::all();

        $sexes = array('M' => 'male', 'F' => 'female');
        $statuses = array(1 => 'married', 2 => 'single');

        return view('families.show', compact('family', 'villages', 'campuses', 'privileges', 'sexes', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Family $family)
    {
        $data = $request->validate([
            'village_id' => 'required',
            'union_type' => 'required',
            'av_st_number' => ['numeric', 'nullable'],
            'is_av_st' => 'numeric',
            'house_number' => 'nullable',
            'zone' => ['numeric', 'nullable'],
            'addr_extra_info' => 'nullable',
            'phone_number' => 'nullable',
            'longitude' => ['numeric', 'nullable'],
            'latitude' => ['numeric', 'nullable']
        ]);
        
        $family->fill($data);
        $family->save();

        return redirect('/family/' . $family->id);
    }

    /**
     * Store a newly created person resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function addmember(Request $request, $id)
    {
        $person_data = $request->validate([
            'first_name' => 'required',
            'second_name' => 'nullable',
            'third_name' => 'nullable',
            'first_surname' => 'required',
            'second_surname' => 'nullable',
            'sex' => 'required',
            'status' => ['required', 'numeric'],
            'birthday' => ['required', 'date', 'before:today'],
            'e_mail' => ['email', 'nullable'],
            'cellphone' => ['numeric', 'nullable'],
            'diseases' => 'nullable',
            'handicaps' => 'nullable',
            'preferences' => 'nullable'
        ]);

        $membership_data = $request->validate([
            'campus_id' => ['numeric', 'nullable'],
            'accepted' => ['required', 'numeric'],
            'date_accepted' =>['date', 'before:tomorrow', 'nullable'],
            'baptized' => ['required', 'numeric'],
            'date_baptized' =>['date', 'before:tomorrow', 'nullable'],
            'discipleship' => ['required', 'numeric'],
            'attend_church' => ['required', 'numeric']
        ]);

        // attend_church in membership could be: 0:no, 1:yes, 2:another church
        $attend = $membership_data['attend_church'];
        if ($attend == '0' or $attend == '2')
        {
            // status in membership could be: 0:inactive, 1:active, 2:passed away
            $membership_data['status'] = '0';
        }

        $relation_data = $request->validate([
            'family_role' => ['required', 'numeric']
        ]);

        $person = Person::create($person_data);

        $membership_data['person_id'] = $person->id;
        $membership = Membership::create($membership_data);

        $relation_data['family_id'] = $id;
        $relation_data['person_id'] = $person->id;
        FamilyMember::create($relation_data);

        return redirect('/family/' . $id);
    }

    /**
     * Store a newly created person resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param $family_id
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function editmember(Request $request, $family_id, Person $person)
    {
        $family = $person->family();
        $campuses = Campus::all();
        $privileges = Privilege::all();

        $sexes = array('M' => 'male', 'F' => 'female');
        $statuses = array(1 => 'married', 2 => 'single');

        return view('families.editmember', compact('person', 'family', 'campuses', 'privileges', 'sexes', 'statuses'));
    }

    /**
     * Store a newly created person resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $family_id
     * @param  \App\Models\Person  $person
     * @return \Illuminate\Http\Response
     */
    public function updatemember(Request $request, $family_id, Person $person)
    {
        $person_data = $request->validate([
            'first_name' => 'required',
            'second_name' => 'nullable',
            'third_name' => 'nullable',
            'first_surname' => 'required',
            'second_surname' => 'nullable',
            'sex' => 'required',
            'status' => ['required', 'numeric'],
            'birthday' => ['required', 'date', 'before:today'],
            'death_date' => ['date', 'nullable'],
            'e_mail' => ['email', 'nullable'],
            'cellphone' => ['numeric', 'nullable'],
            'diseases' => 'nullable',
            'handicaps' => 'nullable',
            'preferences' => 'nullable'
        ]);

        $membership_data = $request->validate([
            'campus_id' => ['numeric', 'nullable'],
            'accepted' => ['required', 'numeric'],
            'date_accepted' =>['date', 'before:tomorrow', 'nullable'],
            'baptized' => ['required', 'numeric'],
            'date_baptized' =>['date', 'before:tomorrow', 'nullable'],
            'discipleship' => ['required', 'numeric'],
            'attend_church' => ['required', 'numeric']
        ]);

        // attend_church in membership could be: 0:no, 1:yes, 2:another church
        $attend = $membership_data['attend_church'];
        if ($attend == '1')
        {
            // status in membership could be: 0:inactive, 1:active, 2:passed away
            $membership_data['status'] = '1';
        }
        else
        {
            $membership_data['status'] = '0';
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
        
        $person->fill($person_data);
        $person->save();

        $membership = $person->membership;
        $membership->fill( $membership_data);
        $membership->save();

        $family = $person->family();

        $family_members = $family->pivot;
        $family_members->fill($relation_data);
        $family_members->save();

        // check if all family members are active, if there is no one active=1 family active=0, meninng inactive
        $plucked = $family_members->pluck('active')->toArray();
        if (!in_array(1, $plucked))
        {
            $family->active = 0;
            $family->save();
        }

        return redirect('/family/' . $family_id);
    }
}
