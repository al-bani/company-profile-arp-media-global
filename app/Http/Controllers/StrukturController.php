<?php

namespace App\Http\Controllers;

use App\Models\struktur;
use App\Models\Perusahaan;
use App\Http\Requests\StorestrukturRequest;
use App\Http\Requests\UpdatestrukturRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Auth::user()->role;
        if ($role === 'superAdmin') {
            $strukturs = struktur::with('perusahaan')->get();
        } else {
            $strukturs = struktur::with('perusahaan')
                ->where('id_perusahaan', Auth::user()->id_perusahaan)
                ->get();
        }
        return view('admin.struktur.homeStruktur', compact('strukturs', 'role'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = Auth::user()->role;
        if ($role === 'superAdmin') {
            $perusahaans = Perusahaan::all();
        } else {
            $perusahaans = Perusahaan::where('id_perusahaan', Auth::user()->id_perusahaan)->get();
        }
        $strukturs = struktur::where('id_perusahaan', Auth::user()->id_perusahaan)->get();

        // Cek apakah perusahaan yang dipilih sudah memiliki posisi puncak
        $selectedPerusahaan = request('id_perusahaan', Auth::user()->id_perusahaan);
        $hasTopPosition = struktur::where('id_perusahaan', $selectedPerusahaan)
            ->where('atasan', '0')
            ->exists();

        $isFirstData = struktur::where('id_perusahaan', $selectedPerusahaan)->count() === 0;

        return view('admin.struktur.createStruktur', compact(
            'perusahaans',
            'strukturs',
            'isFirstData',
            'role',
            'hasTopPosition',
            'selectedPerusahaan'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = Auth::user()->role;
        if ($role !== 'superAdmin') {
            $request->merge(['id_perusahaan' => Auth::user()->id_perusahaan]);
        }

        $data = $request->all();

        // Jika ini data pertama, set atasan ke '0'
        if (struktur::where('id_perusahaan', $data['id_perusahaan'])->count() === 0) {
            $data['atasan'] = '0';
        }

        if ($request->hasFile('foto')) {
            $extension = $request->file('foto')->getClientOriginalExtension();
            $randomString = md5(uniqid(rand(), true));
            $filename = time() . '_' . $randomString . '.' . $extension;
            $destination = 'images/upload/struktur';
            $request->file('foto')->move(public_path($destination), $filename);
            $data['foto'] =  $filename;
        } else {
            $data['foto'] = '1';
            $data['atasan'] = '1';
        }

        struktur::create($data);
        return redirect('/dashboard/struktur')->with('success', 'Data struktur berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(struktur $struktur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(struktur $struktur)
    {
        $role = Auth::user()->role;
        if ($role !== 'superAdmin') {
            if ($struktur->id_perusahaan !== Auth::user()->id_perusahaan) {
                abort(403, 'Unauthorized');
            }
        }

        if ($role === 'superAdmin') {
            $perusahaans = Perusahaan::all();
        } else {
            $perusahaans = Perusahaan::where('id_perusahaan', Auth::user()->id_perusahaan)->get();
        }

        $strukturs = struktur::where('id', '!=', $struktur->id)
            ->where('id_perusahaan', $struktur->id_perusahaan)
            ->get();

        return view('admin.struktur.struktur-edit', [
            'struktur' => $struktur,
            'perusahaans' => $perusahaans,
            'strukturs' => $strukturs,
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $struktur = struktur::findOrFail($id);
        $role = Auth::user()->role;

        if ($role !== 'superAdmin') {
            if ($struktur->id_perusahaan !== Auth::user()->id_perusahaan) {
                abort(403, 'Unauthorized');
            }
            $request->merge(['id_perusahaan' => Auth::user()->id_perusahaan]);
        }

        $data = $request->except('_token', '_method');

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($struktur->foto && file_exists(public_path($struktur->foto))) {
                unlink(public_path($struktur->foto));
            }

            $extension = $request->file('foto')->getClientOriginalExtension();
            $randomString = md5(uniqid(rand(), true));
            $filename = time() . '_' . $randomString . '.' . $extension;
            $destination ='images/upload/struktur';
            $request->file('foto')->move(public_path($destination), $filename);
            $data['foto'] = $filename;
        }

        $struktur->update($data);
        return redirect('/dashboard/struktur')->with('success', 'Data struktur berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(struktur $struktur)
    {
        $role = Auth::user()->role;
        if ($role !== 'superAdmin') {
            if ($struktur->id_perusahaan !== Auth::user()->id_perusahaan) {
                abort(403, 'Unauthorized');
            }
        }

        // Hapus foto jika ada
        if ($struktur->foto && file_exists(public_path($struktur->foto))) {
            unlink(public_path($struktur->foto));
        }

        $struktur->delete();
        return redirect('/dashboard/struktur')->with('success', 'Data struktur berhasil dihapus');
    }
}