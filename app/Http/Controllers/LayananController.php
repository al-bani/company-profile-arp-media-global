<?php

namespace App\Http\Controllers;

use App\Models\layanan;
use App\Http\Requests\StorelayananRequest;
use App\Http\Requests\UpdatelayananRequest;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanans = layanan::all();
        return view('admin.layanan.homeLayanan', compact('layanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layanan.layanan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorelayananRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(layanan $layanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(layanan $layanan)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatelayananRequest $request, layanan $layanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(layanan $layanan)
    {
        //
    }
    public function edit()
    {
        return view('admin.layanan.layanan-edit');
    }
}
