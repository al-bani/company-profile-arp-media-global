<?php

namespace App\Http\Controllers;

use App\Models\berita;
use App\Http\Requests\StoreberitaRequest;
use App\Http\Requests\UpdateberitaRequest;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.berita.homeBerita');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.berita.berita');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreberitaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(berita $berita)
    {
        //
    }

    public function edit()
    {
        return view('admin.berita.berita-edit');
    }


    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(berita $berita)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateberitaRequest $request, berita $berita)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(berita $berita)
    {
        //
    }
}
