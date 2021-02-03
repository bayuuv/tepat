<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Response;
use App\Jabatan;
use App\SubJabatan;
use App\Anggota;
use App\Akun;
use App\Pac;

class PengurusController extends Controller
{
    // public function fetch(Request $req){
    //     $select = $req->get('select');
    //     $value = $req->get('value');
    //     $dependent = $req->get('dependent');

    //     $data = DB::table('akun')
    //                 ->select('akun.id_akun', 'akun.nama_akun', 'anggota.no_anggota')
    //                 ->join('anggota', 'anggota.id_akun', 'akun.id_akun')
    //                 ->where($select, $value)
    //                 ->groupBy($dependent)
    //                 ->get();

    //     $output = '<option value="">Select '.ucfirst($dependent).'</option>';
    //     foreach($data as $row){
    //         $output .= '<option value="'.$row->dependent.'">'.$row->dependent.'</option>';
    //     }
    //     echo $output;
    // }

    public function getAnggota($no_anggota){
        $anggota = Anggota::where([['id_sub_jabatan', 1], ['no_anggota', $no_anggota]])->get();

        // $data = json_encode($anggota);
        return Response::json(['success'=>true, 'info'=>$anggota]);
    }

    public function dpp(){
        $userID = session()->get('user_id');
        if($userID != null){
            $data = Anggota::join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                    ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                    ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                    ->where([['anggota.id_sub_jabatan', '!=', 1], ['akun.id_level', 2]])
                    ->orderBy('no_anggota', 'DESC')
                    ->get();

            return view('backend.dashboard.pengurus.dpp', compact('data'));
        }
        else{
            return redirect('login');
        }
    }

    public function dpp_add(){
        $userID = session()->get('user_id');
        $level = session()->get('level');
        if($userID != null){
            if($level == 'Super Admin' || $level == 'Admin'){
                $jabatan = SubJabatan::join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')->get();
                $anggota = Anggota::where('id_sub_jabatan', 1)->get();
                // return $anggota;
    
                return view('backend.dashboard.pengurus.add-dpp', compact('jabatan'), compact('anggota'));
            }
            else{    
                $jabatan = SubJabatan::join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')->get();
                $anggota = Anggota::where([['id_sub_jabatan', 1], ['anggota.id_akun', $userID]])
                                    ->get();

                return view('backend.dashboard.pengurus.add-dpp', compact('jabatan'), compact('anggota'));
            }
        }
        else{
            return redirect('login');
        }
    }

    public function dppStore(Request $req){
        $userID = session()->get('user_id');
        if($userID != null){
            $this->validate($req,[
                'no_anggota' => 'required',
                'jabatan' => 'required'
            ]);
            
            DB::table('anggota')
                ->where('no_anggota', $req->no_anggota)
                ->update([
                    'id_sub_jabatan' => $req->jabatan,
                    'diperbarui' => now()
                ]);

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Berhasil.'); 
            return redirect('pengurus/dpp');
        }
        else{
            return redirect('login');
        }
    }

    public function dppDelete($no_anggota){
        $userID = session()->get('user_id');
        if($userID != null){
            if($no_anggota != null){
                DB::table('anggota')
                    ->where('no_anggota', $no_anggota)
                    ->update([
                        'id_sub_jabatan' => 1,
                        'diperbarui' => now()
                    ]);

                Session::flash('class', 'alert-success');
                Session::flash('message', 'Pengurus berhasil dihapus.');                 
                return redirect('pengurus/dpp');
            }
            else{
                Session::flash('class', 'alert-warning');
                Session::flash('message', 'Harap pilih anggota terlebih dahulu.');                 
                return redirect('pengurus/dpp');
            }
        }
        else{
            return redirect('login');
        }
    }
    
    public function dpp_edit($no_anggota){
        $userID = session()->get('user_id');
        $level = session()->get('level');
        if($userID != null){
            if($level == 'Super Admin' || $level == 'Admin'){
                $data = Anggota::where('no_anggota', $no_anggota)->get();
                $jabatan = SubJabatan::join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')->get();
    
                return view('backend.dashboard.pengurus.edit-dpp', compact('jabatan'), compact('data'));
            }
            else{    
                $data = Anggota::where('no_anggota', $no_anggota)->get();
                $jabatan = SubJabatan::join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')->get();

                return view('backend.dashboard.pengurus.edit-dpp', compact('jabatan'), compact('data'));
            }
        }
        else{
            return redirect('login');
        }
    }

    public function dpc(){
        $userID = session()->get('user_id');
        if($userID != null){
            $data = Anggota::join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                    ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                    ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                    ->where([['anggota.id_sub_jabatan', '!=', 1], ['akun.id_level', 3]])
                    ->orderBy('no_anggota', 'DESC')
                    ->get();

            $pilihanKedua = Akun::select('akun.id_akun', 'akun.id_dewan', 'akun.nama_akun', 'akun.id_level')
                    ->where('akun.id_level', 3)
                    ->get();

            return view('backend.dashboard.pengurus.dpc', compact('data'), compact('pilihanKedua'))->with('id_akun', '');
        }
        else{
            return redirect('login');
        }
    }

    public function dpc_add(){
        $userID = session()->get('user_id');
        $level = session()->get('level');
        if($userID != null){
            if($level == 'Super Admin' || $level == 'Admin'){
                $dpc = DB::table('akun')
                            ->select('akun.id_akun', 'akun.nama_akun')
                            ->where('akun.id_level', 3)
                            ->groupBy('akun.id_akun')
                            ->get();
                            
                $jabatan = SubJabatan::join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')->get();
                $anggota = Anggota::where('id_sub_jabatan', 1)->get();
                // return  ['anggota' => $anggota , compact('jabatan')];
                return view('backend.dashboard.pengurus.add-dpc', compact('dpc'), ['anggota' => $anggota , 'jabatan' => $jabatan]);
            }
            else{    
                $jabatan = SubJabatan::join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')->get();
                $anggota = Anggota::where([['id_sub_jabatan', 1], ['anggota.id_akun', $userID]])
                                    ->get();

                return view('backend.dashboard.pengurus.add-dpc', compact('jabatan'), compact('anggota'));
            }
        }
        else{
            return redirect('login');
        }
    }

    public function dpcStore(Request $req){
        $userID = session()->get('user_id');
        if($userID != null){
            $this->validate($req,[
                'nama_dpc' => 'required',
                'no_anggota' => 'required',
                'jabatan' => 'required'
            ]);
            
            DB::table('anggota')
                ->where('no_anggota', $req->no_anggota)
                ->update([
                    'id_sub_jabatan' => $req->jabatan,
                    'diperbarui' => now()
                ]);

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Berhasil.'); 
            return redirect('pengurus/dpc');
        }
        else{
            return redirect('login');
        }
    }

    public function dpc_edit($no_anggota){
        $userID = session()->get('user_id');
        $level = session()->get('level');
        if($userID != null){
            if($level == 'Super Admin' || $level == 'Admin'){
                $data = Anggota::where('no_anggota', $no_anggota)->join('akun', 'akun.id_akun', 'anggota.id_akun')->get();
                $jabatan = SubJabatan::join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')->get();

                $dpc = DB::table('akun')
                            ->select('akun.id_akun', 'akun.nama_akun')
                            ->where('akun.id_level', 3)
                            ->groupBy('akun.id_akun')
                            ->get();

                $anggota = Anggota::get();
    
                return view('backend.dashboard.pengurus.edit-dpc', ['data' => $data, 'jabatan' => $jabatan, 'dpc' => $dpc, 'anggota' => $anggota]);
            }
            else{    
                $data = Anggota::where('no_anggota', $no_anggota)->get();
                $jabatan = SubJabatan::join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')->get();

                return view('backend.dashboard.pengurus.edit-dpc', compact('jabatan'), compact('data'));
            }
        }
        else{
            return redirect('login');
        }
    }

    public function dpcDelete($no_anggota){
        $userID = session()->get('user_id');
        if($userID != null){
            if($no_anggota != null){
                DB::table('anggota')
                    ->where('no_anggota', $no_anggota)
                    ->update([
                        'id_sub_jabatan' => 1,
                        'diperbarui' => now()
                    ]);

                Session::flash('class', 'alert-success');
                Session::flash('message', 'Pengurus berhasil dihapus.');                 
                return redirect('pengurus/dpc');
            }
            else{
                Session::flash('class', 'alert-warning');
                Session::flash('message', 'Harap pilih anggota terlebih dahulu.');                 
                return redirect('pengurus/dpc');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function pac(){
        $userID = session()->get('user_id');
        if($userID != null){
            $data = Anggota::join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                    ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                    ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                    ->where([['anggota.id_sub_jabatan', '!=', 1], ['akun.id_level', 4]])
                    ->orderBy('no_anggota', 'DESC')
                    ->get();
            
            $pilihanKedua = Akun::select('akun.id_akun', 'akun.id_dewan', 'akun.nama_akun', 'akun.id_level')
                    ->where('akun.id_level', 3)
                    ->get();

            return view('backend.dashboard.pengurus.pac', compact('data'), compact('pilihanKedua'))->with('id_akun','')->with('pac','');
        }
        else{
            return redirect('login');
        }
    }

    public function pac_add(){
        $userID = session()->get('user_id');
        $level = session()->get('level');
        if($userID != null){
            if($level == 'Super Admin' || $level == 'Admin'){
                $dpc = DB::table('akun')
                            ->select('akun.id_akun', 'akun.nama_akun', 'anggota.no_anggota')
                            ->join('anggota', 'anggota.id_akun', 'akun.id_akun')
                            ->where('akun.id_level', 4)
                            ->groupBy('akun.id_akun')
                            ->get();
                            
                $jabatan = SubJabatan::join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')->get();
                $anggota = Anggota::where('id_sub_jabatan', 1)->get();
                // return  ['anggota' => $anggota , compact('jabatan')];
                return view('backend.dashboard.pengurus.add-pac', ['dpc' => $dpc, 'anggota' => $anggota , 'jabatan' => $jabatan]);
            }
            else{    
                $jabatan = SubJabatan::join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')->get();
                $anggota = Anggota::where([['id_sub_jabatan', 1], ['anggota.id_akun', $userID]])
                                    ->get();

                return view('backend.dashboard.pengurus.add-pac', compact('jabatan'), compact('anggota'));
            }
        }
        else{
            return redirect('login');
        }
    }

    public function pacStore(Request $req){
        $userID = session()->get('user_id');
        if($userID != null){
            $this->validate($req,[
                'nama_pac' => 'required',
                'no_anggota' => 'required',
                'jabatan' => 'required'
            ]);
            
            DB::table('anggota')
                ->where('no_anggota', $req->no_anggota)
                ->update([
                    'id_sub_jabatan' => $req->jabatan,
                    'diperbarui' => now()
                ]);

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Berhasil.'); 
            return redirect('pengurus/pac');
        }
        else{
            return redirect('login');
        }
    }

    public function pac_edit($no_anggota){
        $userID = session()->get('user_id');
        $level = session()->get('level');
        if($userID != null){
            $data = Anggota::where('no_anggota', $no_anggota)->join('akun', 'akun.id_akun', 'anggota.id_akun')->get();
            $jabatan = SubJabatan::join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')->get();
            
            return view('backend.dashboard.pengurus.edit-pac', ['data' => $data, 'jabatan' => $jabatan]);
        }
        else{
            return redirect('login');
        }
    }

    public function pacDelete($no_anggota){
        $userID = session()->get('user_id');
        if($userID != null){
            if($no_anggota != null){
                DB::table('anggota')
                    ->where('no_anggota', $no_anggota)
                    ->update([
                        'id_sub_jabatan' => 1,
                        'diperbarui' => now()
                    ]);

                Session::flash('class', 'alert-success');
                Session::flash('message', 'Pengurus berhasil dihapus.');                 
                return redirect('pengurus/pac');
            }
            else{
                Session::flash('class', 'alert-warning');
                Session::flash('message', 'Harap pilih anggota terlebih dahulu.');                 
                return redirect('pengurus/pac');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function dpcWil($wil){
        $userID = session()->get('user_id');
        if($userID != null){
            $data = Anggota::join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                    ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                    ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                    ->where([['anggota.id_sub_jabatan', '!=', 1], ['akun.id_level', 3], ['akun.nama_akun', $wil]])
                    ->orderBy('no_anggota', 'DESC')
                    ->get();

            $pilihanKedua = Akun::select('akun.id_akun', 'akun.nama_akun', 'akun.id_level')
                    ->where('akun.id_level', 3)
                    ->get();

            return view('backend.dashboard.pengurus.dpc', compact('data'), compact('pilihanKedua'))->with('id_akun', $wil);
        }
        else{
            return redirect('login');
        }
    }

    public function pacWil($wil){
        $userID = session()->get('user_id');
        if($userID != null){
            $data = Anggota::join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                    ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                    ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                    ->where([['anggota.id_sub_jabatan', '!=', 1], ['akun.id_level', 4]])
                    ->orderBy('no_anggota', 'DESC')
                    ->get();

            $pilihanKedua = Akun::select('akun.id_akun', 'akun.id_dewan', 'akun.nama_akun', 'akun.id_level')
                    ->where('akun.id_level', 3)
                    ->get();

            $pilihanPac = Pac::select('id_pac', 'id_dewan', 'nama_pac')
                    ->where('id_dewan', $wil)
                    ->get();

            return view('backend.dashboard.pengurus.pac', compact('data'), compact('pilihanKedua'))->with('id_akun', $wil)->with('pilihanPac',$pilihanPac)->with('id_pac', '');
        }
        else{
            return redirect('login');
        }
    }

    public function pacWilUnit($wil,$un){
        $userID = session()->get('user_id');
        if($userID != null){
            $data = Anggota::join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                    ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                    ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                    ->where([['anggota.id_sub_jabatan', '!=', 1], ['akun.id_level', 4], ['akun.id_pac', $un]])
                    ->orderBy('no_anggota', 'DESC')
                    ->get();

            $pilihanKedua = Akun::select('akun.id_akun', 'akun.id_dewan', 'akun.nama_akun', 'akun.id_level')
                    ->where('akun.id_level', 3)
                    ->get();

            $pilihanPac = Pac::select('id_pac', 'id_dewan', 'nama_pac')
                    ->where('id_dewan', $wil)
                    ->get();

            return view('backend.dashboard.pengurus.pac', compact('data'), compact('pilihanKedua'))->with('id_akun', $wil)->with('pilihanPac',$pilihanPac)->with('id_pac', $un);
        }
        else{
            return redirect('login');
        }
    }
}
