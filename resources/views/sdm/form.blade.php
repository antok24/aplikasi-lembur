@extends('layouts.masterappfixed')

@section('content')
      
      <section class="content">
        @if (session('success'))
       <div class="row">
          <div class="col-xs-12">
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
               {{ session('success') }}
            </div>
          </div>
        </div>
        @endif

          <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title">
                    <b>Data Riwayat Pengembangan SDM:</b><br><br>
                      <b>Nama &nbsp;:</b> {{Auth::user()->name}}<br>
                      <b>NIP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> {{Auth::user()->nip}}<br>
                      <b>UPBJJ :</b> 24/Bandung
                  </h3>
                </div>
                  <div class="box-body">
                  @if(isset($edit))
                  <div class="box-body">
                    <form action="{{url('sdm/form/update', $edit->id)}}" enctype="multipart/form-data" method="POST">
                      {{csrf_field()}}
                      <div class="box-body">
                        <div class="row">          
                          <div class="col-xs-3">
                            <label>Nama Kegiatan</label>
                              <input type="text" name="nama_kegiatan" value="{{ $edit->nama_kegiatan }}" id="nama_kegiatan" class="form-control" placeholder="Pelatihan Microsoft Office">
                              @if ($errors->has('nama_kegiatan'))
                              <div class="form-group has-error">
                                <span class="help-block">Isian Terlalu panjang atau Nama Kegiatan tidak boleh kosong, wajib diisi !</span>
                              </div>
                              @endif
                          </div>
                          <div class="col-xs-3">
                            <label>Pelatih</label>
                              <input type="text" name="pelatih" value="{{ $edit->pelatih }}" id="pelatih" class="form-control" placeholder="">
                              @if ($errors->has('pelatih'))
                              <div class="form-group has-error">
                                <span class="help-block">Isian Terlalu panjang atau Pelatih tidak boleh kosong, wajib diisi !</span>
                              </div>
                              @endif
                          </div>
                          <div class="col-xs-3">
                            <label>Lokasi</label>
                              <input type="text" name="kabko" value="{{ $edit->kabko }}" id="kabko" class="form-control" placeholder="Kota Bandung">
                              @if ($errors->has('kabko'))
                              <div class="form-group has-error">
                                <span class="help-block">Isian Terlalu panjang atau Lokasi tidak boleh kosong, wajib diisi !</span>
                              </div>
                              @endif
                          </div>
                          <div class="col-xs-2">
                            <label>Tahun</label>
                             <input type="text" name="waktu" value="{{ $edit->waktu }}" id="waktu" class="form-control" placeholder="01-06-2019">
                              @if ($errors->has('waktu'))
                              <div class="form-group has-error">
                                <span class="help-block">Isian Terlalu panjang atau Tahun tidak boleh kosong, wajib diisi !</span>
                              </div>
                              @endif
                          </div>
                          <input type="hidden" value="{{Auth::user()->name}}" name="user_update">
                        </div>
                        <div class="row">          
                          <div class="col-xs-6">
                            <label>File Sertifikat:</label>
                              <input type="hidden" name="file" value="{{$edit->file}}" id="file" class="form-control" onchange="return validasiFile()">
                              <embed src="{{ url('FileSDM/'.$edit->file) }}" type="application/pdf" width="100%" height="600px"/>
                          </div>
                        </div>
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-warning">Update</button>
                      </div>
                    </form>
                  </div>
                  @else
                  <div class="box-body">
                    <form action="{{url('sdm/form/simpan')}}" enctype="multipart/form-data" method="POST">
                      {{csrf_field()}}
                      <div class="box-body">
                        <div class="row">          
                          <div class="col-xs-3">
                            <label>Nama Kegiatan</label>
                              <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" id="nama_kegiatan" class="form-control" placeholder="Pelatihan Microsoft Office">
                              @if ($errors->has('nama_kegiatan'))
                              <div class="form-group has-error">
                                <span class="help-block">Isian Terlalu panjang atau Nama Kegiatan tidak boleh kosong, wajib diisi !</span>
                              </div>
                              @endif
                          </div>
                          <div class="col-xs-3">
                            <label>Pelatih</label>
                              <input type="text" name="pelatih" value="{{ old('pelatih') }}" id="pelatih" class="form-control" placeholder="">
                              @if ($errors->has('pelatih'))
                              <div class="form-group has-error">
                                <span class="help-block">Isian Terlalu panjang atau Pelatih tidak boleh kosong, wajib diisi !</span>
                              </div>
                              @endif
                          </div>
                          <div class="col-xs-3">
                            <label>Lokasi</label>
                              <input type="text" name="kabko" value="{{ old('kabko') }}" id="kabko" class="form-control" placeholder="Kota Bandung">
                              @if ($errors->has('kabko'))
                              <div class="form-group has-error">
                                <span class="help-block">Isian Terlalu panjang atau Lokasi tidak boleh kosong, wajib diisi !</span>
                              </div>
                              @endif
                          </div>
                          <div class="col-xs-2">
                            <label>Tahun</label>
                             <input type="text" name="waktu" value="{{ old('waktu') }}" id="waktu" class="form-control" placeholder="01-06-2019">
                              @if ($errors->has('waktu'))
                              <div class="form-group has-error">
                                <span class="help-block">Isian Terlalu panjang atau Tahun tidak boleh kosong, wajib diisi !</span>
                              </div>
                              @endif
                          </div>
                          <input type="hidden" value="{{Auth::user()->nip}}" name="nip">
                          <input type="hidden" value="{{Auth::user()->name}}" name="user_create">
                        </div>
                        <div class="row">          
                          <div class="col-xs-6">
                            <label>File Sertifikat:</label>
                              <input type="file" name="file" id="file" class="form-control" onchange="return validasiFile()">
                              <a href="https://smallpdf.com/id/konverter-pdf" target="_blank" class="btn btn-warning">Gunakan Tombol Ini Untuk Convert File Gambar ke PDF</a>
                              <div id="pratinjauGambar"></div>
                              @if ($errors->has('file'))
                              <div class="form-group has-error">
                                <span class="help-block">File Sertifikat tidak boleh kosong, wajib ada !</span>
                              </div>
                              @endif
                                <script>
                                function validasiFile(){
                                    var inputFile = document.getElementById('file');
                                    var pathFile = inputFile.value;
                                    var ekstensiOk = /(\.pdf)$/i;
                                    if(inputFile.files[0].size > 2000000){
                                      alert('Ukuran File yang anda Upload terlalu besar, Maximal ukuran 2 MB... Anda tidak diperbolehkan mengupload file dengan ukuran lebih besar dari yang sudah ditentukan. Harap kecilkan ukuran file / COMPRESS terlebih dahulu file anda melalui https://smallpdf.com/compress-pdf');
                                      inputFile.value='';
                                    }       
                                    if(!ekstensiOk.exec(pathFile)){
                                        alert('Silakan upload file yang memiliki ekstensi .PDF');
                                        inputFile.value = '';
                                        return false;
                                    }else{
                                        //Pratinjau gambar
                                        if (inputFile.files && inputFile.files[0]) {
                                            var reader = new FileReader();
                                            reader.onload = function(e) {
                                                document.getElementById('pratinjauGambar').innerHTML = '<embed src="'+e.target.result+'" style="height:500px;width:690px"/>';
                                            };
                                            reader.readAsDataURL(inputFile.files[0]);
                                        }
                                    }
                                }
                                </script>
                          </div>
                        </div>
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                      </div>
                    </form>
                  </div>
                  @endif

                  <div class="box-body">
                    <table class="table table-bordered table-striped table-condensed mb-none">
                      <thead style="background-color:#33CCFF; color:#696969;">
                      <tr>
                        <th><center>No</center></th>
                        <th><center>Nama Kegiatan</center></th>
                        <th><center>Tahun</center></th>
                        <th><center>Pelatih</center></th>
                        <th><center>Ke Efektifan</center></th>
                        <th><center>Kabko</center></th>
                        <th><center>Berkas</center></th>
                        <th><center>Opsi</center></th>
                      </tr>
                      </thead>
                      <tbody>
                      @php $no = 1; @endphp
                      @foreach($result as $result)
                        <tr>
                          <td><center>{{$no++}}</center></td>
                          <td>{{$result->nama_kegiatan}}</td>
                          <td><center>{{$result->waktu}}</center></td>
                          <td><center>{{$result->pelatih}}</center></td>
                          <td><center>{{$result->efektif}}</center></td>
                          <td><center>{{$result->kabko}}</center></td>
                          <td>
                            <center>
                              <a href="{{ url('FileSDM/'.$result->file) }}" target="_blank" class="btn btn-xs btn-success"><span class="fa fa-eye"></span>&nbsp;Lihat</a>
                            </center>
                          </td>
                          <td>
                            <center>
                            <form method="PUT" action="/sdm/hapus/{{$result->id}}">
                              <a href="/sdm/form/{{encrypt($result->id)}}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit"></span>&nbsp;Edit</a>
                              <button class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin akan menghapus data ini?');">Hapus</button>
                            </form>
                            </center>
                          </td>
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
@endsection