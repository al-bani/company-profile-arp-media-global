<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Http\Requests\StoreadminRequest;
use App\Http\Requests\UpdateadminRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = admin::all();
        return view('admin.adminAkun.homeAdminAkun', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.adminAkun.createAdminAkun');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['status'] = 1;
        admin::create($data);

        return redirect('/dashboard/akunAdmin')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(admin $admin)
    {
        //
    }

    public function edit($id)
    {
        $admin = admin::findOrFail($id);
        return view('admin.adminAkun.admin-edit', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(admin $admin)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        admin::where('id', $id)
            ->update($request->except('_token', '_method'));
        return redirect('/dashboard/adminAkun')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        admin::destroy($id);
        return redirect('/dashboard/akunAdmin')->with('success', 'Data Berhasil dihapus');
    }
}
