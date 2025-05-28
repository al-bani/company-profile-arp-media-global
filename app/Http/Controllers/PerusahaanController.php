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
        $id_perusahaan =  $request->status. '_' . $request->nama_perusahaan.'_'. $request->nib;
        $request->merge([
            'id_perusahaan' => $id_perusahaan,
        ]);
        $data = $request->all();

        if ($request->hasFile('logo')) {
            $filename = time() . '_' . $request->file('logo')->getClientOriginalName();
            $destination = 'image/upload/logo';
            $request->file('logo')->move(public_path($destination), $filename);
            $data['logo'] = $destination . '/' . $filename;
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
        // dd($request->all());
        perusahaan::where('id', $id)
            ->update($request->except('_token', '_method'));
        return redirect('/dashboard/perusahaan')->with('success', 'Data Berhasil Diubah');
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