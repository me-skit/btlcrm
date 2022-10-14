<?php

namespace App\Http\Controllers;

use App\Models\Family;
use App\Models\Person;
use App\Models\Privilege;
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

        if ($request->get('query'))
        {
            $substr = str_replace(" ", "%", $request->get('query'));
            $people = Person::queryPeopleByMembership(Person::MEMBER, $substr);

            return view('people.pagination', compact('people'));            
        }

        $people = Person::getPeopleByMembership(Person::MEMBER);

        if ($request->get('page'))
        {
            return view('people.pagination', compact('people'));
        }

        $address = "members";
        $title = 'Miembros';

        return view('people.index', compact('people', 'address', 'title'));
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
    
        if ($request->get('query'))
        {
            $substr = str_replace(" ", "%", $request->get('query'));
            $people = Person::queryMembersWith('diseases', $substr);

            return view('people.pagination', compact('people'));            
        }

        $people = Person::getMembersWith('diseases');

        if ($request->get('page'))
        {
            return view('people.pagination', compact('people'));
        }

        $address = "members/withdiseases";
        $title = 'Enfermos';
        $icon = 'fas fa-procedures';        

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
    
        if ($request->get('query'))
        {
            $substr = str_replace(" ", "%", $request->get('query'));
            $people = Person::queryMembersWith('handicaps', $substr);

            return view('people.pagination', compact('people'));            
        }

        $people = Person::getMembersWith('handicaps');

        if ($request->get('page'))
        {
            return view('people.pagination', compact('people'));
        }


        $address = "members/withhandicaps";
        $title = 'Enfermos';
        $icon = 'fas fa-wheelchair';

        return view('people.index', compact('people', 'address', 'title', 'icon'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bypreferences(Request $request)
    {
        Gate::authorize('consult');

        $privilege_id = $request->get('privilege_id') ?? '1';

        $people = Person::where('preferences', 'LIKE', '%"'. $privilege_id .'"%')
                    ->orderBy('first_name')
                    ->orderBy('second_name')
                    ->orderBy('third_name')
                    ->orderBy('first_surname')
                    ->orderBy('second_surname')            
                    ->paginate(35);

        if ($request->get('privilege_id') or $request->get('page'))
        {
            return view('people.pagination', compact('people'));
        }

        $privileges = Privilege::all();
        $address = "members/bypreferences";
        return view('people.bypreferences.index', compact('people', 'privileges', 'address'));
    }

    /**
     * Show the a form.
     *
     * @return \Illuminate\Http\Response
     */
    public function queryform(Request $request)
    {
        Gate::authorize('consult');

        $address = "members/byquery";
        return view('people.byquery.index', compact('address'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function queryresult(Request $request)
    {
        Gate::authorize('consult');

        $people = Person::queryMembers($request->get('accepted'), $request->get('baptized'), $request->get('status'), $request->get('sex'), $request->get('min'), $request->get('max'));

        return view('people.pagination', compact('people'));
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function statistics(Request $request)
    {
        $total_members = Person::totalMembers();
        $total_families = Family::total();

        $zone_distribution = Family::distributionByZone();
        $sex_distribution = Person::distributionBySex();
        $service_distribution = Person::distributionByOcupation();
        $illness_distribution = Person::distributionByIllness();

        return view('people.statistics.index', compact('total_members', 'total_families', 'zone_distribution', 'sex_distribution', 'service_distribution', 'illness_distribution'));
    }
}
