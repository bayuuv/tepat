<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\WebProfile;
use File;

class WebProfileController extends Controller
{
    public function index()
    {
        $userID = session()->get('user_id');
        if($userID != null){
            $data = WebProfile::select('judul', 'logo', 'subtitle', 'ket', 'isi')->get();
     
            return view('backend.dashboard.web-profile.index', compact('data'));
        }
        else{
            return redirect('login');
        }
    }

    public function update(Request $req)
    {
        $userID = session()->get('user_id');
        if($userID != null){
            $this->validate($req,[
                'judul' => 'required|min:4|max:50',
                'subtitle' => 'required|min:8|max:100',
                'ket' => 'required',
                'isi' => 'required'
            ]);

            $logo = $req->file('logo_file');
            $upload_path = 'public/uploaded_files/web-profile';

            DB::table('web_profile')->where('id_profile', 1)->update([
                'judul' => $req->judul,
                'subtitle' => $req->subtitle,
                'ket' => $req->ket,
                'isi' => $req->isi,
                'diperbarui' => now()
            ]);

            if($logo != null){
                $oldImg = DB::table('web_profile')->where('id_profile', 1)->first()->logo;
                File::delete('public/uploaded_files/web-profile/'.$oldImg);

                DB::table('web_profile')->where('id_profile', 1)->update(['logo' => $logo->getClientOriginalName(), 'diperbarui' => now()]);

                $logo->move($upload_path, $logo->getClientOriginalName());
            }

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Data berhasil simpan.'); 
            return redirect('setting-pages/web-profile');
        }
        else{
            return redirect('login');
        }
    }

    public function informasiWeb()
    {
        $userID = session()->get('user_id');
        if($userID != null){
            $data = WebProfile::select('kontak')->get();
     
            return view('backend.dashboard.web-profile.informasi-web', compact('data'));
        }
        else{
            return redirect('login');
        }
    }

    public function informasiWebUpdate(Request $req)
    {
        $userID = session()->get('user_id');
        if($userID != null){
            $this->validate($req, ['isi' => 'required']);

            DB::table('web_profile')->where('id_profile', 1)->update([
                'kontak' => $req->isi
            ]);
     
            Session::flash('class', 'alert-success');
            Session::flash('message', 'Data berhasil simpan.'); 
            return redirect('setting-pages/web-profile/informasi-web');
        }
        else{
            return redirect('login');
        }
    }
}
