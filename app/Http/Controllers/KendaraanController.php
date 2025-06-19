<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kendaraan = Kendaraan::all();
        return view('admin.kendaraan', [
            'kendaraan' => $kendaraan,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kendaraan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required',
            'tahun_pembuatan' => 'required|numeric',
            'status' => 'required',
            'stok' => 'required|numeric|min:0',
        ]);

        $data = Kendaraan::create([
            'jenis' => $request->jenis,
            'tahun_pembuatan' => $request->tahun_pembuatan,
            'status' => $request->status,
            'stok' => $request->stok,


        ]);

        activity()
            ->causedBy(Auth::user())
            ->log('Menambahkan kendaraan baru: ' . $data->jenis);

        return redirect()->route('kendaraan.index')->with('success', 'Add Data Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return view('kendaraan.edit', [
            'kendaraan' => $kendaraan,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'jenis' => 'required',
            'tahun_pembuatan' => 'required|numeric',
            'status' => 'required',
            'stok' => 'required|numeric|min:0',
            
        ]);

        $kendaraan = Kendaraan::findOrFail($id);

        $kendaraan->jenis = $request->jenis;
        $kendaraan->tahun_pembuatan = $request->tahun_pembuatan;
        $kendaraan->status = $request->status;
        $kendaraan->stok = $request->stok;

        $kendaraan->save();

        activity()
            ->causedBy(Auth::user())
            ->log('Memperbarui kendaraan: ' . $kendaraan->jenis);

        return redirect()->route('kendaraan.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kendaraan $kendaraan)
    {
        $kendaraan->delete();

        activity()
            ->causedBy(Auth::user())
            ->log('Menghapus kendaraan: ' . $kendaraan->jenis);

        return redirect()->route('kendaraan.index')->with('success', 'Data berhasil dihapus!');
    }
}
