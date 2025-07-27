<?php

namespace App\Http\Controllers;

use App\Models\layanan;
use App\Http\Requests\StorelayananRequest;
use App\Http\Requests\UpdatelayananRequest;
use App\Models\perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Auth::user()->role;
        if ($role === 'superAdmin') {
            $layanans = layanan::all();
        } else {
            $admin = Auth::user();
            $layanans = layanan::where('id_perusahaan', $admin->id_perusahaan)->get();
        }
        return view('admin.layanan.homeLayanan', compact('layanans', 'role'));
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
            return redirect('/dashboard/layanan')->with('error', 'Tambahkan minimal 1 perusahaan terlebih dahulu!');
        }
        return view('admin.layanan.createLayanan', [
            'perusahaans' => $perusahaans,
            'role' => $role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = Auth::user()->role;
        if ($role !== 'superAdmin') {
            $admin = Auth::user();
            $request->merge(['id_perusahaan' => $admin->id_perusahaan]);
        }
        $baseId = $request->id_perusahaan . '_' . str_replace(' ', '_', $request->nama_layanan);

        if (Layanan::where('id_layanan', $baseId)->exists()) {
            $counter = 1;
            $id_layanan = $baseId . '_' . $counter;

            while (Layanan::where('id_layanan', $id_layanan)->exists()) {
                $counter++;
                $id_layanan = $baseId . '_' . $counter;
            }
        } else {
            $id_layanan = $baseId;
        }
        $request->merge([
            'id_layanan' => $id_layanan,
        ]);
        $data = $request->all();
        if ($request->hasFile('foto')) {
            $extension = $request->file('foto')->getClientOriginalExtension();
            $randomString = md5(uniqid(rand(), true));
            $filename = time() . '_' . $randomString . '.' . $extension;
            $destination = 'images/upload/layanan';
            $request->file('foto')->move(public_path($destination), $filename);
            $data['foto'] = $filename;
        }
        layanan::create($data);
        return redirect('/dashboard/layanan')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(layanan $layanan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(layanan $layanan)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $layanan = layanan::findOrFail($id);
        $role = Auth::user()->role;
        if ($role !== 'superAdmin') {
            $admin = Auth::user();
            if ($layanan->id_perusahaan !== $admin->id_perusahaan) {
                abort(403, 'Unauthorized');
            }
        }
        $data = $request->except('_token', '_method');
        if ($request->hasFile('foto')) {
            if ($layanan->foto && file_exists(public_path($layanan->foto))) {
                unlink(public_path($layanan->foto));
            }
            $filename = time() . '_' . $request->file('foto')->getClientOriginalName();
            $destination = 'images/upload/layanan';
            $request->file('foto')->move(public_path($destination), $filename);
            $data['foto'] = $filename;
        }
        if ($request->nama_layanan !== $layanan->nama_layanan) {
            $data['id_layanan'] = $layanan->id_perusahaan . '_' . $request->nama_layanan;
        }
        $layanan->update($data);
        return redirect()->route('layanan.index')
            ->with('success', 'Data Layanan berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $layanan = layanan::findOrFail($id);
        $role = Auth::user()->role;
        if ($role !== 'superAdmin') {
            $admin = Auth::user();
            if ($layanan->id_perusahaan !== $admin->id_perusahaan) {
                abort(403, 'Unauthorized');
            }
        }

        // Hapus file foto jika ada
        if ($layanan->foto && file_exists(public_path('images/upload/layanan/' . $layanan->foto))) {
            unlink(public_path('images/upload/layanan/' . $layanan->foto));
        }

        $layanan->delete();
        return redirect('/dashboard/layanan')->with('success', 'Data Berhasil dihapus');
    }
    public function edit(layanan $layanan)
    {
        $role = Auth::user()->role;
        if ($role !== 'superAdmin') {
            $admin = Auth::user();
            if ($layanan->id_perusahaan !== $admin->id_perusahaan) {
                abort(403, 'Unauthorized');
            }
        }
        return view('admin.layanan.layanan-edit', [
            'layanan' => $layanan,
            'role' => $role
        ]);
    }
}
