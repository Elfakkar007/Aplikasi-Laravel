<?php

namespace App\Exports;

use App\Models\Pemesanan;
use Maatwebsite\Excel\Concerns\FromCollection;

class PemesananExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $pemesanans = Pemesanan::with('kendaraan')->get();

        return $pemesanans->map(function ($pemesanan) {
            $status = '';
            switch ($pemesanan->status) {
                case 0:
                    $status = 'Ditolak';
                    break;
                case 1:
                    $status = 'Diajukan';
                    break;
                case 2:
                    $status = 'Disetujui';
                    break;
                default:
                    $status = 'Tidak Valid';
            }

            return [
                'ID Pemesanan' => $pemesanan->id,
                'Jenis Kendaraan' => $pemesanan->kendaraan->jenis,
                'Tanggal Pemesanan' => $pemesanan->tanggal_pemesanan,
                'Status' => $status,
            ];
        });
    }

}
