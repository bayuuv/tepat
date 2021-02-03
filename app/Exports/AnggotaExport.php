<?php

namespace App\Exports;

use App\Anggota;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

// class AnggotaExport implements FromCollection, WithHeadings
// {
//     /**
//     * @return \Illuminate\Support\Collection
//     */
    
//     // protected $id_akun;
//     // protected $id_level;
//     protected $data;

//     function __construct($data) {
//         $this->data = $data;
//     }
    
//     public function collection()
//     {
//         return $this->data;
        
//     }
    
//     public function headings(): array
//     {
//         return [
//             'No. Anggota',
//             'Nama',
//             'Nik',
//             'Alamat',
//             'Jenis Kelamin',
//             'Keterangan',
//             'Jabatan',
//         ];
//     }
// }
class AnggotaExport implements FromView{
    
    protected $data;

    function __construct($data) {
        $this->data = $data;
    }
    
    public function view(): View{
        return view('backend.dashboard.anggota.export', [
                'data' => $this->data
            ]);
    }
}