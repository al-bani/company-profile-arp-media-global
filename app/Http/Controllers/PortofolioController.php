<?php

namespace App\Http\Controllers;

use App\Models\portofolio;
use App\Http\Requests\StoreportfolioRequest;
use App\Http\Requests\UpdateportfolioRequest;
use App\Models\perusahaan;
use App\Models\portofolio_foto;
use App\Models\timelinePortofolio;
use Illuminate\Http\Request;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portofolios = portofolio::all();

        return view('admin.portofolio.homePortofolio', compact('portofolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $perusahaans = perusahaan::all();
        if ($perusahaans->isEmpty()) {
            return redirect('/dashboard/portofolio')->with('error', 'Tambahkan minimal 1 perusahaan terlebih dahulu!');
        }
        return view('admin.portofolio.createPortofolio', [
            'perusahaans' => $perusahaans
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->foto);
        $id_portofolio =  $request->id_perusahaan . '_' . str_replace(' ', '_',$request->nama_project);
        $waktu = $request->jam_mulai . '-' . $request->jam_selesai;
        $request->merge([
            'id_portofolio' => $id_portofolio,
            'waktu' => $waktu
        ]);
        portofolio::create($request->all());

        // dd($request->timeline);
        // Simpan timeline jika ada
        if ($request->has('timeline')) {
            foreach ($request->timeline as $item) {
                if (!empty($item['tanggal']) || !empty($item['deskripsi'])) {
                    timelinePortofolio::create([
                        'timeline_id' => 'tl-' . $request->nama_project . $item['tanggal'], // Pastikan ada relasi
                        'id_portofolio' => $request->id_portofolio,
                        'tanggal' => $item['tanggal'],
                        'deskripsi' => $item['deskripsi'],
                    ]);
                }
            }
        }
        if ($request->has('team')) {
            foreach ($request->timeline as $item) {
                if (!empty($item['team']) || !empty($item['team'])) {
                    timelinePortofolio::create([
                        'team_id' => 'tm-' . $request->nama_project . $item['tanggal'], // Pastikan ada relasi
                        'id_portofolio' => $request->id_portofolio,
                        'team' => $item['tanggal']
                    ]);
                }
            }
        }

        if ($request->has('foto')) {
            foreach ($request->foto as $index => $item) {
                if (isset($item['foto']) && $item['foto'] instanceof \Illuminate\Http\UploadedFile) {
                    $filename = time() . '_' . $item['foto']->getClientOriginalName();
                    $destination = 'image/upload/foto';
                    $item['foto']->move(public_path($destination), $filename);

                    portofolio_foto::create([
                        'id_portofolio' => $request->id_portofolio,
                        'id_portofolio_foto' => 'img'.$request->id_portofolio.$item['judul_foto'],
                        'judul_foto' => $item['judul_foto'] ?? '',
                        'foto' => $destination . '/' . $filename,
                    ]);
                }
            }
        }
        return redirect('/dashboard/portofolio')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(portofolio $portofolio)
    {
        return view('admin.portofolio.portofolio-edit', [
            'portofolio' => $portofolio,
            'perusahaans' => perusahaan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $portofolio = portofolio::findOrFail($id);

        // Update id_portofolio if needed
        if ($request->nama_project !== $portofolio->nama_project || $request->id_perusahaan !== $portofolio->id_perusahaan) {
            $id_portofolio = $request->id_perusahaan . '_' . $request->nama_project;
        } else {
            $id_portofolio = $portofolio->id_portofolio;
        }

        // Combine jam_mulai and jam_selesai
        $waktu = $request->jam_mulai . '-' . $request->jam_selesai;

        // Update portofolio data
        $portofolio->update([
            'id_portofolio' => $id_portofolio,
            'nama_project' => $request->nama_project,
            'deskripsi' => $request->deskripsi,
            'team' => $request->team,
            'tempat' => $request->tempat,
            'tanggal' => $request->tanggal,
            'waktu' => $waktu,
            'id_perusahaan' => $request->id_perusahaan
        ]);

        // Update timeline
        if ($request->has('timeline')) {
            // Delete existing timelines
            timelinePortofolio::where('id_portofolio', $portofolio->id_portofolio)->delete();

            // Create new timelines
            foreach ($request->timeline as $item) {
                if (!empty($item['tanggal']) || !empty($item['deskripsi'])) {
                    timelinePortofolio::create([
                        'timeline_id' => 'tl-' . $request->nama_project . $item['tanggal'],
                        'id_portofolio' => $portofolio->id_portofolio,
                        'tanggal' => $item['tanggal'],
                        'deskripsi' => $item['deskripsi'],
                    ]);
                }
            }
        }

        // Update photos
        if ($request->has('foto')) {
            foreach ($request->foto as $index => $item) {
                if (isset($item['foto']) && $item['foto'] instanceof \Illuminate\Http\UploadedFile) {
                    // Delete old file if exists
                    $oldFoto = portofolio_foto::where('id_portofolio', $portofolio->id_portofolio)
                        ->where('judul_foto', $item['judul_foto'])
                        ->first();

                    if ($oldFoto && file_exists(public_path($oldFoto->foto))) {
                        unlink(public_path($oldFoto->foto));
                    }

                    // Upload new file
                    $filename = time() . '_' . $item['foto']->getClientOriginalName();
                    $destination = 'image/upload/foto';
                    $item['foto']->move(public_path($destination), $filename);

                    // Update or create foto record
                    portofolio_foto::updateOrCreate(
                        [
                            'id_portofolio' => $portofolio->id_portofolio,
                            'judul_foto' => $item['judul_foto']
                        ],
                        [
                            'id_portofolio_foto' => 'img' . $portofolio->id_portofolio . $item['judul_foto'],
                            'foto' => $destination . '/' . $filename
                        ]
                    );
                }
            }
        }

        return redirect('/dashboard/portofolio')->with('success', 'Data Portofolio berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        portofolio::destroy($id);
        return redirect('/dashboard/portofolio')->with('success', 'Data Berhasil dihapus');
    }
}
