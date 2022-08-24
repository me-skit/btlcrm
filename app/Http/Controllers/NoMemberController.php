<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use Illuminate\Support\Facades\DB;
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
            $query = str_replace(" ", "%", $request->get('query'));
            $people = Person::where('death_date', null)
                        ->join('memberships', function($query) {
                            $query->on('people.id', '=', 'memberships.person_id')
                                ->where('memberships.member', 0);
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
                             ->where('memberships.member', 0);
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

        return view('people.nomembers.show', compact('person'));
    }
}
