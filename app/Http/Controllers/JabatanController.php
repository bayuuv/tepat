<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Jabatan;

class JabatanController extends Controller
{
    public function index(){
        $userID = session()->get('user_id');
        if($userID != null){
            $data = Jabatan::where('jabatan.id_jabatan', '>', '1')->get();

            return view('backend.dashboard.jabatan.index', compact('data'));
        }
        else{
            return redirect('login');
        }
        return view('backend.dashboard.jabatan.index');
    }

    public function add(){
        $userID = session()->get('user_id');
        if($userID != null){
            return view('backend.dashboard.jabatan.add');
        }
        else{
            return redirect('login');
        }

        return view('backend.dashboard.jabatan.add');
    }

    public function store(Request $req){
        $userID = session()->get('user_id');
        if($userID != null){
            $this->validate($req, [
                'nama_jabatan' => 'required|min:5|max:30'
            ]);
    
            DB::table('jabatan')->insert([
                'jabatan' => $req->nama_jabatan
            ]);

            Session::flash('message', 'Data berhasil diinputkan.'); 
            return redirect('jabatan');
        }
        else{
            return redirect('login');
        }
    }

    public function edit($id_jabatan){
        $data = DB::table('jabatan')->where('id_jabatan', $id_jabatan)->get();
        
        return view('backend.dashboard.jabatan.edit', ['data' => $data]);
    }

    public function update(Request $req){
        $userID = session()->get('user_id');
        if($userID != null){
            $this->validate($req, [
                'id_jabatan' => 'required',
                'nama_jabatan' => 'required|min:5|max:30']);

            DB::table('jabatan')->where('id_jabatan', $req->id_jabatan)->update(['jabatan' => $req->nama_jabatan]);

            Session::flash('message', 'Data berhasil diedit.'); 
            return redirect('jabatan');
        }
        else{
            return redirect('login');
        }
    }

    public function delete($id_jabatan){
        $userID = session()->get('user_id');
        if($userID != null){
            DB::table('jabatan')->where('id_jabatan', $id_jabatan)->delete();

            Session::flash('message', 'Data berhasil dihapus.'); 
            return redirect('jabatan');
        }
        else{
            return redirect('login');
        }

        return redirect('/jabatan');
    }
}
