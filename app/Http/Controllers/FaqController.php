<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaqController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        if ($role === 'superAdmin') {
            $faqs = Faq::with('perusahaan')->get();
        } else {
            $faqs = Faq::with('perusahaan')->where('id_perusahaan', Auth::user()->id_perusahaan)->get();
        }
        return view('admin.faq.homeFaq', [
            'faqs' => $faqs,
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
        return view('admin.faq.createFaq', compact('perusahaans', 'role'));
    }

    public function store(Request $request)
    {
        $role = Auth::user()->role;
        $rules = [
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ];
        if ($role === 'superAdmin') {
            $rules['id_perusahaan'] = 'required|exists:perusahaans,id_perusahaan';
        }
        $validatedData = $request->validate($rules);
        if ($role !== 'superAdmin') {
            $validatedData['id_perusahaan'] = Auth::user()->id_perusahaan;
        }
        Faq::create($validatedData);
        return redirect('/dashboard/faq')->with('success', 'FAQ berhasil ditambahkan');
    }

    public function edit(Faq $faq)
    {
        $role = Auth::user()->role;
        if ($role === 'superAdmin') {
            $perusahaans = perusahaan::all();
        } else {
            $perusahaans = perusahaan::where('id_perusahaan', Auth::user()->id_perusahaan)->get();
        }
        return view('admin.faq.faq-edit', [
            'faq' => $faq,
            'perusahaans' => $perusahaans,
            'role' => $role
        ]);
    }

    public function update(Request $request, Faq $faq)
    {
        $role = Auth::user()->role;
        $rules = [
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ];
        if ($role === 'superAdmin') {
            $rules['id_perusahaan'] = 'required|exists:perusahaans,id_perusahaan';
        }
        $validatedData = $request->validate($rules);
        if ($role !== 'superAdmin') {
            $validatedData['id_perusahaan'] = Auth::user()->id_perusahaan;
        }
        $faq->update($validatedData);
        return redirect('/dashboard/faq')->with('success', 'FAQ berhasil diperbarui');
    }

    public function destroy(Faq $faq)
    {
        $role = Auth::user()->role;
        if ($role !== 'superAdmin' && $faq->id_perusahaan !== Auth::user()->id_perusahaan) {
            abort(403);
        }
        Faq::destroy($faq->id);
        return redirect('/dashboard/faq')->with('success', 'FAQ berhasil dihapus');
    }
}
