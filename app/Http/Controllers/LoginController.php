<?php

namespace App\Http\Controllers;

use App\Models\login;
use App\Http\Requests\StoreloginRequest;
use App\Http\Requests\UpdateloginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.login');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            // if (auth()->user()->role == 'admin') {
            //     return redirect()->intended('/siswa');
            // } elseif (auth()->user()->role == 'guru' ) {
            //     return redirect()->intended('/superAdmin');
            // }
            return redirect()->intended('/dashboard');
            // return redirect('/dashboard');
        } else {
            // gagal login
            return back()->with('loginError', 'Login Failed. Please check your credentials.');
        }
        // dd($request);
        // return back()->with('loginError', 'Login Failed');
    }

    public function login()
    {
        //
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreloginRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateloginRequest $request, login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(login $login)
    {
        //
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}