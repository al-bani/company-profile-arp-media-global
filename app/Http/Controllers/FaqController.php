<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        return view('admin.faq.homeFaq', [
            'faqs' => Faq::all()
        ]);
    }

    public function create()
    {
        return view('admin.faq.createFaq');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required'
        ]);

        Faq::create($validatedData);
        return redirect('/dashboard/homeFaq')->with('success', 'FAQ berhasil ditambahkan');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faq.faq-edit', [
            'faq' => $faq
        ]);
    }

    public function update(Request $request, Faq $faq)
    {
        $validatedData = $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required'
        ]);

        $faq->update($validatedData);
        return redirect('/dashboard/homeFaq')->with('success', 'FAQ berhasil diperbarui');
    }

    public function destroy(Faq $faq)
    {
        Faq::destroy($faq->id);
        return redirect('/dashboard/homeFaq')->with('success', 'FAQ berhasil dihapus');
    }
}