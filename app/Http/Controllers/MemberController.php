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
}
