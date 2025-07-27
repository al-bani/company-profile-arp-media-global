<?php

namespace App\Http\Controllers;

use App\Models\partner;
use App\Http\Requests\StorepartnerRequest;
use App\Http\Requests\UpdatepartnerRequest;
use App\Models\perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Auth::user()->role;
        if ($role === 'superAdmin') {
            $partners = partner::all();
        } else {
            $admin = Auth::user();
            $partners = partner::where('id_perusahaan', $admin->id_perusahaan)->get();
        }
        return view('admin.partner.homePartner', compact('partners', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Auth::user()->role;
        if ($role === 'superAdmin') {
            $perusahaans = perusahaan::all();
        } else {
            $admin = Auth::user();
            $perusahaans = perusahaan::where('id_perusahaan', $admin->id_perusahaan)->get();
        }
        if ($perusahaans->isEmpty()) {
            return redirect('/dashboard/partner')->with('error', 'Tambahkan minimal 1 perusahaan terlebih dahulu!');
        }
        return view('admin.partner.createPartner', [
            'perusahaans' => $perusahaans,
            'role' => $role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi kolom unique
        $uniqueFields = [
            'id_partner' => 'ID Partner',
            'email' => 'Email'
        ];

        foreach ($uniqueFields as $field => $label) {
            if ($field === 'id_partner') {
                $value = 'PRT_' . str_replace(' ', '_', $request->nama_partner) . '_' . time();
            } else {
                $value = $request->$field;
            }

            if (Partner::where($field, $value)->exists()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', $label . ' sudah terdaftar dalam sistem!');
            }
        }

        $id_partner = 'PRT_' . str_replace(' ', '_', $request->nama_partner) . '_' . time();
        $request->merge([
            'id_partner' => $id_partner,
        ]);

        $data = $request->all();
        if ($request->hasFile('foto')) {
            $extension = $request->file('foto')->getClientOriginalExtension();
            $randomString = md5(uniqid(rand(), true));
            $filename = time() . '_' . $randomString . '.' . $extension;
            $destination = 'images/upload/partner';
            $request->file('foto')->move(public_path($destination), $filename);
            $data['foto'] = $filename;
        }

        Partner::create($data);
        return redirect('/dashboard/partner')->with('success', 'Data Berhasil Ditambahkan');
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
    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);

        // Validasi kolom unique kecuali untuk data yang sedang diedit
        $uniqueFields = [
            'id_partner' => 'ID Partner',
            'email' => 'Email'
        ];

        foreach ($uniqueFields as $field => $label) {
            $value = $request->$field;
            $exists = Partner::where($field, $value)
                ->where('id', '!=', $id)
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', $label . ' sudah terdaftar dalam sistem!');
            }
        }

        $data = $request->except('_token', '_method');
        if ($request->hasFile('foto')) {
            if ($partner->foto && file_exists(public_path($partner->foto))) {
                unlink(public_path($partner->foto));
            }

            $extension = $request->file('foto')->getClientOriginalExtension();
            $randomString = md5(uniqid(rand(), true));
            $filename = time() . '_' . $randomString . '.' . $extension;
            $destination = 'images/upload/partner';
            $request->file('foto')->move(public_path($destination), $filename);
            $data['foto'] = $filename;
        }

        $partner->update($data);
        return redirect()->route('partner.index')
            ->with('success', 'Data Partner berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $partner = partner::findOrFail($id);
        $role = Auth::user()->role;
        if ($role !== 'superAdmin') {
            $admin = Auth::user();
            if ($partner->id_perusahaan !== $admin->id_perusahaan) {
                abort(403, 'Unauthorized');
            }
        }

        // Hapus file foto jika ada
        if ($partner->foto && file_exists(public_path('images/upload/partner/' . $partner->foto))) {
            unlink(public_path('images/upload/partner/' . $partner->foto));
        }

        $partner->delete();
        return redirect('/dashboard/partner')->with('success', 'Data Berhasil dihapus');
    }

    public function edit(partner $partner)
    {
        $role = Auth::user()->role;
        if ($role !== 'superAdmin') {
            $admin = Auth::user();
            if ($partner->id_perusahaan !== $admin->id_perusahaan) {
                abort(403, 'Unauthorized');
            }
        }
        return view('admin.partner.partner-edit', [
            'partner' => $partner,
            'role' => $role
        ]);
    }
}
