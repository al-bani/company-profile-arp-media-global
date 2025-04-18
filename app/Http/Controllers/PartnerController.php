<?php

namespace App\Http\Controllers;

use App\Models\partner;
use App\Http\Requests\StorepartnerRequest;
use App\Http\Requests\UpdatepartnerRequest;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.partner.homePartner');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partner.partner');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepartnerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(partner $partner)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepartnerRequest $request, partner $partner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(partner $partner)
    {
        //
    }

    public function edit()
    {
        return view('admin.partner.partner-edit');
    }
}
