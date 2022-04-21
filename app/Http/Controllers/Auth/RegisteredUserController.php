<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\Settings;    

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $data['users'] = User::all();
        $data['settings'] = Settings::where('id', '<', 10)->first();
        return view('admin.manageStaff', $data);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // print_r($request->all());
        // die();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
        ]);

        if($request->password !== $request->password2) {
            return back()->withInput()
            ->withErrors('Passwords do not match');
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'role' => $request->role,
                'password' =>  $request->password
            ]);            
        } catch (Exception $e) {
            return back()->withError('Could not add user. Possible duplicate records');
        }


        return back()->with('success', 'Registration successful.');
    }

    public function show($id)
    {
        $data['users'] = User::all();
        $data['settings'] = Settings::where('id', '<', 10)->first();
         return view('admin.employee.edit', $data);
    }
}
