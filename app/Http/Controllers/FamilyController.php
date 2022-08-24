<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Village;
use App\Models\Campus;
use App\Models\Person;
use App\Models\Privilege;
use App\Models\PrivilegeRole;
use App\Models\Membership;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FamilyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a map for families.
     */
    public function mapping()
    {
        return view('families.mapping');
    }

    /**
     * Return listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function bunch()
    {
        $families = Family::where('active', 1)
                            ->whereNotNull('latitude')
                            ->whereNotNull('longitude')
                            ->select('family_name as name', 'address', 'latitude', 'longitude')
                            ->paginate(50);

        return $families->toJson();
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
            $families = Family::where('active', 1)
                            ->where('family_name', 'like', '%' . $query . '%')
                            ->orderBy('created_at', 'DESC')
                            // ->orderBy('family_name')
                            ->with('village')
                            ->paginate(7);

            return view('families.pagination', compact('families'));
        }

        $families = Family::where('active', 1)
                        // ->orderBy('family_name')
                        ->orderBy('created_at', 'DESC')
                        ->with('village')
                        ->paginate(7);

        if ($request->get('page'))
        {
            return view('families.pagination', compact('families'));
        }

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
            'phone_number' => 'nullable'
        ]);

        if ($request->input('location'))
        {
            $location = explode(",", $request->input('location'));
            $data['latitude'] = $location[0];
            $data['longitude'] = $location[1];
        }

        $data['created_by'] = Auth::id();
        $family = Family::create($data);

        $back = $request->get('back') ? $request->get('back') : '';
        return redirect('/family/' . $family->id . '?back=' . $back);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Family $family)
    {
        $villages = Village::all();
        $campuses = Campus::all();
        $privileges = Privilege::all();
        $privilege_roles = PrivilegeRole::orderBy('name')->get();

        $sexes = array('M' => 'male', 'F' => 'female');
        $statuses = array(1 => 'single', 2 => 'married');

        $back = $request->get('back') ? $request->get('back') : '';
        return view('families.show', compact('family', 'villages', 'campuses', 'privileges', 'privilege_roles', 'sexes', 'statuses', 'back'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Family $family)
    {
        $villages = Village::all();

        return view('families.edit', compact('family', 'villages'));
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
            'family_name' => 'required',
            'address' => 'required',
            'phone_number' => 'nullable'
        ]);

        if ($request->input('location'))
        {
            $location = explode(",", $request->input('location'));
            $data['latitude'] = $location[0];
            $data['longitude'] = $location[1];
        }
        else
        {
            $data['latitude'] = null;
            $data['longitude'] = null;
        }

        $data['updated_by'] = Auth::id();
        $family->fill($data);
        $family->save();

        $back = $request->get('back') ? $request->get('back') : '';
        return redirect('/family/' . $family->id . '?back=' . $back);
    }

    /**
     * Show the form to create a new member.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Family  $family
     * @return \Illuminate\Http\Response
     */
    public function createmember(Request $request, Family $family)
    {
        $campuses = Campus::all();
        $privileges = Privilege::all();

        $back = $request->get('back') ? $request->get('back') : '';
        return view('families.members.create', compact('family', 'campuses', 'privileges', 'back'));
    }

    /**
     * Store a newly created person resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function addmember(Request $request, $family_id)
    {
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
            'member' => 'required',
            'attend_church' => ['numeric', 'nullable'],
            'reason' => 'nullable'
        ]);

        $relation_data = $request->validate([
            'family_role' => ['required', 'numeric']
        ]);

        $person_data['created_by'] = Auth::id();
        $person = Person::create($person_data);

        $membership_data['person_id'] = $person->id;
        $membership_data['created_by'] = Auth::id();
        Membership::create($membership_data);

        $relation_data['family_id'] = $family_id;
        $relation_data['person_id'] = $person->id;
        $relation_data['created_by'] = Auth::id();
        FamilyMember::create($relation_data);

        $back = $request->get('back') ? $request->get('back') : '';
        return redirect('/family/' . $family_id . '?back=' . $back);
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

        $back = $request->get('back') ? $request->get('back') : '';
        return view('families.members.edit', compact('person', 'family', 'campuses', 'privileges', 'back'));
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
            'member' => 'required',
            'attend_church' => ['required', 'numeric'],
            'reason' => 'nullable'
        ]);

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

        $back = $request->get('back') ? $request->get('back') : '';
        return redirect('/family/' . $family_id . '?back=' . $back);
    }
}
