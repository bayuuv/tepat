<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Galeri;
use File;

class GaleriController extends Controller
{
    public function index()
    {
        $userID = session()->get('user_id');
        if($userID != null){
            $data = Galeri::all()->toArray();
            
            return view('backend.dashboard.galeri.index', compact('data'));
        }
        else{
            return redirect('login');
        }
    }

    public function add(){
        $userID = session()->get('user_id');
        if($userID != null){
            return view('backend.dashboard.galeri.add');
        }
        else{
            return redirect('login');
        }
    }

    public function store(Request $req){
        $userID = session()->get('user_id');
        if($userID != null){
            if($req->tipe == 'gambar'){
                $this->validate($req,[
                    'judul' => 'required|min:4|max:50',
                    'cover_file' => 'required',
                    'ket' => 'required',
                    'gambar' => 'required',
                    'tipe' => 'required'
                ]);

                $cover = $req->file('cover_file');
                $gambar = $req->file('gambar');
                $upload_path = 'public/uploaded_files/galeri';
                $slug = str_slug($req->judul);

                DB::table('galeri')->insert([
                    'judul' => $req->judul,
                    'cover' => $cover->getClientOriginalName(),
                    'ket' => $req->ket,
                    'slug' => $slug,
                    'tipe' => $req->tipe
                ]);
                
                $cover->move($upload_path, $cover->getClientOriginalName());
                
                $lastId = Galeri::orderBy('id_galeri', 'desc')->first()->id_galeri;
                
                foreach($gambar as $item){
                    DB::table('gambar_galeri')->insert([
                            'id_galeri' => $lastId,
                            'gambar' => $lastId.$item->getClientOriginalName()
                        ]);
                        
                    $item->move($upload_path, $lastId.$item->getClientOriginalName());
                }

                Session::flash('class', 'alert-success');
                Session::flash('message', 'Data berhasil diinputkan.'); 
                return redirect('setting-pages/galeri');
            }
            if($req->tipe == 'video'){
                $this->validate($req,[
                    'judul' => 'required|min:4|max:50',
                    'video' => 'required',
                    'ket' => 'required',
                    'tipe' => 'required'
                ]);
                
                $slug = str_slug($req->judul);
                $url_video = str_replace("watch?v=", "embed/", $req->video);

                DB::table('galeri')->insert([
                    'judul' => $req->judul,
                    'video' => $url_video,
                    'ket' => $req->ket,
                    'slug' => $slug,
                    'tipe' => $req->tipe
                ]);

                Session::flash('class', 'alert-success');
                Session::flash('message', 'Data berhasil diinputkan.'); 
                return redirect('setting-pages/galeri');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function edit($id_galeri)
    {
        $userID = session()->get('user_id');
        if($userID != null){
            $data = Galeri::where('id_galeri', $id_galeri)->get();

            return view('backend.dashboard.galeri.edit', compact('data'));
        }
        else{
            return redirect('login');
        }
    }

    public function update(Request $req)
    {
        $userID = session()->get('user_id');
        if($userID != null){
            if($req->tipe == 'gambar'){
                $this->validate($req,[
                    'judul' => 'required|min:4|max:50',
                    'ket' => 'required',
                    'tipe' => 'required'
                ]);

                $cover = $req->file('cover_file');
                $gambar = $req->file('gambar');
                $upload_path = 'public/uploaded_files/galeri';
                $slug = str_slug($req->judul);

                DB::table('galeri')->where('id_galeri', $req->id_galeri)->update([
                    'judul' => $req->judul,
                    'slug' => $slug,
                    'ket' => $req->ket,
                    'tipe' => $req->tipe,
                    'diperbarui' => now()
                ]);

                if($cover != null){
                    $oldImg = DB::table('galeri')->where('id_galeri', $req->id_galeri)->first()->cover;
                    File::delete('uploaded_files/galeri/'.$oldImg);

                    DB::table('galeri')->where('id_galeri', $req->id_galeri)->update([
                        'cover' => $cover->getClientOriginalName(),
                        'diperbarui' => now()
                    ]);

                    $cover->move($upload_path, $cover->getClientOriginalName());
                }
                
                if($gambar != null){
                    $img = DB::table('gambar_galeri')->where('id_galeri', $req->id_galeri)->get();
                    
                    $oldPic = null;
                    $oldImg = null;
                    $countImg = $img->count();
                    
                    for($i = 0; $i < $countImg; $i++){
                        // $as = $i;
                        $oldImg = DB::table('gambar_galeri')->where('id_galeri', $req->id_galeri)->get();
                        $oldPic = $oldImg[$i]->gambar;
                        File::delete('public/uploaded_files/galeri/'.$oldPic);
                    }
                    
                    DB::table('gambar_galeri')->where('id_galeri', $req->id_galeri)->delete();
                    
                    foreach($gambar as $item){
                        DB::table('gambar_galeri')->insert([
                                'id_galeri' => $req->id_galeri,
                                'gambar' => $req->id_galeri.$item->getClientOriginalName()
                        ]);
                            
                        $item->move($upload_path, $req->id_galeri.$item->getClientOriginalName());
                    }
                }

                Session::flash('class', 'alert-success');
                Session::flash('message', 'Data berhasil diperbarui.'); 
                return redirect('setting-pages/galeri');
            }
            if($req->tipe == 'video'){
                $this->validate($req,[
                    'judul' => 'required|min:4|max:50',
                    'video' => 'required',
                    'ket' => 'required',
                    'tipe' => 'required'
                ]);
                
                $slug = str_slug($req->judul);
                $url_video = str_replace("watch?v=", "embed/", $req->video);

                DB::table('galeri')->where('id_galeri', $req->id_galeri)->update([
                    'judul' => $req->judul,
                    'video' => $url_video,
                    'ket' => $req->ket,
                    'slug' => $slug,
                    'tipe' => $req->tipe,
                    'diperbarui' => now()
                ]);

                Session::flash('class', 'alert-success');
                Session::flash('message', 'Data berhasil diperbarui.'); 
                return redirect('setting-pages/galeri');
            }
        }
        else{
            return redirect('login');
        }
    }

    public function delete($id_galeri, $cover)
    {
        $userID = session()->get('user_id');
        
        if($userID != null){
            $img = DB::table('gambar_galeri')->where('id_galeri', $id_galeri)->get();
                    
            $oldPic = null;
            $oldImg = null;
            $countImg = $img->count();
            
            for($i = 0; $i < $countImg; $i++){
                // $as = $i;
                $oldImg = DB::table('gambar_galeri')->where('id_galeri', $id_galeri)->get();
                $oldPic = $oldImg[$i]->gambar;
                File::delete('public/uploaded_files/galeri/'.$oldPic);
            }
            
            DB::table('galeri')->where('id_galeri', $id_galeri)->delete();
            $path = public_path().'/uploaded_files/galeri/'.$cover;

            if($cover != null){
                if(file_exists($path)){
                    File::delete('public/uploaded_files/galeri/'.$cover);
                }
            }

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Data berhasil dihapus.'); 
            return redirect('setting-pages/galeri');
        }
        else{
            return redirect('login');
        }
    }
}
