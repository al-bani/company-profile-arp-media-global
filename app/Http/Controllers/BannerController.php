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
        return view("admin.banner.createBanner", [
            'perusahaans' => perusahaan::all()
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
            'banners' => $banner
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatebannerRequest $request, banner $banner)
    {
        //
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
