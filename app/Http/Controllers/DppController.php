<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
Use App\Dewan;

class DppController extends Controller
{
    public function index(){
        $userID = session()->get('user_id');
        if($userID != null){
            $data = Dewan::where('akun.id_level', '2')
                    ->join('akun', 'dewan.id_dewan', 'akun.id_dewan')
                    ->join('level', 'akun.id_level', 'level.id_level')
                    ->get();

            return view('backend.dashboard.dpp.index', compact('data'));
        }
        else{
            return redirect('login');
        }
        return view('backend.dashboard.dpp.add');
    }

    public function add(){
        return view('backend.dashboard.dpp.add');
    }

    public function store(Request $req){
        $userID = session()->get('user_id');
        if($userID != null){
            $this->validate($req, [
                'nama' => 'required|min:3|max:100',
                'alamat' => 'required',
                'no_telp' => 'required|min:6|max:12',
                'username' => 'required|min:4|max:30',
                'password' => 'required|min:4'
            ]);
    
            DB::table('dewan')->insert([
                'nama' => $req->nama,
                'alamat' => $req->alamat,
                'no_telp' => $req->no_telp
            ]);
            
            $lastId = Dewan::orderBy('id_dewan', 'desc')->first()->id_dewan;

            DB::table('akun')->insert([
                'id_dewan' => $lastId,
                'nama_akun' => $req->nama,
                'username' => $req->username,
                'password' => Hash::make($req->password),
                'id_level' => 2
            ]);

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Data berhasil diinputkan.'); 
            return redirect('dpp');
        }
        else{
            return redirect('login');
        }
    }

    public function edit($id_dewan){
        $data = Dewan::where('dewan.id_dewan', $id_dewan)
                    ->join('akun', 'dewan.id_dewan', 'akun.id_dewan')
                    ->join('level', 'akun.id_level', 'level.id_level')
                    ->get();
        
        return view('backend.dashboard.dpp.edit', ['data' => $data]);
    }

    public function update(Request $req){
        $userID = session()->get('user_id');
        if($userID != null){
            $this->validate($req, [
                'id_dewan' => 'required',
                'nama' => 'required|min:3|max:100',
                'alamat' => 'required',
                'no_telp' => 'required|min:6|max:12',
                'username' => 'required|min:4|max:30',
                'password' => 'required|min:4'
            ]);

            DB::table('dewan')->where('id_dewan', $req->id_dewan)->update([
                'nama' => $req->nama,
                'alamat' => $req->alamat,
                'no_telp' => $req->no_telp,
                'diperbarui' => now()
            ]);

            DB::table('akun')->where('id_dewan', $req->id_dewan)->update([
                'nama_akun' => $req->nama,
                'username' => $req->username,
                'password' => Hash::make($req->password),
                'diperbarui' => now()
            ]);

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Data berhasil diedit.'); 
            return redirect('dpp');
        }
        else{
            return redirect('login');
        }
    }

    public function delete($id_dewan){
        $userID = session()->get('user_id');
        if($userID != null){
            DB::table('dewan')->where('id_dewan', $id_dewan)->delete();
            DB::table('akun')->where('id_dewan', $id_dewan)->delete();

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Data berhasil dihapus.'); 
            return redirect('dpp');
        }
        else{
            return redirect('login');
        }
    }
}
