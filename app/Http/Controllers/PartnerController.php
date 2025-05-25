<?php

namespace App\Http\Controllers;

use App\Models\partner;
use App\Http\Requests\StorepartnerRequest;
use App\Http\Requests\UpdatepartnerRequest;
use App\Models\perusahaan;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $partners = Partner::all();

        return view('admin.partner.homePartner', compact('partners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.partner.createPartner', [
            'perusahaans' => perusahaan::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_partner =  $request->id_perusahaan . '_' . $request->nama_partner;
        $request->merge([
            'id_partner' => $id_partner,
            // 'password' => bcrypt($request->password) // hash password juga di sini
        ]);
        $data = $request->all();
        if ($request->hasFile('foto')) {
            $filename = time() . '_' . $request->file('foto')->getClientOriginalName();
            $destination = 'image/upload/foto';
            $request->file('foto')->move(public_path($destination), $filename);
            $data['foto'] = $destination . '/' . $filename;
        }

        partner::create($data);
        return redirect('/dashboard/partner')->with('success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(partner $partner)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        partner::where('id', $id)
            ->update($request->except('_token', '_method'));
        return redirect('/dashboard/perusahaan')->with('success', 'Data Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        partner::destroy($id);
        return redirect('/dashboard/partner')->with('success', 'Data Berhasil dihapus');
    }

    public function edit(partner $partner)
    {
        return view('admin.partner.partner-edit', [
            'partner' => $partner
        ]);
    }
}
