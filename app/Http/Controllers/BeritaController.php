<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Berita;
use File;

class BeritaController extends Controller
{
    public function index()
    {
        $userID = session()->get('user_id');
        if($userID != null){
            $data = Berita::all()->toArray();
            
            return view('backend.dashboard.berita.index', compact('data'));
        }
        else{
            return redirect('login');
        }
    }

    public function add(){
        $userID = session()->get('user_id');
        if($userID != null){
            return view('backend.dashboard.berita.add');
        }
        else{
            return redirect('login');
        }
    }

    public function store(Request $req){
        $userID = session()->get('user_id');
        if($userID != null){
            $this->validate($req,[
                'judul' => 'required|min:4|max:50',
                'cover_file' => 'required',
                'konten' => 'required'
            ]);

            $cover = $req->file('cover_file');
            $upload_path = 'public/uploaded_files/berita';
            $slug = str_slug($req->judul);

            DB::table('berita')->insert([
                'judul' => $req->judul,
                'gambar' => $cover->getClientOriginalName(),
                'konten' => $req->konten,
                'slug' => $slug
            ]);

            $cover->move($upload_path, $cover->getClientOriginalName());

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Data berhasil diinputkan.'); 
            return redirect('setting-pages/berita');
        }
        else{
            return redirect('login');
        }
    }

    public function edit($id_berita)
    {
        $userID = session()->get('user_id');
        if($userID != null){
            $data = Berita::where('id_berita', $id_berita)->get();

            return view('backend.dashboard.berita.edit', compact('data'));
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
                'konten' => 'required'
            ]);

            $cover = $req->file('cover_file');
            $upload_path = 'public/uploaded_files/berita';
            $slug = str_slug($req->judul);

            DB::table('berita')->where('id_berita', $req->id_berita)->update([
                'judul' => $req->judul,
                'slug' => $slug,
                'diperbarui' => now()
            ]);

            if($cover != null){
                $oldImg = DB::table('berita')->where('id_berita', $req->id_berita)->first()->gambar;
                File::delete('public/uploaded_files/berita/'.$oldImg);

                DB::table('berita')->where('id_berita', $req->id_berita)->update([
                    'cover' => $cover->getClientOriginalName(),
                    'diperbarui' => now()
                ]);

                $cover->move($upload_path, $cover->getClientOriginalName());
            }

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Data berhasil diperbarui.'); 
            return redirect('setting-pages/berita');
        }
        else{
            return redirect('login');
        }
    }

    public function delete($id_berita, $gambar)
    {
        $userID = session()->get('user_id');
        if($userID != null){
            DB::table('berita')->where('id_berita', $id_berita)->delete();
            $path = public_path().'\public\uploaded_files\berita\\'.$gambar;

            if($gambar != null){
                if(file_exists($path)){
                    File::delete('public/uploaded_files/berita/'.$gambar);
                }
            }

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Data berhasil dihapus.'); 
            return redirect('setting-pages/berita');
        }
        else{
            return redirect('login');
        }
    }
}
