<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Banner;
use File;

class BannerController extends Controller
{
    public function index()
    {
        $userID = session()->get('user_id');
        if($userID != null){
            $data = Banner::all()->toArray();
            
            return view('backend.dashboard.banner.index', compact('data'));
        }
        else{
            return redirect('login');
        }
    }

    public function add(){
        $userID = session()->get('user_id');
        if($userID != null){
            return view('backend.dashboard.banner.add');
        }
        else{
            return redirect('login');
        }
    }

    public function store(Request $req){
        $userID = session()->get('user_id');
        if($userID != null){
            $this->validate($req,[
                'banner_file' => 'required'
            ]);

            $gambar = $req->file('banner_file');
            $upload_path = 'public/uploaded_files/banner';

            DB::table('banner')->insert([
                'gambar' => $gambar->getClientOriginalName()
            ]);

            $gambar->move($upload_path, $gambar->getClientOriginalName());

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Data berhasil diinputkan.'); 
            return redirect('setting-pages/banner');
        }
        else{
            return redirect('login');
        }
    }

    public function edit($id_banner)
    {
        $userID = session()->get('user_id');
        if($userID != null){
            $data = Banner::where('id_banner', $id_banner)->get();

            return view('backend.dashboard.banner.edit', compact('data'));
        }
        else{
            return redirect('login');
        }
    }

    public function update(Request $req)
    {
        $userID = session()->get('user_id');
        if($userID != null){
            
            $banner = $req->file('banner_file');
            $upload_path = 'public/uploaded_files/banner';

            if($banner != null){
                $oldImg = DB::table('banner')->where('id_banner', $req->id_banner)->first()->gambar;
                File::delete('public/uploaded_files/banner/'.$oldImg);

                DB::table('banner')->where('id_banner', $req->id_banner)->update([
                    'gambar' => $banner->getClientOriginalName()
                ]);

                $banner->move($upload_path, $banner->getClientOriginalName());

                Session::flash('class', 'alert-success');
                Session::flash('message', 'Data berhasil diperbarui.'); 
                return redirect('setting-pages/banner');
            }

            return redirect('setting-pages/banner');
        }
        else{
            return redirect('login');
        }
    }

    public function delete($id_banner, $gambar)
    {
        $userID = session()->get('user_id');
        if($userID != null){
            DB::table('banner')->where('id_banner', $id_banner)->delete();
            $path = public_path().'\public\uploaded_files\banner\\'.$gambar;

            if($gambar != null){
                if(file_exists($path)){
                    File::delete('public/uploaded_files/banner/'.$gambar);
                }
            }

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Data berhasil dihapus.'); 
            return redirect('setting-pages/banner');
        }
        else{
            return redirect('login');
        }
    }
}
