<?php

namespace App\Http\Controllers;

use App\Models\email;
use App\Models\perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        $emails = [];
        if ($role === 'superAdmin') {
            $emails = email::with('perusahaan')->get();
        } else {
            $emails = email::with('perusahaan')->where('id_perusahaan', Auth::user()->id_perusahaan)->get();
        }
        return view('admin.email.homeEmail', [
            'emails' => $emails,
            'role' => $role
        ]);
    }

    public function create()
    {
        $role = Auth::user()->role;
        if ($role === 'superAdmin') {
            $perusahaans = perusahaan::all();
        } else {
            $perusahaans = perusahaan::where('id_perusahaan', Auth::user()->id_perusahaan)->get();
        }
        return view('admin.email.createEmail', compact('perusahaans', 'role'));
    }

    public function store(Request $request)
    {
        $role = Auth::user()->role;
        $rules = [
            'nama' => 'required',
            'email' => 'required|email',
            'pesan' => 'required',
        ];
        if ($role === 'superAdmin') {
            $rules['id_perusahaan'] = 'required|exists:perusahaans,id_perusahaan';
        }
        $validatedData = $request->validate($rules);
        if ($role !== 'superAdmin') {
            $validatedData['id_perusahaan'] = Auth::user()->id_perusahaan;
        }
        email::create($validatedData);
        return redirect('/dashboard/email')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(email $email)
    {
        $role = Auth::user()->role;
        if ($role === 'superAdmin') {
            $perusahaans = perusahaan::all();
        } else {
            $perusahaans = perusahaan::where('id_perusahaan', Auth::user()->id_perusahaan)->get();
        }
        return view('admin.email.email-edit', [
            'email' => $email,
            'perusahaans' => $perusahaans,
            'role' => $role
        ]);
    }

    public function update(Request $request, email $email)
    {
        $role = Auth::user()->role;
        $rules = [
            'nama' => 'required',
            'email' => 'required|email',
            'pesan' => 'required',
        ];
        if ($role === 'superAdmin') {
            $rules['id_perusahaan'] = 'required|exists:perusahaans,id_perusahaan';
        }
        $validatedData = $request->validate($rules);
        if ($role !== 'superAdmin') {
            $validatedData['id_perusahaan'] = Auth::user()->id_perusahaan;
        }
        $email->update($validatedData);
        return redirect('/dashboard/email')->with('success', 'Data Berhasil Diupdate');
    }

    public function destroy(email $email)
    {
        $role = Auth::user()->role;
        if ($role !== 'superAdmin' && $email->id_perusahaan !== Auth::user()->id_perusahaan) {
            abort(403);
        }
        email::destroy($email->id);
        return redirect('/dashboard/email')->with('success', 'Data Berhasil Dihapus');
    }
}
