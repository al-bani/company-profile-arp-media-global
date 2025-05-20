<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Http\Requests\StorebannerRequest;
use App\Http\Requests\UpdatebannerRequest;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.banner.homeBanner');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view("admin.perusahaan.createPerusahaan");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorebannerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebannerRequest $request, banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(banner $banner)
    {
        //
    }
}
