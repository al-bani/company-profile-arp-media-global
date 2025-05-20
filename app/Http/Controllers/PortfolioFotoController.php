<?php

namespace App\Http\Controllers;

use App\Models\portofolio_foto;
use App\Http\Requests\Storeportfolio_fotoRequest;
use App\Http\Requests\Updateportfolio_fotoRequest;
use Illuminate\Http\Request;

class PortfolioFotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portofolios = portofolio_foto::all();
        return view('admin.perusahaan.homePerusahaan', compact('perusahaans'));
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
    public function store(Request $request)
    {
        portofolio_foto::create($request->all());
        return redirect('/dashboard/portofolio_foto')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('admin.portofolio.edit-perusahaan', [
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
