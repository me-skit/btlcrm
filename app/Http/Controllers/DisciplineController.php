<?php

namespace App\Http\Controllers;

use App\Http\Requests\DisciplineRequest;
use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Discipline;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class DisciplineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('administer');

        $all = DB::table('disciplines')
               ->where('ended', '0')
               ->join('people', 'disciplines.person_id', '=', 'people.id')
               ->select('people.id as person_id', 'first_name', 'second_name', 'third_name', 'first_surname', 'second_surname', 'cellphone', 'start_date', 'end_date', 'act_number', 'discipline_type', 'disciplines.id as discipline_id')
               ->orderBy('first_name')
               ->orderBy('second_name')
               ->orderBy('third_name')
               ->orderBy('first_surname')
               ->orderBy('second_surname')
               ->get();

        $active = $all->filter(function ($item) {
            return $item->end_date === null or $item->end_date >= date('Y-m-d');
        });

        $expired = $all->filter(function ($item) {
            return $item->end_date !== null and $item->end_date < date('Y-m-d');
        });

        return view('disciplinehistory.current', compact('active', 'expired'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function end(DisciplineRequest $request, $id)
    {
        Gate::authorize('administer');

        $data = $request->validated();

        $discipline = Discipline::findOrFail($id);
        $discipline->ended = 1;
        $discipline->end_date = $data['end_date'];
        $discipline->updated_by = Auth::id();
        $discipline->save();

        $all = DB::table('disciplines')
               ->where('ended', '0')
               ->join('people', 'disciplines.person_id', '=', 'people.id')
               ->select('people.id as person_id', 'first_name', 'second_name', 'third_name', 'first_surname', 'second_surname', 'cellphone', 'start_date', 'end_date', 'act_number', 'discipline_type', 'disciplines.id as discipline_id')
               ->orderBy('first_name')
               ->orderBy('second_name')
               ->orderBy('third_name')
               ->orderBy('first_surname')
               ->orderBy('second_surname')
               ->get();

        $active = $all->filter(function ($item) {
            return $item->end_date === null or $item->end_date >= date('Y-m-d');
        });

        $expired = $all->filter(function ($item) {
            return $item->end_date !== null and $item->end_date < date('Y-m-d');
        });

        return view('disciplinehistory.list', compact('active', 'expired'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DisciplineRequest $request)
    {
        //Gate::authorize('administer');

        $data = $request->validated();

        $discipline = new Discipline();
        $discipline->fill($data);
        $discipline->created_by = Auth::id();
        $discipline->save();

        $person = Person::findOrFail($data['person_id']);

        return view('disciplinehistory.index', compact('person'));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Discipline $discipline)
    {
        Gate::authorize('administer');

        return view('disciplinehistory.edit', compact('discipline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DisciplineRequest $request, Discipline $discipline)
    {
        Gate::authorize('administer');

        $data = $request->validated();

        $discipline->fill($data);
        $discipline->updated_by = Auth::id();
        $discipline->save();

        $person = $discipline->person;

        return view('disciplinehistory.index', compact('person'));         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discipline $discipline)
    {
        Gate::authorize('administer');
        
        $discipline->delete();

        $person = $discipline->person;

        return view('disciplinehistory.index', compact('person'));        
    }
}
