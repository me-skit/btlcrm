<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        Gate::authorize('consult');

        $address = "members";
        $title = 'Miembros';

        if ($request->get('query'))
        {
            $substr = str_replace(" ", "%", $request->get('query'));
            $people = Person::queryPeopleByMembership(Person::MEMBER, $substr);

            return view('people.pagination', compact('people', 'address', 'title'));            
        }

        $people = Person::getPeopleByMembership(Person::MEMBER);

        if ($request->get('page'))
        {
            return view('people.pagination', compact('people', 'address', 'title'));
        }

        return view('people.index', compact('people', 'address', 'title'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function baptized(Request $request)
    {
        Gate::authorize('consult');

        $address = "members/baptized";
        $title = 'Bautizados';

        if ($request->get('query'))
        {
            $substr = str_replace(" ", "%", $request->get('query'));
            $people = Person::queryMembersBy('baptized', Person::BAPTIZED, $substr);

            return view('people.pagination', compact('people', 'address', 'title'));            
        }

        $people = Person::getMembersBy('baptized', Person::BAPTIZED);

        if ($request->get('page'))
        {
            return view('people.pagination', compact('people', 'address', 'title'));
        }

        return view('people.index', compact('people', 'address', 'title'));
    }


    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function unbaptized(Request $request)
    {
        Gate::authorize('consult');
    
        $address = "members/unbaptized";
        $title = 'No Bautizados';

        if ($request->get('query'))
        {
            $substr = str_replace(" ", "%", $request->get('query'));
            $people = Person::queryMembersBy('baptized', Person::NO_BAPTIZED, $substr);

            return view('people.pagination', compact('people', 'address', 'title'));            
        }

        $people = Person::getMembersBy('baptized', Person::NO_BAPTIZED);

        if ($request->get('page'))
        {
            return view('people.pagination', compact('people', 'address', 'title'));
        }

        return view('people.index', compact('people', 'address', 'title'));
    }
}
