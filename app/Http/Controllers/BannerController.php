<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Http\Requests\StorebannerRequest;
use App\Http\Requests\UpdatebannerRequest;
use App\Models\perusahaan;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.banner.homeBanner', [
            'banners' => banner::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $perusahaans = perusahaan::all();
        if ($perusahaans->isEmpty()) {
            return redirect('/dashboard/banner')->with('error', 'Tambahkan minimal 1 perusahaan terlebih dahulu!');
        }
        return view("admin.banner.createBanner", [
            'perusahaans' => $perusahaans
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_banner = $request->id_perusahaan . '_' . $request->judul;
        $request->merge([
            'id_banner' => $id_banner,
            // 'password' => bcrypt($request->password) // hash password juga di sini
        ]);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            $filename = time() . '_' . $request->file('foto')->getClientOriginalName();
            $destination = 'image/upload/foto';
            $request->file('foto')->move(public_path($destination), $filename);
            $data['foto'] = $destination . '/' . $filename;
        }
        banner::create($data);
        return redirect('/dashboard/banner')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(banner $banner)
    {
        return view('admin.banner.banner-edit', [
            'banner' => $banner,
            'perusahaans' => perusahaan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $banner = banner::findOrFail($id);

        $data = $request->except('_token', '_method');

        // Update id_banner if needed
        if ($request->judul !== $banner->judul || $request->id_perusahaan !== $banner->id_perusahaan) {
            $data['id_banner'] = $request->id_perusahaan . '_' . $request->judul;
        }

        // Handle file upload
        if ($request->hasFile('foto')) {
            // Delete old file if exists
            if ($banner->foto && file_exists(public_path($banner->foto))) {
                unlink(public_path($banner->foto));
            }

            $filename = time() . '_' . $request->file('foto')->getClientOriginalName();
            $destination = 'image/upload/foto';
            $request->file('foto')->move(public_path($destination), $filename);
            $data['foto'] = $destination . '/' . $filename;
        }

        $banner->update($data);

        return redirect('/dashboard/banner')->with('success', 'Banner berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        banner::destroy($id);
        return redirect('/dashboard/banner')->with('success', 'Data Berhasil dihapus');
    }
}