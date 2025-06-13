<?php

namespace App\Http\Controllers;

use App\Models\perusahaan;
use App\Http\Requests\StoreperusahaanRequest;
use App\Http\Requests\UpdateperusahaanRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Auth::user()->role;

        if ($role === 'superAdmin') {
            $perusahaans = Perusahaan::all();
        } else {
            // Ambil id_perusahaan dari admin yang login
            $admin = Auth::user();
            $perusahaans = Perusahaan::where('id_perusahaan', $admin->id_perusahaan)->get();
        }

        return view('admin.perusahaan.homePerusahaan', compact('perusahaans', 'role'));
    }
    public function coba()
    {
        return view('admin.perusahaan.coba');
    }
    public function tambah()
    {
        return view('admin.perusahaan.perusahaan');
    }
    public function edit(perusahaan $perusahaan)
    {
        $role = Auth::user()->role; // Mengambil role dari user yang login
        return view('admin.perusahaan.edit-perusahaan', [
            'perusahaan' => $perusahaan,
            'role' => $role
        ]);
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
    public function store(Request $request)
    {
        $id_perusahaan =  $request->status . '_' . str_replace(' ', '_', $request->nama_perusahaan) . '_' . $request->nib;
        $request->merge([
            'id_perusahaan' => $id_perusahaan,
        ]);
        $data = $request->all();

        if ($request->hasFile('logo_website')) {
            $filename = time() . '_' . $request->file('logo_website')->getClientOriginalName();
            $destination = 'image/upload/logo_website';
            $request->file('logo_website')->move(public_path($destination), $filename);
            $data['logo_website'] = $destination . '/' . $filename;
        }
        if ($request->hasFile('logo_utama')) {
            $filename = time() . '_' . $request->file('logo_utama')->getClientOriginalName();
            $destination = 'image/upload/logo_utama';
            $request->file('logo_utama')->move(public_path($destination), $filename);
            $data['logo_utama'] = $destination . '/' . $filename;
        }

        perusahaan::create($data);
        return redirect('/dashboard/perusahaan')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(perusahaan $perusahaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(perusahaan $perusahaan)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $perusahaan = Perusahaan::findOrFail($id);
        $role = Auth::user()->role;

        // Hanya izinkan admin dari perusahaan yang sesuai, kecuali superAdmin
        if ($role !== 'superAdmin') {
            $admin = Auth::user();
            if ($perusahaan->id_perusahaan !== $admin->id_perusahaan) {
                abort(403, 'Unauthorized');
            }
        }

        $data = $request->except('_token', '_method');

        // Handle upload logo baru jika ada
        if ($request->hasFile('logo_website')) {
            if ($perusahaan->logo_website && file_exists(public_path($perusahaan->logo_website))) {
                unlink(public_path($perusahaan->logo_website));
            }

            $filename = time() . '_' . $request->file('logo_website')->getClientOriginalName();
            $destination = 'image/upload/logo_website';
            $request->file('logo_website')->move(public_path($destination), $filename);
            $data['logo_website'] = $destination . '/' . $filename;
        }
        if ($request->hasFile('logo_utama')) {
            if ($perusahaan->logo_utama && file_exists(public_path($perusahaan->logo_utama))) {
                unlink(public_path($perusahaan->logo_utama));
            }

            $filename = time() . '_' . $request->file('logo_utama')->getClientOriginalName();
            $destination = 'image/upload/logo_utama';
            $request->file('logo_utama')->move(public_path($destination), $filename);
            $data['logo_utama'] = $destination . '/' . $filename;
        }

        // Update data perusahaan
        $perusahaan->update($data);

        return redirect()->route('perusahaan.index')
            ->with('success', 'Data Perusahaan berhasil diperbarui');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        perusahaan::destroy($id);
        return redirect('/dashboard/perusahaan')->with('success', 'Data Berhasil dihapus');
    }
}
