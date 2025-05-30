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
        $role = Auth::user()->role;
        if ($role !== 'superAdmin') {
            $admin = Auth::user();
            $request->merge(['id_perusahaan' => $admin->id_perusahaan]);
        }
        $id_berita = 'berita' . '_' . $request->id_perusahaan . '_' . $request->id;
        $request->merge([
            'id_berita' => $id_berita,
            // 'password' => bcrypt($request->password) // hash password juga di sini
        ]);
        $data = $request->all();
        if ($request->hasFile('foto')) {
            $filename = time() . '_' . $request->file('foto')->getClientOriginalName();
            $destination = 'image/upload/foto';
            $request->file('foto')->move(public_path($destination), $filename);
            $data['foto'] = $destination . '/' . $filename;
        }

        berita::create($data);

        // if ($request->has('foto')) {
        //     foreach ($request->foto as $item) {
        //         if (isset($item['foto']) && $item['foto'] instanceof \Illuminate\Http\UploadedFile) {
        //             $filename = time() . '_' . $item['foto']->getClientOriginalName();
        //             $destination = 'image/upload/foto';
        //             $item['foto']->move(public_path($destination), $filename);

        //             berita_foto::create([
        //                 'id_berita' => $request->id_berita,
        //                 'id_berita_foto' => 'img'.$request->id_berita.$item['judul_foto'],
        //                 'judul_foto' => $item['judul_foto'] ?? '',
        //                 'foto' => $destination . '/' . $filename,
        //             ]);
        //         }
        //     }
        // }


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
        $berita = berita::findOrFail($id);
        $role = Auth::user()->role;
        if ($role !== 'superAdmin') {
            $admin = Auth::user();
            if ($berita->id_perusahaan !== $admin->id_perusahaan) {
                abort(403, 'Unauthorized');
            }
        }
        $data = $request->except('_token', '_method', 'foto');
        if ($request->id_perusahaan !== $berita->id_perusahaan) {
            $data['id_berita'] = 'berita' . '_' . $request->id_perusahaan . '_' . $id;
        }
        if ($request->has('foto')) {
            foreach ($request->foto as $item) {
                if (isset($item['foto']) && $item['foto'] instanceof \Illuminate\Http\UploadedFile) {
                    $oldFoto = berita_foto::where('id_berita', $berita->id_berita)->first();
                    if ($oldFoto && file_exists(public_path($oldFoto->foto))) {
                        unlink(public_path($oldFoto->foto));
                    }
                    $extension = $item['foto']->getClientOriginalExtension();
                    $filename = Str::random(16) . '.' . $extension;
                    $destination = 'image/upload/foto';
                    $item['foto']->move(public_path($destination), $filename);
                    berita_foto::updateOrCreate(
                        ['id_berita' => $berita->id_berita],
                        [
                            'id_berita_foto' => 'img' . $berita->id_berita . ($item['judul_foto'] ?? ''),
                            'judul_foto' => $item['judul_foto'] ?? '',
                            'foto' => $destination . '/' . $filename,
                        ]
                    );
                }
            }
        }
        $berita->update($data);
        return redirect('/dashboard/berita')->with('success', 'Berita berhasil diperbarui');
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
