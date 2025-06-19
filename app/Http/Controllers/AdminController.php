<?php

namespace App\Http\Controllers;

use App\Exports\PemesananExport;
use App\Models\Kendaraan;
use App\Models\Pemesanan;
use Spatie\Activitylog\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    public function home()
    {
       return view('admin.home', [
        'jumlahKendaraan' => Kendaraan::count(),
        'jumlahPemesanan' => Pemesanan::count(),
        'jumlahUser' => User::count(),
        'jumlahAktivitas' => Activity::count(),
    ]);
    }

    public function pemesanan()
    {
        $pemesanan = Pemesanan::all();
        return view('admin.pemesanan', [
            'pemesanan' => $pemesanan,
            'kendaraan' => Kendaraan::all(),
        ]);
    }

    public function aktivitas()
    {
        $activities = Activity::all();

        return view('admin.aktivitas', [
            'activities' => $activities,
        ]);
    }

    public function deleteAll()
    {
        Activity::truncate();

        return redirect()->route('admin.aktivitas')->with('success', 'Semua aktivitas telah dihapus.');
    }

    public function export()
    {
        return Excel::download(new PemesananExport, 'laporan_pemesanan.xlsx');
    }

    public function grafik()
    {
        $dataKendaraan = Pemesanan::where('pemesanans.status', 2) // Status disetujui
            ->join('kendaraans', 'pemesanans.kendaraan_id', '=', 'kendaraans.id')
            ->select('kendaraans.jenis')
            ->selectRaw('COUNT(*) as jumlah')
            ->groupBy('kendaraans.jenis')
            ->get();

        $jenis = [];
        $jumlah = [];

        foreach ($dataKendaraan as $kendaraan) {
            $jenis[] = $kendaraan->jenis;
            $jumlah[] = $kendaraan->jumlah;
        }

        return view('admin.grafik', [
            'dataGrafik' => json_encode([
                'jenis' => $jenis,
                'jumlah' => $jumlah,
            ])
        ]);
    }

}
