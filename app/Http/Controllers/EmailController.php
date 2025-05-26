<?php

namespace App\Http\Controllers;

use App\Models\email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function index()
    {
        return view('admin.email.homeEmail', [
            'emails' => email::all()
        ]);
    }

    public function create()
    {
        return view('admin.email.createEmail');
    }

    public function store(Request $request)
    {
        email::create($request->all());
        return redirect('/dashboard/email')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function edit(email $email)
    {
        return view('admin.email.email-edit', [
            'email' => $email
        ]);
    }

    public function update(Request $request, email $email)
    {
        $email->update($request->all());
        return redirect('/dashboard/email')->with('success', 'Data Berhasil Diupdate');
    }

    public function destroy(email $email)
    {
        email::destroy($email->id);
        return redirect('/dashboard/email')->with('success', 'Data Berhasil Dihapus');
    }
}