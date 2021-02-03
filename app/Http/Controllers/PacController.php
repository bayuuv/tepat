<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Dewan;
use App\Pac;
use App\Akun;

class PacController extends Controller
{
    public function index(){
        $userID = session()->get('user_id');
        if($userID != null){
            $data = DB::table('pac')->select('dewan.nama', 'pac.*', 'akun.*')
                        ->join('dewan', 'dewan.id_dewan', '=', 'pac.id_dewan')
                        ->join('akun', 'pac.id_pac', 'akun.id_pac')
                        ->where('akun.id_level', '4')
                        ->get();
                        
            $dewan = Akun::select('id_dewan', 'nama_akun')->where('id_level', 3)->get();
            
            return view('backend.dashboard.pac.index', compact('data'), compact('dewan'))->with('select', 'all');
        }
        else{
            return redirect('login');
        }
    }

    public function add(){
        $dpc = Dewan::where('akun.id_level', '3')
                        ->join('akun', 'dewan.id_dewan', 'akun.id_dewan')
                        ->get();

        return view('backend.dashboard.pac.add', compact('dpc'));
    }

    public function store(Request $req){
        $userID = session()->get('user_id');
        if($userID != null){
            $this->validate($req, [
                'dpc' => 'required',
                'nama' => 'required|min:3|max:100',
                'alamat' => 'required',
                'no_telp' => 'required|min:6|max:12',
                'username' => 'required|min:4|max:30',
                'password' => 'required|min:4'
            ]);
    
            DB::table('pac')->insert([
                'id_dewan' => $req->dpc,
                'nama_pac' => $req->nama,
                'alamat' => $req->alamat,
                'no_telp' => $req->no_telp
            ]);

            $lastId = Pac::orderBy('id_pac', 'desc')->first()->id_pac;

            DB::table('akun')->insert([
                'id_pac' => $lastId,
                'nama_akun' => $req->nama,
                'username' => $req->username,
                'password' => Hash::make($req->password),
                'id_level' => 4
            ]);

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Data berhasil diinputkan.'); 
            return redirect('pac');
        }
        else{
            return redirect('login');
        }
    }

    public function edit($id_pac){
        $data = DB::table('pac')->where('pac.id_pac', $id_pac)
                                ->select('pac.*', 'akun.username', 'akun.password')
                                ->join('akun', 'pac.id_pac', 'akun.id_pac')
                                ->get();

        $dpc = Dewan::where('akun.id_level', '3')
                        ->select('dewan.id_dewan',  'dewan.nama')
                        ->join('akun', 'dewan.id_dewan', 'akun.id_dewan')
                        ->get();
        
        return view('backend.dashboard.pac.edit', ['data' => $data], compact('dpc'));
    }

    public function update(Request $req){
        $userID = session()->get('user_id');
        if($userID != null){
            $this->validate($req, [
                'id_pac' => 'required',
                'dpc' => 'required',
                'nama' => 'required|min:3|max:100',
                'alamat' => 'required',
                'no_telp' => 'required|min:6|max:12',
                'username' => 'required|min:4|max:30',
                'password' => 'required|min:4'
            ]);

            DB::table('pac')->where('id_pac', $req->id_pac)->update([
                'id_dewan' => $req->dpc,
                'nama_pac' => $req->nama,
                'alamat' => $req->alamat,
                'no_telp' => $req->no_telp,
                'diperbarui' => now()
            ]);

            DB::table('akun')->where('id_pac', $req->id_pac)->update([
                'nama_akun' => $req->nama,  
                'username' => $req->username,
                'password' => Hash::make($req->password),
                'diperbarui' => now()
            ]);

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Data berhasil diedit.'); 
            return redirect('pac');
        }
        else{
            return redirect('login');
        }
    }

    public function delete($id_pac){
        $userID = session()->get('user_id');
        if($userID != null){
            DB::table('pac')->where('id_pac', $id_pac)->delete();

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Data berhasil dihapus.'); 
            return redirect('pac');
        }
        else{
            return redirect('login');
        }
    }
    
    public function sortirDPC($id_dewan){
        $dewan = Akun::select('id_dewan', 'nama_akun')->where('id_level', 3)->get();
        
        // $data = PAC::where('id_dewan', $id_dewan)->get();
        if($id_dewan == 'all'){
            $data = DB::table('pac')->select('dewan.nama', 'pac.*', 'akun.*')
                            ->join('dewan', 'dewan.id_dewan', '=', 'pac.id_dewan')
                            ->join('akun', 'pac.id_pac', 'akun.id_pac')
                            ->where('akun.id_level', '4')
                            ->get();
                            
            return view('backend.dashboard.pac.index', compact('data'), compact('dewan'))->with('select', $id_dewan);
        }
        else{
            $data = DB::table('pac')->select('dewan.nama', 'pac.*', 'akun.*')
                            ->join('dewan', 'dewan.id_dewan', '=', 'pac.id_dewan')
                            ->join('akun', 'pac.id_pac', 'akun.id_pac')
                            ->where('pac.id_dewan', $id_dewan)
                            ->get();
                            
            return view('backend.dashboard.pac.index', compact('data'), compact('dewan'))->with('select', $id_dewan);
        }
    }
}
