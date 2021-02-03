<div class="table-responsive">
                    <table  id="datatable" class="table">
                      <thead>
                        <tr>
                          <th> No. </th>
                          <th> No. Anggota </th>
                          <th> Nama</th>
                          <th> NIK</th>
                          <th> Alamat </th>
                          <th> Jenis Kelamin </th>
                          <th> Keterangan </th>
                          <th> Jabatan </th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($data as $item)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$item->no_anggota}}</td>
                          <td>{{$item->nama_anggota}}</td>
                          <td>{{$item->nik}}</td>
                          <td>{{$item->alamat}}</td>
                          <td>
                            @if($item->jenis_kelamin == 'L')
                            Laki-laki
                            @else
                            Perempuan
                            @endif
                          </td>
                          <td>{{$item->nama_akun}}</td>
                          <td>
                          @if($item->id_jabatan == 1 && $item->id_sub_jabatan != 1)
                            {{$item->nama_sub_jabatan}}
                          @elseif($item->id_jabatan != 1 && $item->id_sub_jabatan == 1)
                            {{$item->jabatan}}
                          @elseif($item->id_jabatan == 1 && $item->id_sub_jabatan == 1)
                            Anggota
                          @else
                            @if($item->jabatan == 'Tidak Ada')
                            {{$item->nama_sub_jabatan}}
                            @else
                            {{$item->jabatan}} ({{$item->nama_sub_jabatan}})
                            @endif
                          @endif
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>