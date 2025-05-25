<?php

namespace App\Http\Controllers;

use App\Models\layanan;
use App\Http\Requests\StorelayananRequest;
use App\Http\Requests\UpdatelayananRequest;
use App\Models\perusahaan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $layanans = layanan::all();
        return view('admin.layanan.homeLayanan', compact('layanans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.layanan.createLayanan', [
            'perusahaans' => perusahaan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_layanan = $request->id_perusahaan . '_' . $request->nama_layanan ;
        $request->merge([
            'id_layanan' => $id_layanan,
            // 'password' => bcrypt($request->password) // hash password juga di sini
        ]);
        $data = $request->all();
        if ($request->hasFile('foto')) {
            $filename = time() . '_' . $request->file('foto')->getClientOriginalName();
            $destination = 'image/upload/foto';
            $request->file('foto')->move(public_path($destination), $filename);
            $data['foto'] = $destination . '/' . $filename;
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

        $data = $request->except('_token', '_method');

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old file if exists
            if ($layanan->foto && file_exists(public_path($layanan->foto))) {
                unlink(public_path($layanan->foto));
            }

            $filename = time() . '_' . $request->file('foto')->getClientOriginalName();
            $destination = 'image/upload/foto';
            $request->file('foto')->move(public_path($destination), $filename);
            $data['foto'] = $destination . '/' . $filename;
        }

        // Update id_layanan if nama_layanan changed
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
        layanan::destroy($id);
        return redirect('/dashboard/layanan')->with('success', 'Data Berhasil dihapus');
    }
    public function edit(layanan $layanan)
    {
        return view('admin.layanan.layanan-edit',[
            'layanan' => $layanan
        ]);
    }
}