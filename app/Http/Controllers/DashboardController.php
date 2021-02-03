<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\WebProfile;

class DashboardController extends Controller
{
    public function index(){
        $userID = session()->get('user_id');
        $level = session()->get('level');

        if($userID != null){
            $web_profile = WebProfile::all()->toArray();
            if($level == 'Super Admin' || $level == 'Admin'){
                $dpp = DB::table('akun')->where('id_level', 2)->get();
                $dpc = DB::table('akun')->where('id_level', 3)->get();
                $pac = DB::table('akun')->where('id_level', 4)->get();
                $anggota = DB::table('anggota')->get();
                $pria = DB::table('anggota')->where('jenis_kelamin', 'L')->get();
                $wanita = DB::table('anggota')->where('jenis_kelamin', 'P')->get();

                return view('backend.dashboard.index', ['dpp' => $dpp->count(),
                                                        'dpc' => $dpc->count(),
                                                        'pac' => $pac->count(),
                                                        'anggota' => $anggota->count(),
                                                        'pria' => $pria->count(),
                                                        'wanita' => $wanita->count(),
                                                        'web_profile' => $web_profile
                                                        ]);
            }
            else{
                $dpp = DB::table('akun')->where('id_level', 2)->get();
                $dpc = DB::table('akun')->where('id_level', 3)->get();
                $pac = DB::table('akun')->where('id_level', 4)->get();
                $anggota = DB::table('anggota')->where('anggota.id_akun', $userID)->get();
                $pria = DB::table('anggota')->where([['jenis_kelamin', 'L'], ['anggota.id_akun', $userID]])->get();
                $wanita = DB::table('anggota')->where([['jenis_kelamin', 'P'], ['anggota.id_akun', $userID]])->get();

                return view('backend.dashboard.index', ['dpp' => $dpp->count(),
                                                        'dpc' => $dpc->count(),
                                                        'pac' => $pac->count(),
                                                        'anggota' => $anggota->count(),
                                                        'pria' => $pria->count(),
                                                        'wanita' => $wanita->count(),
                                                        'web_profile' => $web_profile
                                                        ]);
            }
            
        }
        else{
            return redirect('login');
        }
    }
}
