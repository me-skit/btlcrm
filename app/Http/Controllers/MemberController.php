<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Campus;
use App\Models\Privilege;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        return view('people.index', compact('people'));
    }
}
