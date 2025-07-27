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
        // Validasi kolom unique
        $uniqueFields = [
            'id_perusahaan' => 'ID Perusahaan',
            'nib' => 'NIB',
            'npwp' => 'NPWP',
            'email' => 'Email'
        ];

        foreach ($uniqueFields as $field => $label) {
            if ($field === 'id_perusahaan') {
                $value = $request->status . '_' . str_replace(' ', '_', $request->nama_perusahaan) . '_' . $request->nib;
            } else {
                $value = $request->$field;
            }

            if (Perusahaan::where($field, $value)->exists()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', $label . ' sudah terdaftar dalam sistem!');
            }
        }

        $id_perusahaan =  $request->status . '_' . str_replace(' ', '_', $request->nama_perusahaan) . '_' . $request->nib;
        $request->merge([
            'id_perusahaan' => $id_perusahaan,
        ]);
        $data = $request->all();

        if ($request->hasFile('logo_website')) {
            $extension = $request->file('logo_website')->getClientOriginalExtension();
            $randomString = md5(uniqid(rand(), true));
            $filename = time() . '_' . $randomString . '.' . $extension;
            $destination = 'images/upload/logo/website';
            $request->file('logo_website')->move(public_path($destination), $filename);
            $data['logo_website'] = $filename;
        }
        if ($request->hasFile('logo_utama')) {
            $extension = $request->file('logo_utama')->getClientOriginalExtension();
            $randomString = md5(uniqid(rand(), true));
            $filename = time() . '_' . $randomString . '.' . $extension;
            $destination = 'images/upload/logo/primary';
            $request->file('logo_utama')->move(public_path($destination), $filename);
            $data['logo_utama'] = $filename;
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

        // Validasi kolom unique kecuali untuk data yang sedang diedit
        $uniqueFields = [
            'nib' => 'NIB',
            'npwp' => 'NPWP',
            'email' => 'Email'
        ];

        foreach ($uniqueFields as $field => $label) {
            $value = $request->$field;
            $exists = Perusahaan::where($field, $value)
                ->where('id', '!=', $id)
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', $label . ' sudah terdaftar dalam sistem!');
            }
        }

        $data = $request->except('_token', '_method');

        // Handle upload logo baru jika ada
        if ($request->hasFile('logo_website')) {
            if ($perusahaan->logo_website && file_exists(public_path($perusahaan->logo_website))) {
                unlink(public_path($perusahaan->logo_website));
            }

            $extension = $request->file('logo_website')->getClientOriginalExtension();
            $randomString = md5(uniqid(rand(), true));
            $filename = time() . '_' . $randomString . '.' . $extension;
            $destination = 'images/upload/logo/website';
            $request->file('logo_website')->move(public_path($destination), $filename);
            $data['logo_website'] = $filename;
        }
        if ($request->hasFile('logo_utama')) {
            if ($perusahaan->logo_utama && file_exists(public_path($perusahaan->logo_utama))) {
                unlink(public_path($perusahaan->logo_utama));
            }

            $extension = $request->file('logo_utama')->getClientOriginalExtension();
            $randomString = md5(uniqid(rand(), true));
            $filename = time() . '_' . $randomString . '.' . $extension;
            $destination = 'images/upload/logo/primary';
            $request->file('logo_utama')->move(public_path($destination), $filename);
            $data['logo_utama'] = $filename;
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
        $perusahaan = perusahaan::findOrFail($id);

        // Hapus file logo_website jika ada
        if ($perusahaan->logo_website && file_exists(public_path('images/upload/logo/website/' . $perusahaan->logo_website))) {
            unlink(public_path('images/upload/logo/website/' . $perusahaan->logo_website));
        }

        // Hapus file logo_utama jika ada
        if ($perusahaan->logo_utama && file_exists(public_path('images/upload/logo/primary/' . $perusahaan->logo_utama))) {
            unlink(public_path('images/upload/logo/primary/' . $perusahaan->logo_utama));
        }

        perusahaan::destroy($id);
        return redirect('/dashboard/perusahaan')->with('success', 'Data Berhasil dihapus');
    }
}
