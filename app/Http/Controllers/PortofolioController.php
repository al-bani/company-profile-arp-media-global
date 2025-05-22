<?php

namespace App\Http\Controllers;

use App\Models\portofolio;
use App\Http\Requests\StoreportfolioRequest;
use App\Http\Requests\UpdateportfolioRequest;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portofolios = portofolio::all();

        return view('admin.portofolio.homePortofolio', compact('portofolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.portofolio.createPortofolio');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        portofolio::create($request->all());
        return redirect('/dashboard/portofolio')->with('success', 'Data Berhasil Ditambahkan');
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
    // public function edit(portfolio $portfolio)
    // {
    //     //
    // }
    public function edit(portofolio $portofolio)
    {
        return view('admin.portofolio.portofolio-edit', [
            'portofolio' => $portofolio
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        portofolio::where('id', $id)
            ->update($request->except('_token', '_method'));
        return redirect('/dashboard/portofolio')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        portofolio::destroy($id);
        return redirect('/dashboard/portofolio')->with('success', 'Data Berhasil dihapus');
    }
}
