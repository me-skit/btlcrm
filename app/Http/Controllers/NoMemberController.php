<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\Gate;

class NoMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('consult');

        if ($request->get('query'))
        {
            $substr = str_replace(" ", "%", $request->get('query'));
            $people = Person::queryPeopleByMembership(Person::NO_MEMBER, $substr);

            return view('people.nomembers.pagination', compact('people'));
        }

        $people = Person::getPeopleByMembership(Person::NO_MEMBER);
        
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

        return view('people.nomembers.show', compact('person'));
    }
}
