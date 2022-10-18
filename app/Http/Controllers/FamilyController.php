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
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Database\QueryException;

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
                            ->select('family_name as name', 'address', 'zone', 'latitude', 'longitude')
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
                            ->with('village', 'user')
                            ->paginate(15);

            return view('families.pagination', compact('families'));
        }

        $families = Family::where('active', 1)
                        // ->orderBy('family_name')
                        ->orderBy('created_at', 'DESC')
                        ->with('village', 'user')
                        ->paginate(15);

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
            'zone' => 'nullable',
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

        return redirect('/family/' . $family->id);
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

        return view('families.show', compact('family', 'villages', 'campuses', 'privileges', 'privilege_roles'));
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
            'zone' => 'nullable',
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

        return redirect('/family/' . $family->id);
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

        return view('families.members.create', compact('family', 'campuses', 'privileges'));
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

        return redirect('/family/' . $family_id);
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

        return view('families.members.edit', compact('person', 'family', 'campuses', 'privileges'));
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

        return redirect('/family/' . $family_id);
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  Family  $family
     * @return \Illuminate\Http\Response
     */
    public function destroy(Family $family)
    {
        Gate::authorize('administer');
        
        try {
            $family->delete();
        } catch (QueryException $e) {
            return redirect('/family/' . $family->id)->with('error','Familia no puede eliminarse, tiene elementos dependientes');
        }

        return redirect('/families')->with('info', 'Familia ' . $family->family_name . ' eliminada.');
    }
}
