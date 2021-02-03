<?php

namespace App\Exports;

use App\Anggota;
use Maatwebsite\Excel\Concerns\FromCollection;

class AnggotaPACExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Anggota::select('akun.nama_akun', 'anggota.no_anggota', 'anggota.nik', 'anggota.nama_anggota', 'anggota.alamat', 'anggota.tempat_lahir', 'anggota.tgl_lahir', 'anggota.jenis_kelamin', 'anggota.no_telp', 'anggota.dibuat', 'anggota.diperbarui')
        ->join('akun', 'akun.id_akun', 'anggota.id_akun')
        ->where('akun.id_level', 4)
        ->get();
    }
}
