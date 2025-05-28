<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Http\Requests\StoreadminRequest;
use App\Http\Requests\UpdateadminRequest;
use App\Models\perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        // Ambil semua perusahaan
        $perusahaans = perusahaan::all();

        // Ambil id_perusahaan yang sudah ada di tabel admins
        $perusahaanTerdaftar = admin::pluck('id_perusahaan')->toArray();

        // Filter perusahaan yang belum memiliki admin
        $perusahaans = $perusahaans->whereNotIn('id_perusahaan', $perusahaanTerdaftar);

        if ($perusahaans->isEmpty()) {
            return redirect('/dashboard/akunAdmin')->with('error', 'Semua perusahaan sudah memiliki admin!');
        }

        return view('admin.adminAkun.createAdminAkun', [
            'perusahaans' => $perusahaans
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $id_admin = $request->status . '_' . $request->id_perusahaan . '_' . str_replace(' ', '_', $request->nama_admin);
        $request->merge([
            'id_admin' => $id_admin,
            'password' => Hash::make($request->password),
            // 'password' => bcrypt($request->password) // hash password juga di sini
        ]);
        $data = $request->all();
        $data['status'] = "aktif";
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

        // Ambil semua perusahaan
        $perusahaans = perusahaan::all();

        // Ambil id_perusahaan yang sudah ada di tabel admins (kecuali admin yang sedang diedit)
        $perusahaanTerdaftar = admin::where('id', '!=', $id)
            ->pluck('id_perusahaan')
            ->toArray();

        // Filter perusahaan yang belum memiliki admin atau perusahaan yang sedang diedit
        $perusahaans = $perusahaans->whereNotIn('id_perusahaan', $perusahaanTerdaftar);

        return view('admin.adminAkun.admin-edit', [
            'admin' => $admin,
            'perusahaans' => $perusahaans
        ]);
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
        $data = $request->except('_token', '_method');

        // Jika kolom password diisi, hash dulu
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        } else {
            // Jangan update password jika kosong
            unset($data['password']);
        }

        admin::where('id', $id)->update($data);

        return redirect('/dashboard/akunAdmin')->with('success', 'Data Berhasil Diubah');
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