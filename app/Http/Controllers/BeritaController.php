<?php

namespace App\Http\Controllers;

use App\Models\berita;
use App\Http\Requests\StoreberitaRequest;
use App\Http\Requests\UpdateberitaRequest;
use App\Models\berita_foto;
use App\Models\perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
        // Validasi minimal agar konten wajib diisi
        $request->validate([
            'konten' => 'required',
        ]);

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

            if (berita::where($field, $value)->exists()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', $label . ' sudah terdaftar dalam sistem!');
            }
        }

        $id_berita = 'BRT_' . str_replace(' ', '_', $request->judul) . '_' . time();
        $request->merge([
            'id_berita' => $id_berita,
        ]);

        $data = $request->except('foto');

        // Proses file foto
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $extension = $foto->getClientOriginalExtension();
            $randomString = md5(uniqid(rand(), true));
            $filename = time() . '_' . $randomString . '.' . $extension;
            $destination = 'images/upload/berita';
            $foto->move(public_path($destination), $filename);
            $data['foto'] = $filename;
        } else {
            // Set default foto jika tidak ada file yang diupload
            $data['foto'] = 'default.jpg';
        }

        // Pastikan judul_foto ada dalam data
        if (!isset($data['judul_foto']) || empty($data['judul_foto'])) {
            $data['judul_foto'] = 'Thumbnail Berita';
        }

        berita::create($data);
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
        // Debug untuk melihat parameter yang diterima
        // Log::info('Edit method called with ID: ' . $berita->id);

        $role = Auth::user()->role;

        if ($role !== 'superAdmin' && $berita->id_perusahaan !== Auth::user()->id_perusahaan) {
            abort(403, 'Unauthorized');
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
    public function update(Request $request, berita $berita)
    {
        // Validasi minimal agar konten wajib diisi
        $request->validate([
            'konten' => 'required',
        ]);

        // Debug untuk melihat apakah method dipanggil
        // Log::info('Update method called for berita ID: ' . $berita->id);

        // Validasi kolom unique kecuali untuk data yang sedang diedit
        $uniqueFields = [
            'id_berita' => 'ID Berita'
        ];

        foreach ($uniqueFields as $field => $label) {
            $value = $request->$field;
            $exists = berita::where($field, $value)
                ->where('id', '!=', $berita->id)
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', $label . ' sudah terdaftar dalam sistem!');
            }
        }

        $data = $request->except('_token', '_method', 'foto');

        // Proses file foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($berita->foto && file_exists(public_path('images/upload/berita/' . $berita->foto))) {
                unlink(public_path('images/upload/berita/' . $berita->foto));
            }

            $foto = $request->file('foto');
            $extension = $foto->getClientOriginalExtension();
            $randomString = md5(uniqid(rand(), true));
            $filename = time() . '_' . $randomString . '.' . $extension;
            $destination = 'images/upload/berita';
            $foto->move(public_path($destination), $filename);
            $data['foto'] = $filename;

            // Pastikan judul_foto ada dalam data hanya jika ada foto yang diupload
            if (!isset($data['judul_foto']) || empty($data['judul_foto'])) {
                $data['judul_foto'] = 'Thumbnail Berita';
            }
        }

        $berita->update($data);
        return redirect('/dashboard/berita')
            ->with('success', 'Data Berita berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(berita $berita)
    {
        // Debug untuk melihat parameter yang diterima
        Log::info('Destroy method called with ID: ' . $berita->id);

        $role = Auth::user()->role;
        if ($role !== 'superAdmin') {
            $admin = Auth::user();
            if ($berita->id_perusahaan !== $admin->id_perusahaan) {
                abort(403, 'Unauthorized');
            }
        }

        // Hapus file foto jika ada
        if ($berita->foto && file_exists(public_path('images/upload/berita/' . $berita->foto))) {
            unlink(public_path('images/upload/berita/' . $berita->foto));
        }

        $berita->delete();
        return redirect('/dashboard/berita')->with('success', 'Data Berhasil dihapus');
    }
}