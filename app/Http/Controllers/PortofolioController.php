<?php

namespace App\Http\Controllers;

use App\Models\portofolio;
use App\Http\Requests\StoreportfolioRequest;
use App\Http\Requests\UpdateportfolioRequest;
use App\Models\perusahaan;
use App\Models\portofolio_foto;
use App\Models\team;
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
        // Validasi kolom unik
        $uniqueFields = [
            'id_portofolio' => 'ID Portofolio'
        ];

        foreach ($uniqueFields as $field => $label) {
            if ($field === 'id_portofolio') {
                $value = 'PRT_' . str_replace(' ', '_', $request->nama_project) . '_' . time();
            } else {
                $value = $request->$field;
            }

            if (portofolio::where($field, $value)->exists()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', $label . ' sudah terdaftar dalam sistem!');
            }
        }

        // Generate ID dan waktu
        $id_portofolio = 'PRT_' . str_replace(' ', '_', $request->nama_project) . '_' . time();
        $waktu = $request->jam_mulai . '-' . $request->jam_selesai;
        $request->merge([
            'id_portofolio' => $id_portofolio,
            'waktu' => $waktu
        ]);

        $data = $request->all();
        if (empty($data['tempat'])) {
            $data['tempat'] = $data['tempat_offline'];
        }

        // Simpan portofolio
        $portofolio = portofolio::create($data);

        // Hanya lanjutkan jika portofolio berhasil disimpan
        if ($portofolio) {

            // Simpan timeline jika ada
            if ($request->has('timeline')) {
                foreach ($request->timeline as $item) {
                    if (!empty($item['tanggal']) || !empty($item['deskripsi'])) {
                        timelinePortofolio::create([
                            'timeline_id' => 'tl-' . $request->nama_project . $item['tanggal'],
                            'id_portofolio' => $request->id_portofolio,
                            'tanggal' => $item['tanggal'],
                            'deskripsi' => $item['deskripsi'],
                        ]);
                    }
                }
            }

            // Simpan team jika ada
            if ($request->has('team') && $request->nama_team) {
                foreach ($request->team as $index => $item) {
                    if (!empty($item['anggota'])) {
                        team::create([
                            'team_id' => 'tm-' . str_replace(' ', '_', $request->nama_project) . '-' . $index . '-' . time(),
                            'id_portofolio' => $request->id_portofolio,
                            'team' => $request->nama_team,
                            'anggota' => $item['anggota']
                        ]);
                    }
                }
            }

            // Simpan foto jika ada
            if ($request->has('foto')) {
                foreach ($request->foto as $index => $item) {
                    if (isset($item['foto']) && $item['foto'] instanceof \Illuminate\Http\UploadedFile) {
                        $extension = $item['foto']->getClientOriginalExtension(); // diperbaiki
                        $randomString = md5(uniqid(rand(), true));
                        $filename = time() . '_' . $randomString . '.' . $extension;
                        $destination = 'images/upload/portofolio';
                        $item['foto']->move(public_path($destination), $filename);

                        portofolio_foto::create([
                            'id_portofolio' => $request->id_portofolio,
                            'id_portofolio_foto' => 'img' . $request->id_portofolio . ($item['judul_foto'] ?? 'no_title'),
                            'judul_foto' => $item['judul_foto'] ?? '',
                            'foto' => $filename,
                        ]);
                    }
                }
            }

            return redirect('/dashboard/portofolio')->with('success', 'Data Berhasil Ditambahkan');
        }

        return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data portofolio.');
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
        // Load teams relationship
        $portofolio->load('teams');

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

        // Validasi kolom unique kecuali untuk data yang sedang diedit
        $uniqueFields = [
            'id_portofolio' => 'ID Portofolio'
        ];

        foreach ($uniqueFields as $field => $label) {
            $value = $request->$field;
            $exists = portofolio::where($field, $value)
                ->where('id', '!=', $id)
                ->exists();

            if ($exists) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', $label . ' sudah terdaftar dalam sistem!');
            }
        }

        // Update id_portofolio if needed
        if ($request->nama_project !== $portofolio->nama_project || $request->id_perusahaan !== $portofolio->id_perusahaan) {
            $id_portofolio = $request->id_perusahaan . '_' . $request->nama_project;
        } else {
            $id_portofolio = $portofolio->id_portofolio;
        }

        $data = $request->all();

        if (!$data['tempat']) {
            $data['tempat'] = $data['tempat_offline'];
        }

        // Combine jam_mulai and jam_selesai
        $waktu = $request->jam_mulai . '-' . $request->jam_selesai;

        // Update portofolio data
        $portofolio->update([
            'id_portofolio' => $id_portofolio,
            'nama_project' => $request->nama_project,
            'deskripsi' => $request->deskripsi,
            'tempat' => $data['tempat'],
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

        // Update team
        if ($request->has('team') && $request->nama_team) {
            // Delete existing teams
            team::where('id_portofolio', $portofolio->id_portofolio)->delete();

            // Create new teams
            foreach ($request->team as $index => $item) {
                if (!empty($item['anggota'])) {
                    team::create([
                        'team_id' => 'tm-' . $request->nama_team . '-' . $index . '-' . time(),
                        'id_portofolio' => $portofolio->id_portofolio,
                        'team' => $request->nama_team,
                        'anggota' => $item['anggota']
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
                    $extension = $item['foto']->getClientOriginalExtension();
                    $randomString = md5(uniqid(rand(), true));
                    $filename = time() . '_' . $randomString . '.' . $extension;
                    $destination = 'images/upload/portofolio';
                    $item['foto']->move(public_path($destination), $filename);

                    // Update or create foto record
                    portofolio_foto::updateOrCreate(
                        [
                            'id_portofolio' => $portofolio->id_portofolio,
                            'judul_foto' => $item['judul_foto']
                        ],
                        [
                            'id_portofolio_foto' => 'img' . $portofolio->id_portofolio . $item['judul_foto'],
                            'foto' => $filename
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
