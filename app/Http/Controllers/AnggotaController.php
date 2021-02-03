<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Anggota;
use App\Akun;
use App\Pac;
use File;
use App\Exports\AnggotaExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use PDF;

class AnggotaController extends Controller
{
    public function index(Request $req){
        $userID = session()->get('user_id');
        $level = session()->get('level');
        if($userID != null){
            // if($level == 'Super Admin'){
            //     $data = Anggota::join('akun', 'akun.id_akun', 'anggota.id_akun')
            //             ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
            //             ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
            //             ->orderBy('no_anggota', 'DESC')
            //             ->get();
            // }
            // else if($level == 'Admin'){
            //     $data = Anggota::join('akun', 'akun.id_akun', 'anggota.id_akun')
            //         ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
            //         ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
            //         ->where('anggota.id_akun', $userID)
            //         ->orderBy('sub_jabatan.prioritas', 'ASC')
            //         ->get();
            // }
            // else{
            //     $data = Anggota::join('akun', 'akun.id_akun', 'anggota.id_akun')
            //         ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
            //         ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
            //         ->where('anggota.id_akun', $userID)
            //         ->orderBy('sub_jabatan.prioritas', 'ASC')
            //         ->get();
            // }
            $data = Anggota::join('akun', 'akun.id_akun', 'anggota.id_akun')
                        ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                        ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                        ->orderBy('sub_jabatan.prioritas', 'ASC')
                        ->orderBy('anggota.no_anggota', 'DESC')
                        ->get(); 

            //return view('backend.dashboard.anggota.index', compact('data'))->with('select', 'all')->with('id_level', '')->with('pilihan_kedua', 'Yayasan')->with('select', 'all')->with('count', null);
            return view('backend.dashboard.anggota.index')->with('select', 'all')->with('id_level', '')->with('pilihan_kedua', 'Yayasan')->with('select', 'all')->with('count', $data->count());
        }
        else{
            return redirect('login');
        }
    }

    public function getList(Request $req){
        
        $getWilayah = $req->wilayah ?? '';
        $getUnit    = $req->unit ?? '';

        $columns = [
            'akun.id_akun',
            'no_anggota',
            'nama_anggota',
            'nik',
            'alamat',
            'jenis_kelamin',
            'nama_akun',
            'anggota.id_sub_jabatan',
            'is_active'
        ];

        $totalData = Anggota::join('akun', 'akun.id_akun', 'anggota.id_akun')
        ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
        ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan');

        if($getWilayah){
            if($getWilayah == 3){
                $totalData = $totalData->where('akun.id_level', $getWilayah);
            }elseif($getWilayah == 2){
                $totalData = $totalData->where('akun.id_level', $getWilayah);
            }elseif($getWilayah == 'unit'){
                $totalData = $totalData->where('akun.id_level', 4);
            }elseif($getWilayah == 'wilayah'){
                $totalData = $totalData->where('akun.id_level', 3);
            }else{
                if($getUnit){
                    $totalData = $totalData->where('akun.id_level', 4)->where('akun.id_pac', $getUnit);
                }else{
                    $totalData = $totalData->where('akun.id_level', 3)->where('akun.id_akun', $getWilayah);
                }
            }
        }else{
            if($getUnit){
                $totalData = $totalData->where('akun.id_level', 4)->where('akun.id_akun', $getUnit);
            }
        }

        $totalData = $totalData->count();

        $totalFiltered = $totalData; 

        $limit = $req->get('length');
        $start = $req->get('start');
        $order = $columns[$req->get('order')[0]['column']] ?? "id";
        $dir = $req->get('order')[0]['dir'];
        
        $search = (array)$req->get('search'); 
        $search = $search['value'] ?? "";
        
        $userselect = Anggota::join('akun', 'akun.id_akun', 'anggota.id_akun')
        ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
        ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan');

        if($getWilayah){
            if($getWilayah == 3){
                $userselect = $userselect->where('akun.id_level', $getWilayah);
            }elseif($getWilayah == 2){
                $userselect = $userselect->where('akun.id_level', $getWilayah);
            }elseif($getWilayah == 'unit'){
                $userselect = $userselect->where('akun.id_level', 4);
            }elseif($getWilayah == 'wilayah'){
                $userselect = $userselect->where('akun.id_level', 3);
            }else{
                if($getUnit){
                    $userselect = $userselect->where('akun.id_level', 4)->where('akun.id_pac', $getUnit);
                }else{
                    $userselect = $userselect->where('akun.id_level', 3)->where('akun.id_akun', $getWilayah);
                }
            }
        }else{
            if($getUnit){
                $userselect = $userselect->where('akun.id_level', 4)->where('akun.id_akun', $getUnit);
            }
        }
        
        if($search)
        {
            $userselect= $userselect->where(function($where)use($search){
                            $where->where('anggota.no_anggota', 'like', "%{$search}%")
                            ->orWhere('anggota.nama_anggota', 'like', "%{$search}%")
                            ->orWhere('anggota.nik', 'like', "%{$search}%")
                            ->orWhere('anggota.alamat', 'like', "%{$search}%")
                            //->orWhere('akun.nama_akun', 'like', "%{$search}%")
                            ;
                        });
            
            $totalFiltered = Anggota::select(
                'id_akun',
                'no_anggota',
                'nama_anggota',
                'nik',
                'alamat',
                'jenis_kelamin',
                'nama_akun',
                'id_sub_jabatan',
                'is_active'
            );

                $totalFiltered = $totalFiltered->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan');

                if($getWilayah){
                    if($getWilayah == 3){
                        $totalFiltered = $totalFiltered->where('akun.id_level', $getWilayah);
                    }elseif($getWilayah == 2){
                        $totalFiltered = $totalFiltered->where('akun.id_level', $getWilayah);
                    }elseif($getWilayah == 'unit'){
                        $totalFiltered = $totalFiltered->where('akun.id_level', 4);
                    }elseif($getWilayah == 'wilayah'){
                        $totalFiltered = $totalFiltered->where('akun.id_level', 3);
                    }else{
                        if($getUnit){
                            $totalFiltered = $totalFiltered->where('akun.id_level', 4)->where('akun.id_pac', $getUnit);
                        }else{
                            $totalFiltered = $totalFiltered->where('akun.id_level', 3)->where('akun.id_akun', $getWilayah);
                        }
                    }
                }else{
                    if($getUnit){
                        $totalFiltered = $totalFiltered->where('akun.id_level', 4)->where('akun.id_akun', $getUnit);
                    }
                }

            $totalFiltered = $totalFiltered->where(function($where)use($search){
                $where->where('anggota.no_anggota', 'like', "%{$search}%")
                ->orWhere('anggota.nama_anggota', 'like', "%{$search}%")
                ->orWhere('anggota.nik', 'like', "%{$search}%")
                ->orWhere('anggota.alamat', 'like', "%{$search}%")
                //->orWhere('akun.nama_akun', 'like', "%{$search}%")
                ;
            });

            $totalFiltered = $totalFiltered->count();
        }
        
        if($limit <> '-1'){
            $userselect = $userselect->offset($start)
            ->limit($limit)
            ->orderBy($order,$dir);
        }else{
            $userselect = $userselect->orderBy($order,$dir);
        }
        $userselect = $userselect->get();

        $data = [];
        if(!empty($userselect))
        {
            $i = 0;
            foreach ($userselect as $r)
            {
                $i++;

                if($r->jenis_kelamin == 'L'){
                    $jenis_kelamin = 'Laki-laki';
                }else{
                    $jenis_kelamin = 'Perempuan';
                }

                if($r->id_jabatan == 1 && $r->id_sub_jabatan != 1){
                    $jabatan = $r->nama_sub_jabatan;
                }elseif($r->id_jabatan != 1 && $r->id_sub_jabatan == 1){
                    $jabatan = $r->jabatan;
                }elseif($r->id_jabatan == 1 && $r->id_sub_jabatan == 1){
                    $jabatan = 'Anggota';
                }else{
                    if($r->jabatan == 'Tidak Ada'){
                        $jabatan = $r->nama_sub_jabatan;
                    }else{
                        $jabatan = ''.$r->jabatan.' '.$r->nama_sub_jabatan.'';
                    }
                }

                $no_anggota = "<img src='public/uploaded_files/anggota/foto/$r->foto' class='mr-2' alt='image'> $r->no_anggota";

                    $nestedData = [
                        'no'                => $i,
                        'no_anggota'        => $no_anggota,
                        'nama_anggota'      => $r->nama_anggota,
                        'nik'               => $r->nik,
                        'alamat'            => $r->alamat,
                        'jenis_kelamin'     => $jenis_kelamin,
                        'nama_akun'         => $r->nama_akun,
                        'jabatan'           => $jabatan,
                        'opsi'              => "<center>",
                        'status'            => "<center>"
                    ];

                    if(Session::get('level') == 'Super Admin' || Session::get('level') == 'Admin'){
                        $nestedData['opsi'] .= "
                        <a href='anggota/view_pdf/$r->no_anggota'> <span class='mdi mdi-eye' style='color:#32bf90;'></span></a>
                        <a href='anggota/edit/$r->no_anggota'> <span class='mdi mdi-lead-pencil' style='color:#32bf90;'></span></a>
                        <a href='url('anggota/delete/$r->no_anggota/$r->foto/$r->ktp)' onClick='return confirm(\"Yakin Menghapus ".$r->nama_anggota." ?\")'> <span class='mdi mdi-delete' style='color:#32bf90;'></i></button>
                        ";
                        
                        $nestedData['opsi'] .= "</center>";

                        if($r->is_active == 0){
                            $nestedData['status'] .= "
                            <a href='anggota/update-active/$r->no_anggota' onClick='return confirm(\"Yakin Untuk Aktifkan ".$r->nama_anggota." ?\")'> <button class='btn btn-gradient-primary'>Aktifkan</button> </a>";
                        }
                            
                        if($r->is_active == 1){
                            $nestedData['status'] .= "
                            <a href='anggota/update-non-active/'.$r->no_anggota' onClick='return confirm(\"Yakin Non Aktikan ".$r->nama_anggota." ?\")'> <button class='btn btn-danger'>Non-Aktifkan</button> </a>";
                        }
        
                            $nestedData['status'] .= "</center>";
        
                    }else{
                        if($r->id_akun == Session::get('user_id')){
                            $nestedData['opsi'] .= "
                            <a href='anggota/view_pdf/$r->no_anggota'> <span class='mdi mdi-eye' style='color:#32bf90;'></span></a>
                            <a href='anggota/edit/$r->no_anggota'> <span class='mdi mdi-lead-pencil' style='color:#32bf90;'></span></a>
                            ";
                            
                            $nestedData['opsi'] .= "</center>";
                        }    
                    }

                $data[] = $nestedData;

            }
        }

        $json_data = [
            "draw"            => intval($req->get('draw')),  
            "recordsTotal"    => intval($totalData),  
            "recordsFiltered" => intval($totalFiltered), 
            "data"            => $data   
        ];
    
        return response()->json($json_data);
    }

    public function add(){
        $dewan = Akun::where('akun.id_level', '2')->get();
        $pilihDPC = Akun::where('akun.id_level', 3)->get();
        $pilihPAC = Akun::where('akun.id_level', 4)->get();
        $noAnggota = null;
        $data = DB::table('anggota')->get();
    
        if($data->count() > 0){
            $lastnoAnggota = Anggota::orderBy('no_anggota', 'desc')->first()->no_anggota;

            $lastIncreament = substr($lastnoAnggota, 1);

            $noAnggota = str_pad($lastIncreament + 1, 5, 0, STR_PAD_LEFT);

        }
        else{
            $noAnggota = "00001";
        }
        return view('backend.dashboard.anggota.add')->with('no_anggota', $noAnggota)->with(['dewan' => $dewan])
                                                                                    ->with(['dpc' => $pilihDPC])
                                                                                    ->with(['pac' => $pilihPAC]);
    }
    
    public function store(Request $req){
        $userID = session()->get('user_id');
        $level = session()->get('level');
        $id_akun = null;

        if($userID != null){
            if($req->id_akun == 2){
                $id_akun = 2;
            }
            else if($req->id_akun == 3){
                // $this->validate($req, [
                //         'id_akun_dpc' => 'required'
                // ]);
                
                if($req->id_akun_dpc != ''){
                    $id_akun = $req->id_akun_dpc;    
                }
                else{
                    $noAnggota = null;
                    $data = DB::table('anggota')->get();
                
                    if($data->count() > 0){
                        $lastnoAnggota = Anggota::orderBy('no_anggota', 'desc')->first()->no_anggota;
            
                        $lastIncreament = substr($lastnoAnggota, 1);
            
                        $noAnggota = str_pad($lastIncreament + 1, 5, 0, STR_PAD_LEFT);
            
                    }
                    else{
                        $noAnggota = "00001";
                    }
                    
                    Session::flash('class', 'alert-danger');
                    Session::flash('message', 'Harap pilih cabang terlebih dahulu'); 
                    // return view('backend.dashboard.anggota.add')->with('no_anggota', $noAnggota);
                    return redirect('anggota/add');
                }
            }
            else if($req->id_akun == 4){
                // $this->validate($req, [
                //         'id_akun_pac' => 'required'
                // ]);
                
                if($req->id_akun_pac != ''){
                    $id_akun = $req->id_akun_pac;    
                }
                else{
                    $noAnggota = null;
                    $data = DB::table('anggota')->get();
                
                    if($data->count() > 0){
                        $lastnoAnggota = Anggota::orderBy('no_anggota', 'desc')->first()->no_anggota;
            
                        $lastIncreament = substr($lastnoAnggota, 1);
            
                        $noAnggota = str_pad($lastIncreament + 1, 5, 0, STR_PAD_LEFT);
            
                    }
                    else{
                        $noAnggota = "00001";
                    }
                    
                    Session::flash('class', 'alert-danger');
                    Session::flash('message', 'Harap pilih cabang terlebih dahulu'); 
                    // return view('backend.dashboard.anggota.add')->with('no_anggota', $noAnggota);
                    return redirect('anggota/add');
                }
                
            }
            else{
                
            }
            $data = DB::table('anggota')->get();
            
            $foto = $req->file('foto');
            $upload_path = 'public/uploaded_files/anggota/foto';
            $ktp = $req->file('ktp');
            $upload_path_ktp = 'public/uploaded_files/anggota/ktp';

            $noAnggota = null;
            $data = DB::table('anggota')->get();
        
            if($data->count() > 0){
                $lastnoAnggota = Anggota::orderBy('no_anggota', 'desc')->first()->no_anggota;

                $lastIncreament = substr($lastnoAnggota, 1);

                $noAnggota = str_pad($lastIncreament + 1, 5, 0, STR_PAD_LEFT);

            }
            else{
                $noAnggota = "00001";
            }

            if($level == 'Super Admin' || $level == 'Admin'){
                    $this->validate($req,[  
                        'id_akun' => 'required',
                        'nik' => 'required|min:16|max:16|unique:anggota',
                        'nama' => 'required|min:5|max:100',
                        'jenis_kelamin' => 'required',
                        'alamat' => 'required',
                        'tempat_lahir' => 'required',
                        'tgl_lahir' => 'required',
                        'no_telp' => 'required|min:6|max:12',
                        'foto' => 'required',
                        'ktp' => 'required'
                    ]);
                    
                    $nikAnggota = DB::table('anggota')->where('nik', $req->nik)->get();
                    // return $nikAnggota;
                
                    DB::table('anggota')->insert([
                            'no_anggota' => $noAnggota,
                            'id_akun' => $id_akun,
                            'nik' => $req->nik,
                            'nama_anggota' => $req->nama,
                            'alamat' => $req->alamat,
                            'tempat_lahir' => $req->tempat_lahir,
                            'tgl_lahir' => $req->tgl_lahir,
                            'jenis_kelamin' => $req->jenis_kelamin,
                            'no_telp' => $req->no_telp,
                            'foto' => $noAnggota.$foto->getClientOriginalName(),
                            'ktp' => $noAnggota.$ktp->getClientOriginalName()
                    ]);
        
                    $foto->move($upload_path, $noAnggota.$foto->getClientOriginalName());
                    $ktp->move($upload_path_ktp, $noAnggota.$ktp->getClientOriginalName());
        
                    Session::flash('class', 'alert-success');
                    //edit by bayuuv
                    Session::flash('message', 'Selamat No Anggota '.$noAnggota.' berhasil didaftarkan.'); 
                    return redirect('anggota');
                }
            else{
                    $this->validate($req, [
                        'nik' => 'required|min:16|max:16|unique:anggota',
                        'nama' => 'required|min:5|max:100',
                        'jenis_kelamin' => 'required',
                        'alamat' => 'required',
                        'tempat_lahir' => 'required',
                        'tgl_lahir' => 'required',
                        'no_telp' => 'required|min:6|max:12',
                        'foto' => 'required',
                        'ktp' => 'required'
                    ]);
                    
                    $nikAnggota = DB::table('anggota')->where('nik', $req->nik)->get();
                
                    DB::table('anggota')->insert([
                            'no_anggota' => $noAnggota,
                            'id_akun' => $userID,
                            'nik' => $req->nik,
                            'nama_anggota' => $req->nama,
                            'alamat' => $req->alamat,
                            'tempat_lahir' => $req->tempat_lahir,
                            'tgl_lahir' => $req->tgl_lahir,
                            'jenis_kelamin' => $req->jenis_kelamin,
                            'no_telp' => $req->no_telp,
                            'foto' => $noAnggota.$foto->getClientOriginalName(),
                            'ktp' => $noAnggota.$ktp->getClientOriginalName()
                    ]);
        
                    $foto->move($upload_path, $noAnggota.$foto->getClientOriginalName());
                    $ktp->move($upload_path_ktp, $noAnggota.$ktp->getClientOriginalName());
        
                    Session::flash('class', 'alert-success');
                    //edit by bayuuv
                    Session::flash('message', 'Selamat No Anggota '.$noAnggota.' berhasil didaftarkan.');
                    return redirect('anggota');
                }
        }
        else{
            return redirect('login');
        }
    }

    public function edit($no_anggota){
        $userID = session()->get('user_id');
        if($userID != null){
            
            $data = Anggota::join('akun', 'akun.id_akun', 'anggota.id_akun')
                            ->where('no_anggota', $no_anggota)->get();
                            
            $dewan = Akun::where('akun.id_level', '2')->get();
            $pilihDPC = Akun::where('akun.id_level', 3)->get();
            $pilihPAC = Akun::where('akun.id_level', 4)->get();

            return view('backend.dashboard.anggota.edit', compact('data'), compact('dewan'))->with('level', $data[0]->id_level)
                                                                                            ->with(['dewan' => $dewan])
                                                                                            ->with(['dpc' => $pilihDPC])
                                                                                            ->with(['pac' => $pilihPAC]);
        }
        else{
            return redirect('login');
        }
    }
    


    public function update(Request $req){
        $userID = session()->get('user_id');
        $level = session()->get('level');
        $id_akun = null;

        if($userID != null){            
            if($req->id_akun == 2){
                $id_akun = 2;
            }
            else if($req->id_akun == 3){
                $this->validate($req, [
                        'id_akun_dpc' => 'required'
                ]);
                
                $id_akun = $req->id_akun_dpc;
            }
            else if($req->id_akun == 4){
                $this->validate($req, [
                        'id_akun_pac' => 'required'
                ]);
                
                $id_akun = $req->id_akun_pac;
            }
            else{
                
                
            }
            $foto = $req->file('foto');
            $upload_path = 'public/uploaded_files/anggota/foto';
            $ktp = $req->file('ktp');
            $upload_path_ktp = 'public/uploaded_files/anggota/ktp';

            if($level == 'Super Admin' || $level == 'Admin'){
                $this->validate($req,[
                    'id_akun' => 'required',
                    'nik' => 'required|min:16|max:16',
                    'nama' => 'required|min:5|max:100',
                    'jenis_kelamin' => 'required',
                    'alamat' => 'required',
                    'tempat_lahir' => 'required',
                    'tgl_lahir' => 'required',
                    'no_telp' => 'required|min:6|max:12'
                ]);
                
                $nikAnggota = DB::table('anggota')->where('nik', $req->nik)->get();
                
                DB::table('anggota')->where('no_anggota', $req->no_anggota)->update([
                        'no_anggota' => $req->no_anggota,
                        'id_akun' => $id_akun,
                        'nik' => $req->nik,
                        'nama_anggota' => $req->nama,
                        'alamat' => $req->alamat,
                        'tempat_lahir' => $req->tempat_lahir,
                        'tgl_lahir' => $req->tgl_lahir,
                        'jenis_kelamin' => $req->jenis_kelamin,
                        'no_telp' => $req->no_telp,
                        'diperbarui' => now()
                ]);
            }
            else{
                $this->validate($req, [
                    'nik' => 'required|min:16|max:16',
                    'nama' => 'required|min:5|max:100',
                    'jenis_kelamin' => 'required',
                    'alamat' => 'required',
                    'tempat_lahir' => 'required',
                    'tgl_lahir' => 'required',
                    'no_telp' => 'required|min:6|max:12'
                ]);

                $nikAnggota = DB::table('anggota')->where('nik', $req->nik)->get();
                
                DB::table('anggota')->where('no_anggota', $req->no_anggota)->update([
                        'no_anggota' => $req->no_anggota,
                        'id_akun' => $userID,
                        'nik' => $req->nik,
                        'nama_anggota' => $req->nama,
                        'alamat' => $req->alamat,
                        'tempat_lahir' => $req->tempat_lahir,
                        'tgl_lahir' => $req->tgl_lahir,
                        'jenis_kelamin' => $req->jenis_kelamin,
                        'no_telp' => $req->no_telp,
                        'diperbarui' => now()
                ]);
            }

            if($foto != null){
                $oldImg = DB::table('anggota')->where('no_anggota', $req->no_anggota)->first()->foto;
                File::delete('public/uploaded_files/anggota/foto/'.$oldImg);

                DB::table('anggota')->where('no_anggota', $req->no_anggota)->update([
                    'foto' => $req->no_anggota.$foto->getClientOriginalName(),
                    'diperbarui' => now()
                ]);

                $foto->move($upload_path, $req->no_anggota.$foto->getClientOriginalName());
            }

            if($ktp != null){
                $oldImg = DB::table('anggota')->where('no_anggota', $req->no_anggota)->first()->ktp;
                File::delete('public/uploaded_files/anggota/ktp/'.$oldImg);

                DB::table('anggota')->where('no_anggota', $req->no_anggota)->update([
                    'ktp' => $req->no_anggota.$ktp->getClientOriginalName(),
                    'diperbarui' => now()
                ]);

                $ktp->move($upload_path_ktp, $req->no_anggota.$ktp->getClientOriginalName());
            }

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Data berhasil diinputkan.'); 
            return redirect('anggota');
        }
        else{
            return redirect('login');
        }
    }

    public function updateActive($no_anggota)
    {
        $userID = session()->get('user_id');
        if($userID != null){
            DB::table('anggota')->where('no_anggota', $no_anggota)->update(['is_active' => 1]);

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Anggota di Aktifkan.'); 
            return redirect('anggota');
        }
        else{
            return redirect('login');
        }
    }

    public function updateDeadActive($no_anggota)
    {
        $userID = session()->get('user_id');
        if($userID != null){
            DB::table('anggota')->where('no_anggota', $no_anggota)->update(['is_active' => 0]);

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Anggota di Non-Aktifkan.'); 
            return redirect('anggota');
        }
        else{
            return redirect('login');
        }
    }

    public function delete($no_anggota, $foto, $ktp){
        $userID = session()->get('user_id');
        if($userID != null){
            DB::table('anggota')->where('no_anggota', $no_anggota)->delete();
    
            $path = public_path().'\public\uploaded_files\anggota\foto\\'.$foto;
            $path_ktp = public_path().'\public\uploaded_files\anggota\ktp\\'.$ktp;
    
            if($foto != null){
                if(file_exists($path)){
                    File::delete('public/uploaded_files/anggota/foto/'.$foto);
                }
            }

            if($ktp != null){
                if(file_exists($path_ktp)){
                    File::delete('public/uploaded_files/anggota/ktp/'.$ktp);
                }
            }

            Session::flash('class', 'alert-success');
            Session::flash('message', 'Data berhasil dihapus.'); 
            return redirect('anggota');
        }
        else{
            return redirect('login');
        }
    }
    
      // Struktur
    public function pilihKesatu($id_level){
        $active = "struktur";
  
        $data = Anggota::join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                            ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                            ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                            ->orderBy('sub_jabatan.prioritas', 'ASC')
                            ->where('akun.id_akun', $id_level)
                            ->get();
        
        $pilihanKedua = null;
        
        if($id_level == 1){
            return redirect('anggota');
        }
        
        if($id_level == 2){
            $pilihanKedua = Akun::select('akun.id_akun', 'akun.nama_akun', 'akun.id_level')
                            ->where('akun.id_level', 2)
                            ->get();
                            
            Session::put('level_report', $id_level);
            Session::put('id_akun_report', null);
            return view('backend.dashboard.anggota.index', compact('data'), compact('pilihanKedua'))->with('active',$active)->with('id_level', $id_level)->with('pilihan_kedua', 'Yayasan')->with('id_akun', '')->with('count', $data->count());
        }
        
        if($id_level == 3){
             $data = Anggota::join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                            ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                            ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                            ->orderBy('sub_jabatan.prioritas', 'ASC')
                            ->where('akun.id_level', 3)
                            ->get();
                            
            $pilihanKedua = Akun::select('akun.id_akun', 'akun.nama_akun', 'akun.id_level')
                            ->where('akun.id_level', 3)
                            ->get();
                            
            Session::put('level_report', $id_level);
            Session::put('id_akun_report', null);
            return view('backend.dashboard.anggota.index', compact('data'), compact('pilihanKedua'))->with('active',$active)->with('id_level', $id_level)->with('pilihan_kedua', 'Wilayah')->with('id_akun', '')->with('count', null);
        }
        if($id_level == 4){
             $data = Anggota::join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                            ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                            ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                            ->orderBy('sub_jabatan.prioritas', 'ASC')
                            ->where('akun.id_level', 4)
                            ->get();
                            
            $pilihanKedua = Akun::select('akun.id_akun', 'akun.nama_akun', 'akun.id_level')
                            ->where('akun.id_level', 4)
                            ->get();
         
            Session::put('level_report', $id_level);                   
            Session::put('id_akun_report', null);
            return view('backend.dashboard.anggota.index', compact('data'), compact('pilihanKedua'))->with('active',$active)->with('id_level', $id_level)->with('pilihan_kedua', 'Unit')->with('id_akun', '')->with('count', null);
        }
    }
    
     // Struktur
    public function anggotaDPC($id_dewan){
        $active = "struktur";
        
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
    
            Session::put('level_report', 3);
            Session::put('id_akun_report', $id_dewan);
            return view('backend.dashboard.anggota.index', compact('data'), compact('pilihanKedua'))->with('id_level', 3)->with('pilihan_kedua', 'Wilayah ' . $dpc->nama_akun)->with('id_akun', $id_dewan)->with('count', $data->count());
        }
        else{
            return redirect(url()->previous());
        }
    }
    
     // Struktur
    public function anggotaPAC($id_pac){
        if($id_pac != 0){
            $data = Anggota::join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                                ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                                ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                                ->orderBy('sub_jabatan.prioritas', 'ASC')
                                ->where([['akun.id_level', 4], ['akun.id_akun', $id_pac]])
                                ->get();
                                
            $pilihanKedua = Akun::select('akun.id_akun', 'akun.nama_akun', 'akun.id_level')
                                ->where('akun.id_level', 4)
                                ->get();
                                
            $pac = Akun::select('nama_akun')->where('id_akun', $id_pac)->first();
    
            Session::put('level_report', 4);
            Session::put('id_akun_report', $pilihanKedua[0]->id_akun);
            return view('backend.dashboard.anggota.index', compact('data'), compact('pilihanKedua'))->with('id_level', 4)->with('pilihan_kedua', 'Unit ' . $pac->nama_akun)->with('id_akun', $id_pac)->with('count', $data->count());
        }
        else{
            return redirect(url()->previous());
        }
    }

    public function exportExcel()
    {
        $level = request()->pilih_kesatu;
        $akun = request()->pilih_kedua;
        
        $data = null;
        
        if($level == 1){
             $data = Anggota::select('anggota.no_anggota', 'anggota.nama_anggota', 'anggota.nik',  'anggota.alamat', 'anggota.jenis_kelamin', 'akun.nama_akun', 'jabatan.jabatan', 'sub_jabatan.nama_sub_jabatan')
                                ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                                ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                                ->join('jabatan', 'sub_jabatan.id_jabatan', 'jabatan.id_jabatan')
                                ->get(); 
            
            return Excel::download(new AnggotaExport($data), 'anggota.xlsx');
        }
        else if($level != null && $akun == null){
            $data = Anggota::select('anggota.no_anggota', 'anggota.nama_anggota', 'anggota.nik',  'anggota.alamat', 'anggota.jenis_kelamin', 'akun.nama_akun', 'jabatan.jabatan', 'sub_jabatan.nama_sub_jabatan')
                                ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                                ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                                ->join('jabatan', 'sub_jabatan.id_jabatan', 'jabatan.id_jabatan')
                                ->where('akun.id_level', $level)
                                ->get();
            
            return Excel::download(new AnggotaExport($data), 'anggota.xlsx');
        }
        else if($level != null && $akun == 'all'){
            $data = Anggota::select('anggota.no_anggota', 'anggota.nama_anggota', 'anggota.nik',  'anggota.alamat', 'anggota.jenis_kelamin', 'akun.nama_akun', 'jabatan.jabatan', 'sub_jabatan.nama_sub_jabatan')
                            ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                            ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                            ->join('jabatan', 'sub_jabatan.id_jabatan', 'jabatan.id_jabatan')
                            ->where('akun.id_level', $level)
                            ->get(); 
            
            return Excel::download(new AnggotaExport($data), 'anggota.xlsx');
        }
        else if($level != null && $akun != null && $akun != 'all'){
            $data = Anggota::select('anggota.no_anggota', 'anggota.nama_anggota', 'anggota.nik',  'anggota.alamat', 'anggota.jenis_kelamin', 'akun.nama_akun', 'jabatan.jabatan', 'sub_jabatan.nama_sub_jabatan')
                            ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                            ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                            ->join('jabatan', 'sub_jabatan.id_jabatan', 'jabatan.id_jabatan')
                            ->where('anggota.id_akun', $akun)
                            ->get(); 
            
            return Excel::download(new AnggotaExport($data), 'anggota.xlsx');
        }
        else{
            $data = Anggota::select('anggota.no_anggota', 'anggota.nama_anggota', 'anggota.nik',  'anggota.alamat', 'anggota.jenis_kelamin', 'akun.nama_akun', 'jabatan.jabatan', 'sub_jabatan.nama_sub_jabatan')
                            ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                            ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                            ->join('jabatan', 'sub_jabatan.id_jabatan', 'jabatan.id_jabatan')
                            ->get(); 
            
            return Excel::download(new AnggotaExport($data), 'anggota.xlsx');
        }
    }

    public function sortirAnggota($sortir_anggota){
        if($sortir_anggota == 'all' || $sortir_anggota == 1){
            $data = Anggota::join('akun', 'akun.id_akun', 'anggota.id_akun')
                            ->orderBy('no_anggota', 'DESC')
                            ->get();
        }
        else{
            $data = Anggota::join('akun', 'akun.id_akun', 'anggota.id_akun')
                            ->orderBy('no_anggota', 'DESC')
                            ->where('akun.id_level', $sortir_anggota)
                            ->get();
        }

        return view('backend.dashboard.anggota.index', compact('data'))->with('select', $sortir_anggota);
    }
    
    public function viewPdf($no_anggota){
        $userID = session()->get('user_id');
        if($userID != null){
           $data = Anggota::join('akun', 'akun.id_akun', 'anggota.id_akun')
                            ->join('level', 'level.id_level','akun.id_level')
                            ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                            ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                            ->where('no_anggota', $no_anggota)
                            ->get();
                            
        return view ('backend.dashboard.anggota.tampil_pdf',compact('data'));
        }
        else{
            return redirect('login');
        }
    }
    
    public function downloadOnePdf($no_anggota){
        $data = Anggota::join('akun', 'akun.id_akun', 'anggota.id_akun')
                            ->join('level', 'level.id_level','akun.id_level')
                            ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                            ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
                            ->where('no_anggota', $no_anggota)
                            ->get();
 
        // return view('backend.dashboard.anggota.anggota_pdf')->with(['data' => $data]);
    	$pdf = PDF::loadview('backend.dashboard.anggota.anggota_pdf',['data'=>$data]);
    	return $pdf->download('laporan-anggota.pdf');
    }
    
    public function downloadPDF(){
        $level = request()->pilih_kesatu;
        $akun = request()->pilih_kedua;
        
        $data = null;
        // return ['level' => $level, 'akun' => $akun];
        
        if($level == 1){
             $data = Anggota::select('akun.nama_akun', 'akun.id_level', 'anggota.no_anggota', 'anggota.nama_anggota', 'anggota.nik',  'anggota.alamat', 'anggota.jenis_kelamin', 'jabatan.jabatan', 'sub_jabatan.id_jabatan', 'sub_jabatan.nama_sub_jabatan', 'anggota.foto', 'anggota.ktp')
                                ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                                ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                                ->join('jabatan', 'sub_jabatan.id_jabatan', 'jabatan.id_jabatan')
                                ->get(); 
        }
        else if($level != null && $akun == null){
            $data = Anggota::select('akun.nama_akun', 'akun.id_level', 'anggota.no_anggota', 'anggota.nama_anggota', 'anggota.nik',  'anggota.alamat', 'anggota.jenis_kelamin', 'jabatan.jabatan', 'sub_jabatan.id_jabatan', 'sub_jabatan.nama_sub_jabatan', 'anggota.foto', 'anggota.ktp')
                                ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                                ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                                ->join('jabatan', 'sub_jabatan.id_jabatan', 'jabatan.id_jabatan')
                                ->where('akun.id_level', $level)
                                ->get();
        }
        else if($level != null && $akun == 'all'){
            $data = Anggota::select('akun.nama_akun', 'akun.id_level', 'anggota.no_anggota', 'anggota.nama_anggota', 'anggota.nik',  'anggota.alamat', 'anggota.jenis_kelamin', 'jabatan.jabatan', 'sub_jabatan.id_jabatan', 'sub_jabatan.nama_sub_jabatan', 'anggota.foto', 'anggota.ktp')
                            ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                            ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                            ->join('jabatan', 'sub_jabatan.id_jabatan', 'jabatan.id_jabatan')
                            ->where('akun.id_level', $level)
                            ->get(); 
        }
        else if($level != null && $akun != null && $akun != 'all'){
            $data = Anggota::select('akun.nama_akun', 'akun.id_level', 'anggota.no_anggota', 'anggota.nama_anggota', 'anggota.nik',  'anggota.alamat', 'anggota.jenis_kelamin', 'jabatan.jabatan', 'sub_jabatan.id_jabatan', 'sub_jabatan.nama_sub_jabatan', 'anggota.foto', 'anggota.ktp')
                            ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                            ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                            ->join('jabatan', 'sub_jabatan.id_jabatan', 'jabatan.id_jabatan')
                            ->where('anggota.id_akun', $akun)
                            ->get(); 
        }
        else if($level == 'all' && $akun == 'all'){
            return 'all';
            $data = Anggota::select('akun.nama_akun', 'akun.id_level', 'anggota.no_anggota', 'anggota.nama_anggota', 'anggota.nik',  'anggota.alamat', 'anggota.jenis_kelamin', 'jabatan.jabatan', 'sub_jabatan.id_jabatan', 'sub_jabatan.nama_sub_jabatan', 'anggota.foto', 'anggota.ktp')
                            ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                            ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                            ->join('jabatan', 'sub_jabatan.id_jabatan', 'jabatan.id_jabatan')
                            ->get(); 
        }
        else{
            $data = Anggota::select('akun.nama_akun', 'akun.id_level', 'anggota.no_anggota', 'anggota.nama_anggota', 'anggota.nik',  'anggota.alamat', 'anggota.jenis_kelamin', 'jabatan.jabatan', 'sub_jabatan.id_jabatan', 'sub_jabatan.nama_sub_jabatan', 'anggota.foto', 'anggota.ktp')
                            ->join('akun', 'akun.id_akun', 'anggota.id_akun')
                            ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
                            ->join('jabatan', 'sub_jabatan.id_jabatan', 'jabatan.id_jabatan')
                            ->get(); 
        }
        
        // return view('backend.dashboard.anggota.anggota_pdf')->with(['data' => $data]);
        $pdf = PDF::loadview('backend.dashboard.anggota.anggota_pdf', ['data'=>$data]);
        $pdf->setPaper('A4', 'potrait');
    	return $pdf->download('laporan-anggota.pdf');
    }

    public function wilayah($id)
    {
        $wils   = Akun::where('akun.id_level', $id)->get()->pluck("nama_akun","id_akun");
        
        $jml = Anggota::join('akun', 'akun.id_akun', 'anggota.id_akun')
        ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
        ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan');
        if($id != '1'){
            $jml = $jml->where('akun.id_level',$id);
        }
        $jml = $jml->count();

        $json_data = [
            "wilayah"    => $wils,
            "jml"        => $jml   
        ];

        return json_encode($json_data);
    }

    public function unit($id)
    {
        $wils   = Akun::where('akun.id_level', 3)->get()->pluck("nama_akun","id_dewan");
        $units  = Pac::where('id_dewan', $id)->get()->pluck("nama_pac","id_pac");

        $jml = Anggota::join('akun', 'akun.id_akun', 'anggota.id_akun')
        ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
        ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
        ->where('akun.id_level', 3)->where('akun.id_akun', $id)
        ->count();

        $json_data = [
            "wilayah"     => $wils,
            "unit"        => $units,
            "jml"         => $jml,   
        ];

        return json_encode($json_data);
    }

    public function unitwilayah()
    {
        $wils   = Akun::where('akun.id_level', 3)->get()->pluck("nama_akun","id_dewan");
        $units  = Akun::where('akun.id_level', 4)->get()->pluck("nama_akun","id_akun");

        $jml = Anggota::join('akun', 'akun.id_akun', 'anggota.id_akun')
        ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
        ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
        ->where('akun.id_level',4)->count();

        $json_data = [
            "wilayah"     => $wils,
            "unit"        => $units,
            "jml"         => $jml,   
        ];

        return json_encode($json_data);
    }

    public function wil($wil)
    {
        $units  = Pac::where('id_dewan', $wil)->get()->pluck("nama_pac","id_pac");

        $jml = Anggota::join('akun', 'akun.id_akun', 'anggota.id_akun')
        ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
        ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
        ->where('akun.id_level',3)->where('akun.id_akun', $wil)->count();

        $json_data = [
            "unit"        => $units,
            "jml"         => $jml,   
        ];

        return json_encode($json_data);
    }

    public function wil2($wil)
    {
        $jml = Anggota::join('akun', 'akun.id_akun', 'anggota.id_akun')
        ->join('sub_jabatan', 'sub_jabatan.id_sub_jabatan', 'anggota.id_sub_jabatan')
        ->join('jabatan', 'jabatan.id_jabatan', 'sub_jabatan.id_jabatan')
        ->where('akun.id_level',4)->where('akun.id_pac', $wil)->count();

        $json_data = [
            "jml"         => $jml,   
        ];

        return json_encode($json_data);
    }
}

