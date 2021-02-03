<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\WebProfile;
use App\SubJabatan;
use App\Jabatan;
use App\Anggota;
use App\Berita;
use App\Galeri;
use App\Akun;
use App\Banner;
use App\GambarGaleri;
//Edit by @bayuuv
use App\Pac;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
class OrganisasiController extends Controller
{
   
    public function index(){
        $active = "beranda";

        $data = WebProfile::select('judul', 'logo', 'subtitle', 'ket', 'isi')->get();
        $dataLogo =  WebProfile::select('logo')->first();
        $dataJudul =  WebProfile::select('judul')->first();
        $dataBanner = Banner::select('*')->orderBy('id_banner', 'ASC')->get();    
        
        $logoWeb = $dataLogo->logo;
        $judul = $dataJudul->judul;
        
        Session::put('logo',$logoWeb);
        Session::put('judul',$judul);

        return view('frontend.index', compact('data'), compact('dataBanner'))->with('active',$active)->with('judul',$judul);



    }


    public function struktur(){
        $active = "struktur";
  
        $dataLogo =  WebProfile::select('logo')->first();
        $dataJudul =  WebProfile::select('judul')->first();
                            
        $logoWeb = $dataLogo->logo;
        $judul = $dataJudul->judul;
        
        Session::put('logo',$logoWeb);
        Session::put('judul',$judul);


        return view('frontend.struktur')->with('active',$active)->with('id_level', '')->with('pilihan_kedua', 'Pengurus Pusat');
    }
    

    public function pilihKesatu($id_level){
        $active = "struktur";
  
        $dataLogo =  WebProfile::select('logo')->first();
        $dataJudul =  WebProfile::select('judul')->first();
        $data = Anggota::join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                            ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                            ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                            ->orderBy('sub_jabatan.prioritas', 'ASC')
                            ->where('akun.id_akun', $id_level)
                            ->get();
        
        $logoWeb = $dataLogo->logo;
        $judul = $dataJudul->judul;
        
        Session::put('logo',$logoWeb);
        Session::put('judul',$judul);
        
        $pilihanKedua = null;
        
        if($id_level == 3){
            $pilihanKedua = Akun::select('akun.id_akun', 'akun.nama_akun', 'akun.id_level')
                            ->where('akun.id_level', 3)
                            ->get();
                            
            return view('frontend.struktur', compact('data'), compact('pilihanKedua'))->with('active',$active)->with('id_level', $id_level)->with('pilihan_kedua', 'Wilayah')->with('id_akun', '');
        }
        // if($id_level == 4){
        //     $pilihanKedua = Akun::select('akun.id_akun', 'akun.nama_akun', 'akun.id_level')
        //                     ->where('akun.id_level', 4)
        //                     ->get();
                            
        //     return view('frontend.struktur', compact('data'), compact('pilihanKedua'))->with('active',$active)->with('id_level', $id_level)->with('pilihan_kedua', 'Unit')->with('id_akun', '');
        // }
        if($id_level == 4){
            $pilihanKedua = Akun::select('akun.id_akun', 'akun.id_dewan', 'akun.nama_akun', 'akun.id_level')
                            ->where('akun.id_level', 3)
                            ->get();
                            
            return view('frontend.struktur', compact('data'), compact('pilihanKedua'))->with('active',$active)->with('id_level', $id_level)->with('pilihan_kedua', 'Wilayah')->with('id_akun', '');
        }


        return view('frontend.struktur', compact('data'))->with('active',$active)->with('id_level', $id_level)->with('pilihan_kedua', 'Pengurus Pusat');
    }
    

    public function strukturDPC($id_dewan){
        $active = "struktur";
  
        $dataLogo =  WebProfile::select('logo')->first();
        $dataJudul =  WebProfile::select('judul')->first();
        if($id_dewan != 0){
            $data = Anggota::join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                                ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                                ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                                ->orderBy('sub_jabatan.prioritas', 'ASC')
                                ->where([['akun.id_level', 3], ['akun.id_akun', $id_dewan]])
                                ->get();
                                
            $pilihanKedua = Akun::select('akun.id_akun', 'akun.nama_akun', 'akun.id_level')
                                ->where('akun.id_level', 3)
                                ->get();
                                
            $dpc = Akun::select('nama_akun')->where('id_akun', $id_dewan)->first();
    
            $logoWeb = $dataLogo->logo;
            $judul = $dataJudul->judul;
            
            Session::put('logo',$logoWeb);
            Session::put('judul',$judul);
    

            return view('frontend.struktur', compact('data'), compact('pilihanKedua'))->with('active',$active)->with('id_level', 3)->with('pilihan_kedua', 'Wilayah ' . $dpc->nama_akun)->with('id_akun', $id_dewan);
        }
        else{
            return redirect(url()->previous());
        }
    }
    

    public function strukturPAC($id_level,$id_wil){
        $active = "struktur";
  
        $dataLogo =  WebProfile::select('logo')->first();
        $dataJudul =  WebProfile::select('judul')->first();
        if($id_wil != 0){
            $data = Anggota::join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                                ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                                ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                                ->orderBy('sub_jabatan.prioritas', 'ASC')
                                ->where([['akun.id_level', $id_level], ['akun.id_akun', $id_wil]])
                                ->get();
                                
            $pilihanKedua = Akun::select('akun.id_akun', 'akun.id_dewan', 'akun.nama_akun', 'akun.id_level')
                                ->where('akun.id_level', 3)
                                ->get();

            $pilihanKetiga = Pac::select('id_pac', 'nama_pac')
                                ->where('id_dewan', $id_wil)
                                ->get();
                                
            $pac = Akun::select('nama_akun')->where('id_dewan', $id_wil)->first();
    
            $logoWeb = $dataLogo->logo;
            $judul = $dataJudul->judul;
            
            Session::put('logo',$logoWeb);
            Session::put('judul',$judul);
           
            return view('frontend.struktur', compact('data'), compact('pilihanKedua'))->with('active',$active)->with('id_level', 4)->with('pilihan_kedua', 'Wilayah ' . $pac->nama_akun)->with('id_akun', $id_wil)
            ->with(['pilihanKetiga'=>$pilihanKetiga])->with('id_pac', '');
        }
        else{
            return redirect(url()->previous());
        }
    }


    public function galeri_foto(){
        $active = "galeri";

        $dataLogo =  WebProfile::select('logo')->first();
        $dataJudul =  WebProfile::select('judul')->first();

        
        $dataVideo = Galeri::select('id_galeri','judul','cover','video','slug','tipe','dibuat','diperbarui')
                            ->where('tipe',2)
                            ->orderBy('id_galeri',"DESC")
                            ->paginate(3);

        $dataGaleri = Galeri::select('id_galeri','judul','cover','video','slug','tipe','dibuat','diperbarui')
                            ->where('tipe',1)
                            ->orderBy('id_galeri',"DESC")
                            ->paginate(3);


        $logoWeb = $dataLogo->logo;
        $judul = $dataJudul->judul;

        Session::put('logo',$logoWeb);
        Session::put('judul',$judul);

        return view('frontend.galeri-foto')->with('active',$active)
                                                                ->with(['galeri' => Galeri::select('id_galeri','judul','cover','video','slug','tipe','dibuat','diperbarui')
                                                                    ->where('tipe',1)
                                                                    ->orderBy('id_galeri',"DESC")
                                                                    ->paginate(3)])
                                                                ->with(['video' => Galeri::select('id_galeri','judul','cover','video','slug','tipe','dibuat','diperbarui')
                                                                    ->where('tipe',2)
                                                                    ->orderBy('id_galeri',"DESC")
                                                                    ->paginate(3)]);
    }

    public function detail_foto($id_galeri, $slugFoto){

        $active = "galeri";

        $dataLogo =  WebProfile::select('logo')->first();
        $dataJudul =  WebProfile::select('judul')->first();
        $detailFoto  = Galeri::join('gambar_galeri', 'gambar_galeri.id_galeri', 'galeri.id_galeri')
                                ->where([['galeri.id_galeri', $id_galeri], ['galeri.slug',$slugFoto]])->get();
        
        $logoWeb = $dataLogo->logo;
        $judul = $dataJudul->judul;

        Session::put('logo',$logoWeb);
        Session::put('judul',$judul);

        return view('frontend.galeri.detail-foto', compact('detailFoto'))->with('active',$active)->with('judul', $detailFoto[0]->judul)->with('ket', $detailFoto[0]->ket);

    }
    
    public function detail_video($id_galeri, $slug){

        $active = "galeri";

        $dataLogo =  WebProfile::select('logo')->first();
        $dataJudul =  WebProfile::select('judul')->first();
        $video  = Galeri::where([['galeri.id_galeri', $id_galeri], ['galeri.slug',$slug]])->get();
        
        $logoWeb = $dataLogo->logo;
        $judul = $dataJudul->judul;

        Session::put('logo',$logoWeb);
        Session::put('judul',$judul);

        return view('frontend.galeri.detail-video', compact('video'))->with('active',$active)->with('judul', $video[0]->judul)->with('ket', $video[0]->ket);

    }

    public function kontak(){
        $active = "kontak";

        $dataLogo =  WebProfile::select('logo')->first();
        $dataJudul =  WebProfile::select('judul')->first();
        $dataKontak  = WebProfile::select('kontak')->get();

        $logoWeb = $dataLogo->logo;
        $judul = $dataJudul->judul;

        Session::put('logo',$logoWeb);
        Session::put('judul',$judul);

        return view('frontend.kontak',compact('dataKontak'))->with('active',$active);
    }


    public function berita(){
        $active = "berita";

        $dataBerita = Berita::orderBy('id_berita','DESC')->paginate(3);
        $dataLogo =  WebProfile::select('logo')->first();
        $dataJudul =  WebProfile::select('judul')->first();

        $logoWeb = $dataLogo->logo;
        $judul = $dataJudul->judul;

        Session::put('logo',$logoWeb);
        Session::put('judul',$judul);

        return view('frontend.berita', ['dataBerita' => $dataBerita])->with('active',$active);
    }

    public function detailBerita($id_berita, $slug){
        $active         = "berita";
        $dataLogo       =  WebProfile::select('logo')->first();
        $dataJudul      =  WebProfile::select('judul')->first();
   
        $detail_berita  = Berita::where([['id_berita', $id_berita], ['slug',$slug]])->get();
        
        
        $logoWeb = $dataLogo->logo;
        $judul = $dataJudul->judul;

        Session::put('logo',$logoWeb);
        Session::put('judul',$judul);

        return view('frontend.berita.detail-berita', compact('detail_berita'))->with('active',$active);
        
    }
        public function status(Request $req){
        $active = "status";

        $dataLogo =  WebProfile::select('logo')->first();
        $dataJudul =  WebProfile::select('judul')->first();
        // $dataAnggota  = Anggota::select('kontak')->get();

        $logoWeb = $dataLogo->logo;
        $judul = $dataJudul->judul;

        Session::put('logo',$logoWeb);
        Session::put('judul',$judul);
        
        $cari = $req->q;
                
    
              $anggotas =Anggota::join('akun', 'akun.id_akun', 'anggota.id_akun')
                            ->join('level', 'level.id_level','akun.id_level')
                            ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                            ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                    ->where('no_anggota',$cari)
                    ->orwhere('nik',$cari)
                    ->get();
                    
                     return view('frontend.cek-status',compact('anggotas'))->with('active',$active)->with('cari',$cari);  
          
          
            
                
        
        }

        public function strukturPacWil($id_level,$id_wil,$id_pac){
            $active = "struktur";
      
            $dataLogo =  WebProfile::select('logo')->first();
            $dataJudul =  WebProfile::select('judul')->first();
            if($id_wil != 0){
                $data = Anggota::join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                                    ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                                    ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                                    ->orderBy('sub_jabatan.prioritas', 'ASC')
                                    ->where([['akun.id_level', $id_level], ['akun.id_pac', $id_pac]])
                                    ->get();
                                    
                $pilihanKedua = Akun::select('akun.id_akun', 'akun.id_dewan', 'akun.nama_akun', 'akun.id_level')
                                    ->where('akun.id_level', 3)
                                    ->get();
    
                $pilihanKetiga = Pac::select('id_pac', 'nama_pac')
                                    ->where('id_dewan', $id_wil)
                                    ->get();
                                    
                $pac = Akun::select('nama_akun')->where('id_akun', $id_wil)->first();
        
                $logoWeb = $dataLogo->logo;
                $judul = $dataJudul->judul;
                
                Session::put('logo',$logoWeb);
                Session::put('judul',$judul);
               
                return view('frontend.struktur', compact('data'), compact('pilihanKedua'))->with('active',$active)->with('id_level', 4)->with('pilihan_kedua', 'Wilayah ' . $pac->nama_akun)->with('id_akun', $id_wil)
                ->with(['pilihanKetiga'=>$pilihanKetiga])->with('id_pac', $id_pac);
            }
            else{
                return redirect(url()->previous());
            }
        }
}
