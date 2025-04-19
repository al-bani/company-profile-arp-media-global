<?php

namespace App\Http\Controllers;

use App\Models\portfolio;
use App\Http\Requests\StoreportfolioRequest;
use App\Http\Requests\UpdateportfolioRequest;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.portofolio.homePortofolio');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.portofolio.portofolio');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreportfolioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(portfolio $portfolio)
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
    public function edit()
    {
        return view('admin.portofolio.portofolio-edit');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateportfolioRequest $request, portfolio $portfolio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(portfolio $portfolio)
    {
        //
    }
}
