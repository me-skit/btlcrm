<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Gate::authorize('administer');

        if ($request->get('query'))
        {
            $query = $request->get('query');
            $users = User::where('email', 'like', '%' . $query . '%')
                            ->orderBy('created_at', 'desc')
                            ->paginate(7);

            return view('users.pagination', compact('users'));
        }

        if ($request->get('page'))
        {
            $users = User::orderBy('created_at', 'desc')->paginate(7);

            return view('users.pagination', compact('users'));
        }
        
        $users = User::orderBy('created_at', 'desc')->paginate(7);

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('administer');

        return view('users.create');
    }

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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'sex' => 'required',
            'role' => 'required'
        ]);

        $pass = Str::random(8);
        $data['password'] = Hash::make($pass);
        $data['active'] = 1;
        $user = User::create($data);

        Mail::to($user->email)->send(new WelcomeMail($pass));

        return redirect('/users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        Gate::authorize('administer');

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        Gate::authorize('administer');

        $data = $request->validate([
            'role' => 'required',
            'sex' => 'required',
            'active' => 'required'
        ]);

        $user->role = $data['role'];
        $user->sex = $data['sex'];
        $user->active = $data['active'];
        $user->save();

        return redirect('/users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function change()
    {
        return view('users.password.change');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reset(Request $request)
    {
        $data = $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8']
        ]);

        if (!Hash::check($data['current_password'], auth()->user()->password)) {
            return back()->with('error', 'Su contraseña actual no es correcta');
        }

        $user = auth()->user();
        $user->password = Hash::make($data['password']);
        $user->save();

        return back()->with("success","Su contraseña fue cambiada correctamente");
    }
}
