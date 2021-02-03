
@foreach ($data as $item)
<div style="margin-bottom:20px;">
    <div class="col-lg-12 col-md-12">
    @if( $item->id_level == 2 )
        @if($item->nama_akun == 'DPP')
        <h3 class="font-weight-bold">{{$item->nama_akun}}</h3>
        @else
        <h3 class="font-weight-bold">Yayasan {{$item->nama_akun}}</h3>
        @endif
    @elseif( $item->id_level == 3 )
        @if($item->nama_akun == 'DPC')
        <h3 class="font-weight-bold">{{$item->nama_akun}}</h3>
        @else
        <h3 class="font-weight-bold">Wilayah {{$item->nama_akun}}</h3>
        @endif
    @elseif( $item->id_level == 4 )
        @if($item->nama_akun == 'PAC')
        <h3 class="font-weight-bold">{{$item->nama_akun}}</h3>
        @else
        <h3 class="font-weight-bold">Unit {{$item->nama_akun}}</h3>
        @endif
    @else
        <h3 class="font-weight-bold">{{$item->nama_akun}}</h3>
    @endif
        <hr>
    </div>
                            
    <div class="col-lg-4 col-md-12">
    <div class="tabel-responsive">
        <table >
            <tr>
                <th>No Anggota :</th>
                <td>{{$item->no_anggota}}</td>
            </tr>
        </table> 
    </div>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="tabel-responsive">
                                 <table>
                                    <tr>
                                        <th>Nama :</th>
                                        <td>{{$item->nama_anggota}}</td>
                                    </tr>
                                 </table>
                                 </div>
    </div>
    <div class="col-lg-4 col-md-12">
                                <div class="tabel-responsive">
                               <table>
                                    <tr>
                                        <th>Jabatan :</th>
                                        <td> 
                                            @if($item->id_jabatan == 1 && $item->id_sub_jabatan != 1)
                                                {{$item->nama_sub_jabatan}}
                                            @elseif($item->id_jabatan != 1 && $item->id_sub_jabatan == 1)
                                               {{$item->jabatan}}
                                            @elseif($item->id_jabatan != null && $item->id_sub_jabatan != 1)
                                            
                                                 {{$item->jabatan}} ( {{$item->nama_sub_jabatan}} )
                                            @elseif($item->id_jabatan == 1 && $item->id_sub_jabatan == 1)
                                                  Anggota
                                            @else
                                                @if($item->id_jabatan == null)
                                                {{$item->nama_sub_jabatan}}
                                                @else
                                                {{$item->id_jabatan}}
                                                {{$item->jabatan}} ({{$item->nama_sub_jabatan}})
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                               </div>
                               
                            </div>
    <div style="margin-bottom:10px;">
        <table>
            <tr>
                <th>Alamat :</th>
                <td>{{$item->alamat}}</td>
            </tr>
        </table>
    </div>
    <br>                
    <!--<div class="row">-->
    <!--    <div class ="set-image-1 col"> -->
    <!--    </div>-->
    <!--    <div class="set-image-2 col">-->
    
    <!--    </div>-->
    <!--</div>-->
    <img src="{{asset('public/uploaded_files/anggota/foto/'.$item['foto'])}}" alt="Logo" class="mt-3 ml-5" width="180px" height="190px" style=" border-radius: 15%; margin-top:10px; margin-right:15px;">  
    <img src="{{asset('public/uploaded_files/anggota/ktp/'.$item['ktp'])}}" alt="Logo" class="mt-3 ml-5" width="270px" height="190px" style=" border-radius: 15%;margin-top:10px;" >
    <br><br><br>
    <!--<img src="{{asset('public/uploaded_files/anggota/foto/'.$item['foto'])}}" alt="Logo" class="mt-3 ml-5" width="250px" height="250px" style=" border-radius: 15%;">  -->
    <!--<img src="{{asset('public/uploaded_files/anggota/ktp/'.$item['ktp'])}}" alt="Logo" class="mt-3 ml-5" width="200px" height="250px" style=" border-radius: 15%;" >-->
</div>
    @endforeach