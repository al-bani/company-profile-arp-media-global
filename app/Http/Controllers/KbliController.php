<?php

namespace App\Http\Controllers;

use App\Models\kbli;
use App\Http\Requests\StorekbliRequest;
use App\Models\perusahaan;
use App\Http\Requests\UpdatekbliRequest;
use Illuminate\Support\Facades\Auth;

class KbliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Auth::user()->role;
        if ($role === 'superAdmin') {
            $kblis = kbli::with('perusahaan')->get();
        } else {
            $admin = Auth::user();
            $kblis = kbli::with('perusahaan')->where('id_perusahaan', $admin->id_perusahaan)->get();
        }
        return view('admin.kbli.homekbli', compact('kblis', 'role'));
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
            $perusahaans = perusahaan::where('id', $admin->id_perusahaan)->get();
        }
        if ($perusahaans->isEmpty()) {
            return redirect('/dashboard/kbli')->with('error', 'Tambahkan minimal 1 perusahaan terlebih dahulu!');
        }
        return view('admin.kbli.createKbli', [
            'perusahaans' => $perusahaans,
            'role' => $role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorekbliRequest $request)
    {
        try {
            $data = $request->validated();

            // Jika bukan superAdmin, set id_perusahaan dari user yang login
            if (Auth::user()->role !== 'superAdmin') {
                $data['id_perusahaan'] = Auth::user()->id_perusahaan;
            }

            kbli::create($data);

            return redirect('/dashboard/kbli')->with('success', 'KBLI berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(kbli $kbli)
    {
        $role = Auth::user()->role;
        if ($role !== 'superAdmin') {
            $admin = Auth::user();
            if ($kbli->id_perusahaan !== $admin->id_perusahaan) {
                abort(403, 'Unauthorized');
            }
        }

        return view('admin.kbli.show', compact('kbli', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kbli $kbli)
    {
        $role = Auth::user()->role;
        if ($role !== 'superAdmin') {
            $admin = Auth::user();
            if ($kbli->id_perusahaan !== $admin->id_perusahaan) {
                abort(403, 'Unauthorized');
            }
        }

        if ($role === 'superAdmin') {
            $perusahaans = perusahaan::all();
        } else {
            $admin = Auth::user();
            $perusahaans = perusahaan::where('id', $admin->id_perusahaan)->get();
        }

        return view('admin.kbli.kbli-edit', [
            'kbli' => $kbli,
            'perusahaans' => $perusahaans,
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatekbliRequest $request, kbli $kbli)
    {
        try {
            $role = Auth::user()->role;
            if ($role !== 'superAdmin') {
                $admin = Auth::user();
                if ($kbli->id_perusahaan !== $admin->id_perusahaan) {
                    abort(403, 'Unauthorized');
                }
            }

            $data = $request->validated();

            // Jika bukan superAdmin, set id_perusahaan dari user yang login
            if ($role !== 'superAdmin') {
                $data['id_perusahaan'] = Auth::user()->id_perusahaan;
            }

            $kbli->update($data);

            return redirect('/dashboard/kbli')->with('success', 'KBLI berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kbli $kbli)
    {
        try {
            $role = Auth::user()->role;
            if ($role !== 'superAdmin') {
                $admin = Auth::user();
                if ($kbli->id_perusahaan !== $admin->id_perusahaan) {
                    abort(403, 'Unauthorized');
                }
            }

            $kbli->delete();

            return redirect('/dashboard/kbli')->with('success', 'KBLI berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
