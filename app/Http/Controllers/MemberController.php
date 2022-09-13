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
        $icon = 'far fa-users';

        if ($request->get('query'))
        {
            $substr = str_replace(" ", "%", $request->get('query'));
            $people = Person::queryMembersBy('baptized', Person::UNBAPTIZED, $substr);

            return view('people.pagination', compact('people', 'address', 'title', 'icon'));            
        }

        $people = Person::getMembersBy('baptized', Person::UNBAPTIZED);

        if ($request->get('page'))
        {
            return view('people.pagination', compact('people', 'address', 'title', 'icon'));
        }

        return view('people.index', compact('people', 'address', 'title', 'icon'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function accepted(Request $request)
    {
        Gate::authorize('consult');

        $address = "members/accepted";
        $title = 'Aceptados';

        if ($request->get('query'))
        {
            $substr = str_replace(" ", "%", $request->get('query'));
            $people = Person::queryMembersBy('accepted', Person::ACCEPTED, $substr);

            return view('people.pagination', compact('people', 'address', 'title'));            
        }

        $people = Person::getMembersBy('accepted', Person::ACCEPTED);

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

    public function unaccepted(Request $request)
    {
        Gate::authorize('consult');
    
        $address = "members/unaccepted";
        $title = 'No Aceptados';
        $icon = 'far fa-users';

        if ($request->get('query'))
        {
            $substr = str_replace(" ", "%", $request->get('query'));
            $people = Person::queryMembersBy('accepted', Person::UNACCEPTED, $substr);

            return view('people.pagination', compact('people', 'address', 'title', 'icon'));            
        }

        $people = Person::getMembersBy('accepted', Person::UNACCEPTED);

        if ($request->get('page'))
        {
            return view('people.pagination', compact('people', 'address', 'title', 'icon'));
        }

        return view('people.index', compact('people', 'address', 'title', 'icon'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function withdiseases(Request $request)
    {
        Gate::authorize('consult');
    
        $address = "members/withdiseases";
        $title = 'Enfermos';
        $icon = 'fas fa-procedures';

        if ($request->get('query'))
        {
            $substr = str_replace(" ", "%", $request->get('query'));
            $people = Person::queryMembersWith('diseases', $substr);

            return view('people.pagination', compact('people', 'address', 'title', 'icon'));            
        }

        $people = Person::getMembersWith('diseases');

        if ($request->get('page'))
        {
            return view('people.pagination', compact('people', 'address', 'title', 'icon'));
        }

        return view('people.index', compact('people', 'address', 'title', 'icon'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function withhandicaps(Request $request)
    {
        Gate::authorize('consult');
    
        $address = "members/withhandicaps";
        $title = 'Enfermos';
        $icon = 'fas fa-wheelchair';

        if ($request->get('query'))
        {
            $substr = str_replace(" ", "%", $request->get('query'));
            $people = Person::queryMembersWith('handicaps', $substr);

            return view('people.pagination', compact('people', 'address', 'title', 'icon'));            
        }

        $people = Person::getMembersWith('handicaps');

        if ($request->get('page'))
        {
            return view('people.pagination', compact('people', 'address', 'title', 'icon'));
        }

        return view('people.index', compact('people', 'address', 'title', 'icon'));
    }
}
