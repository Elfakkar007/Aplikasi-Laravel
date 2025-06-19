<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pemesanan;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  $pemesanan = Pemesanan::all();
        return view('admin.pemesanan', [
            'pemesanan' => $pemesanan,
            'kendaraan' => Kendaraan::all(),
           
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pemesanan.create', [
        'kendaraans' => Kendaraan::where('status', 1)->get(),
        'kendaraans' => Kendaraan::where('stok', '>', 0)->get(), // hanya kendaraan yang tersedia
    ]);
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $request->validate([
        'tanggal_pemesanan' => 'required',
        'kendaraan_id' => [
            'required',
            Rule::exists('kendaraans', 'id')->where('status', 1),
        ],
        'status' => 'required',
    ]);

    $kendaraan = Kendaraan::findOrFail($request->kendaraan_id);

    if ($kendaraan->stok < 1) {
        return back()->with('error', 'Stok kendaraan tidak mencukupi');
    }

    // Kurangi stok langsung saat pengajuan
    $kendaraan->stok -= 1;
    if ($kendaraan->stok == 0) {
        $kendaraan->status = 0;
    }
    $kendaraan->save();

    $data = Pemesanan::create([
        'tanggal_pemesanan' => $request->tanggal_pemesanan,
        'kendaraan_id' => $request->kendaraan_id,
        'status' => $request->status,
    ]);

    activity()
        ->causedBy(Auth::user())
        ->log('Menambahkan pemesanan baru: ' . $data->id);

    return redirect()->route('pemesanan.index')->with('success', 'Add Data Successfully');
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
        $pemesanan = Pemesanan::findOrFail($id);
        return view('pemesanan.edit', [
            'pemesanan' => $pemesanan,
            'kendaraans' => Kendaraan::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal_pemesanan' => 'required',
            'kendaraan_id' => 'required',
            'status' => 'required',
        ]);

        $pemesanan = Pemesanan::findOrFail($id);

        $pemesanan->tanggal_pemesanan = $request->tanggal_pemesanan;
        $pemesanan->kendaraan_id = $request->kendaraan_id;
        $pemesanan->status = $request->status;
        $pemesanan->save();

        activity()
            ->causedBy(Auth::user())
            ->log('Memperbarui pemesanan: ' . $pemesanan->id);

        return redirect()->route('pemesanan.index')->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
public function destroy(Pemesanan $pemesanan)
{
    $kendaraan = $pemesanan->kendaraan;

    // Jika status ≠ 0 (belum ditolak), berarti stok masih dipakai
    if ($pemesanan->status != 0) {
        $kendaraan->stok += 1;

        if ($kendaraan->stok > 0) {
            $kendaraan->status = 1;
        }

        $kendaraan->save();
    }

    $pemesanan->delete();

    activity()
        ->causedBy(Auth::user())
        ->log('Menghapus pemesanan: ' . $pemesanan->id);

    return redirect()->route('pemesanan.index')->with('success', 'Data berhasil dihapus!');
}




  public function approve($id)
{
    $pemesanan = Pemesanan::findOrFail($id);
    $pemesanan->status = 2; // Disetujui
    $pemesanan->save();

    return back()->with('success', 'Pemesanan disetujui.');
}

 public function reject($id)
{
    $pemesanan = Pemesanan::findOrFail($id);
    $kendaraan = $pemesanan->kendaraan;

    // Kembalikan stok karena ditolak
    $kendaraan->stok += 1;
    if ($kendaraan->stok > 0) {
        $kendaraan->status = 1;
    }
    $kendaraan->save();

    $pemesanan->status = 0; // Ditolak
    $pemesanan->save();

    return back()->with('success', 'Pemesanan ditolak dan stok dikembalikan.');
}



}
