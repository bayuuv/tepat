<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Jabatan;
use App\SubJabatan;

class SubJabatanController extends Controller
{
    public function index(){
        $userID = session()->get('user_id');
        if($userID != null){
            $data = SubJabatan::join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')->get();

            return view('backend.dashboard.sub-jabatan.index', compact('data'));
        }
        else{
            return redirect('login');
        }
        return view('backend.dashboard.sub-jabatan.index');
    }

    public function add(){
        $userID = session()->get('user_id');
        if($userID != null){
            $jabatan = Jabatan::where('id_jabatan', '>', 1)->get();

            return view('backend.dashboard.sub-jabatan.add', compact('jabatan'));
        }
        else{
            return redirect('login');
        }

        return view('backend.dashboard.sub-jabatan.add');
    }

    public function store(Request $req){
        $userID = session()->get('user_id');
        if($userID != null){
            $this->validate($req, [
                'nama_sub_jabatan' => 'required|max:30',
                'prioritas' => 'required'
            ]);
    
            if($req->id_jabatan != null){
                DB::table('sub_jabatan')->insert([
                    'id_jabatan' => $req->id_jabatan,
                    'nama_sub_jabatan' => $req->nama_sub_jabatan,
                    'prioritas' => $req->prioritas
                ]);
            }
            else{
                DB::table('sub_jabatan')->insert([
                    'id_jabatan' => 1,
                    'nama_sub_jabatan' => $req->nama_sub_jabatan,
                    'prioritas' => $req->prioritas
            ]);
            }

            Session::flash('message', 'Data berhasil diinputkan.'); 
            return redirect('sub-jabatan');
        }
        else{
            return redirect('login');
        }
    }

    public function edit($id_sub_jabatan){
        $data = DB::table('sub_jabatan')
                    ->where('id_sub_jabatan', $id_sub_jabatan)
                    ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                    ->get();

        $jabatan = Jabatan::where('id_jabatan', '>', 1)->get();
        
        return view('backend.dashboard.sub-jabatan.edit', ['data' => $data], compact('jabatan'));
    }

    public function update(Request $req){
        $userID = session()->get('user_id');
        if($userID != null){
            $this->validate($req, [
                'id_sub_jabatan' => 'required',
                'nama_sub_jabatan' => 'required|max:30',
                'prioritas' => 'required'
                ]);

            if($req->id_jabatan != null){
                DB::table('sub_jabatan')->where('id_sub_jabatan', $req->id_sub_jabatan)->update([
                    'id_jabatan' => $req->id_jabatan,
                    'nama_sub_jabatan' => $req->nama_sub_jabatan,
                    'prioritas' => $req->prioritas
                ]);
            }
            else{
                DB::table('sub_jabatan')->where('id_sub_jabatan', $req->id_sub_jabatan)->update([
                    'id_jabatan' => 1,
                    'nama_sub_jabatan' => $req->nama_sub_jabatan,
                    'prioritas' => $req->prioritas
                ]);
            }

            Session::flash('message', 'Data berhasil diedit.'); 
            return redirect('sub-jabatan');
        }
        else{
            return redirect('login');
        }
    }

    public function delete($id_sub_jabatan){
        $userID = session()->get('user_id');
        if($userID != null){
            DB::table('sub_jabatan')->where('id_sub_jabatan', $id_sub_jabatan)->delete();

            Session::flash('message', 'Data berhasil dihapus.'); 
            return redirect('sub-jabatan');
        }
        else{
            return redirect('login');
        }

        return redirect('sub-jabatan');
    }
}
