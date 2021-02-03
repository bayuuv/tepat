<?php

namespace App\Exports;

use App\Anggota;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AnggotaDPCExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
     public function view(): View
    {
        return view('backend.dashboard.anggota.index', [
            'anggota' => Anggota::all()
        ]);
    }
}
