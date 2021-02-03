<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Akun;
use App\WebProfile;

class LoginController extends Controller
{
    public function index(){
        $userID = session()->get('user_id');
        if($userID != null){
            return redirect('dashboard');
        }
        else{
            $web_profile = WebProfile::all()->toArray();
            return view('backend.index', ['web_profile' => $web_profile]);
        }
    }

    public function loginProcess(Request $req){
        $username = $req->username;
        $password = $req->password;
        
        $data = Akun::where('akun.username', $username)
                    ->join('level', 'akun.id_level', 'level.id_level')
                    ->first();

        if($data){
            if(Hash::check($password, $data->password)){
                $web_profile = WebProfile::all()->first();
                
                Session::put('user_id', $data->id_akun);
                Session::put('nama_akun', $data->nama_akun);
                Session::put('level', $data->level);
                if($data->id_dewan != null){
                    Session::put('id_cabang', $data->id_dewan);
                }
                if($data->id_pac != null){
                    Session::put('id_cabang', $data->id_pac);
                }
                Session::put('logo', $web_profile->logo);
                Session::put('judul', $web_profile->judul);
                
                return redirect('dashboard');
            }
            else{
                Session::flash('class', 'alert-danger');
                Session::flash('message', 'Password salah!'); 
                return redirect('login');
            }
        }
        else{
            Session::flash('class', 'alert-danger');
            Session::flash('message', 'Akun tidak ditemukan.'); 
            return redirect('login');
        }

        return $data;
    }

    public function logout(){
        Session::flush();
        return redirect('login');
    }
}
