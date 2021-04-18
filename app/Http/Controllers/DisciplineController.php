<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Discipline;
use Illuminate\Support\Facades\Gate;

class DisciplineController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('administer');

        $data = $request->validate([
            'person_id' => 'required',
            'discipline_type' =>'required',
            'act_number' => 'required',
            'start_date' => ['required', 'date'],
            'end_date' => ['date', 'nullable']
        ]);

        Discipline::create($data);

        $person = Person::findOrFail($data['person_id']);
        $disciplines = $person->disciplines;

        return view('disciplinehistory.index', compact('disciplines'));        
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
    public function update(Request $request, Discipline $discipline)
    {
        Gate::authorize('administer');

        $data = $request->validate([
            'discipline_type' =>'required',
            'act_number' => 'required',
            'start_date' => ['required', 'date'],
            'end_date' => ['date', 'nullable']
        ]);

        $discipline->fill($data);
        $discipline->save();

        $person = $discipline->person;
        $disciplines = $person->disciplines;

        return view('disciplinehistory.index', compact('disciplines'));         
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
        $disciplines = $person->disciplines;

        return view('disciplinehistory.index', compact('disciplines'));        
    }
}
