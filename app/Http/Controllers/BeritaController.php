<?php

namespace App\Http\Controllers;

use App\Models\berita;
use App\Http\Requests\StoreberitaRequest;
use App\Http\Requests\UpdateberitaRequest;
use App\Models\berita_foto;
use App\Models\perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Auth::user()->role;
        if ($role === 'superAdmin') {
            $beritas = berita::all();
        } else {
            $admin = Auth::user();
            $beritas = berita::where('id_perusahaan', $admin->id_perusahaan)->get();
        }
        $beritaFotos = berita_foto::all();
        return view('admin.berita.homeBerita', [
            'beritas' => $beritas,
            'beritaFotos' => $beritaFotos,
            'role' => $role
        ]);
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
            return redirect('/dashboard/berita')->with('error', 'Tambahkan minimal 1 perusahaan terlebih dahulu!');
        }
        return view('admin.berita.createBerita', [
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
            'id_berita' => 'ID Berita'
        ];

        foreach ($uniqueFields as $field => $label) {
            if ($field === 'id_berita') {
                $value = 'BRT_' . str_replace(' ', '_', $request->judul) . '_' . time();
            } else {
                $value = $request->$field;
            }

            if (Berita::where($field, $value)->exists()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', $label . ' sudah terdaftar dalam sistem!');
            }
        }

        $id_berita = 'BRT_' . str_replace(' ', '_', $request->judul) . '_' . time();
        $request->merge([
            'id_berita' => $id_berita,
        ]);

        $data = $request->all();
        if ($request->hasFile('foto')) {
            $extension = $request->file('foto')->getClientOriginalExtension();
            $randomString = md5(uniqid(rand(), true));
            $filename = time() . '_' . $randomString . '.' . $extension;
            $destination = 'images/upload/berita';
            $request->file('foto')->move(public_path($destination), $filename);
            $data['foto'] = $filename;
        }

        Berita::create($data);
        return redirect('/dashboard/berita')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(berita $berita)
    {
        //
    }

    public function edit(berita $berita)
    {
        $role = Auth::user()->role;
        if ($role !== 'superAdmin') {
            $admin = Auth::user();
            if ($berita->id_perusahaan !== $admin->id_perusahaan) {
                abort(403, 'Unauthorized');
            }
        }
        return view('admin.berita.berita-edit', [
            'berita' => $berita,
            'perusahaans' => perusahaan::all(),
            'role' => $role
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(berita $berita)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        // Validasi kolom unique kecuali untuk data yang sedang diedit
        $uniqueFields = [
            'id_berita' => 'ID Berita'
        ];

        foreach ($uniqueFields as $field => $label) {
            $value = $request->$field;
            $exists = Berita::where($field, $value)
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
            if ($berita->foto && file_exists(public_path($berita->foto))) {
                unlink(public_path($berita->foto));
            }

            $extension = $request->file('foto')->getClientOriginalExtension();
            $randomString = md5(uniqid(rand(), true));
            $filename = time() . '_' . $randomString . '.' . $extension;
            $destination = 'images/upload/berita';
            $request->file('foto')->move(public_path($destination), $filename);
            $data['foto'] = $filename;
        }

        $berita->update($data);
        return redirect()->route('berita.index')
            ->with('success', 'Data Berita berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $berita = berita::findOrFail($id);
        $role = Auth::user()->role;
        if ($role !== 'superAdmin') {
            $admin = Auth::user();
            if ($berita->id_perusahaan !== $admin->id_perusahaan) {
                abort(403, 'Unauthorized');
            }
        }
        $berita->delete();
        return redirect('/dashboard/berita')->with('success', 'Data Berhasil dihapus');
    }
}