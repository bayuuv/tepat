<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Auth;
use Eloquent;

use App\Akun;

class ChangePasswordController extends Controller
{
    public function index(){
        $userID = session()->get('user_id');

        if($userID != null){
            return view('backend.dashboard.change-password');
        }
        else{
            return redirect('login');
        }
    }
    
    public function update(Request $req){
        $userID = session()->get('user_id');
        $data = Akun::where('akun.id_akun', $userID)->first();
                    
        $oldPass = $data->password;

        if($userID != null){
            // if(Hash::check($req->old_password, $oldPass)){
            //     $this->required($req, [
            //             'old_password' => 'required|min:3',
            //             'new_password' => 'required|min:3',
            //         ]);
                
            //     DB::table('akun')->where('id_akun', $userID)->update([
            //         'password' => Hash::make($req->new_password),
            //         'diperbarui' => now()
            //     ]);
                
            //     Session::flash('class', 'alert-success');
            //     Session::flash('message', 'Password berhasil diubah.'); 
            //     return redirect('dashboard/change-password');
            // }
            // else{
            //     Session::flash('class', 'alert-danger');
            //     Session::flash('message', 'Password lama tidak sesuai.'); 
            //     return redirect('dashboard/change-password');
            // }
            
            if(!(Hash::check($req->get('old_password'),$oldPass))){
                 Session::flash('class', 'alert-danger');
                 Session::flash('message', 'Password lama tidak sesuai.'); 
                 return redirect('dashboard/change-password');
            }
            if(strcmp($req->get('old_password'), $req->get('new_password'))==0){
                Session::flash('class', 'alert-danger');
                Session::flash('message', 'Password lama tidak boleh sama.'); 
                return redirect('dashboard/change-password');
            }
            $req->validate([
                    'old_password' => 'required',
                    'new_password' => 'required|min:3'
                ]);
                 DB::table('akun')->where('id_akun', $userID)->update([
                    'password' => bcrypt($req->get('new_password')),
                  'diperbarui' => now()
                ]);
            // $user = $data;
            // $user->password = bcrypt($req->get('new_password'));
            // $user->save();
            Session::flash('class', 'alert-success');
            Session::flash('message', 'Password berhasil diubah.'); 
            return redirect('dashboard/change-password');
            
        }
        else{
            return redirect('login');
        }
    }
}