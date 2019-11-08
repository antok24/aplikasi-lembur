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
                    <b>Data Riwayat Pendidikan:</b><br><br>
                      <b>Nama &nbsp;:</b> {{Auth::user()->name}}<br>
                      <b>NIP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> {{Auth::user()->nip}}<br>
                      <b>UPBJJ :</b> 24/Bandung
                  </h3>
                </div>
                  <div class="box-body">
                  @if(isset($edit))
                  <div class="box-body">
                    <form action="{{url('study/form/update', $edit->id)}}" method="POST">
                      {{csrf_field()}}
                      <div class="box-body">
                        <div class="row">          
                          <div class="col-xs-2">
                            <label>Jenjang Pendidikan:</label>
                              <select name="jenjang" class="form-control select2" style="width: 100%;" required="">
                                <option value="{{$edit->jenjang}}">{{$edit->jenjang}}</option>
                                <option value="SD">SD</option>
                                <option value="SLTP">SLTP</option>
                                <option value="SLTA">SLTA</option>
                                <option value="DI">DI</option>
                                <option value="DII">DII</option>
                                <option value="DIII">DIII</option>
                                <option value="D4">D4</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                              </select>
                          </div>
                          <div class="col-xs-4">
                            <label>Nama Sekolah / Univ :</label>
                              <input type="text" name="pendidikan" value="{{$edit->pendidikan}}" class="form-control" required=""> 
                          </div>
                          <div class="col-xs-2">
                            <label>Tahun :</label>
                              <input type="text" name="tahun" value="{{$edit->tahun}}" id="tahun "class="form-control" required="">
                          </div>
                          <div class="col-xs-4">
                            <label>Kab / Kota :</label>
                              <input type="text" name="kabko" value="{{$edit->kabko}}" class="form-control" required="">
                          </div>
                          <input type="hidden" value="{{Auth::user()->nip}}" name="nip">
                          <input type="hidden" value="{{Auth::user()->name}}" name="user_update">
                        </div>
                      </div>
                      <div class="box-footer">
                        <button type="submit" class="btn btn-warning">Update</button>
                      </div>
                    </form>
                  </div>
                  @else
                  <div class="box-body">
                    <form action="{{url('study/form/simpan')}}" method="POST">
                      {{csrf_field()}}
                      <div class="box-body">
                        <div class="row">          
                          <div class="col-xs-2">
                            <label>Jenjang Pendidikan:</label>
                              <select name="jenjang" class="form-control select2" style="width: 100%;" required="">
                                <option value disabled selected>--Pilih--</option>
                                <option value="SD">SD</option>
                                <option value="SLTP">SLTP</option>
                                <option value="SLTA">SLTA</option>
                                <option value="DI">DI</option>
                                <option value="DII">DII</option>
                                <option value="DIII">DIII</option>
                                <option value="D4">D4</option>
                                <option value="S1">S1</option>
                                <option value="S2">S2</option>
                                <option value="S3">S3</option>
                              </select>
                              @if ($errors->has('jenjang'))
                              <div class="form-group has-error">
                                <span class="help-block">Pendidikan tidak boleh kosong, wajib diisi !</span>
                              </div>
                              @endif
                          </div>
                          <div class="col-xs-4">
                            <label>Nama Sekolah / Univ :</label>
                              <input type="text" name="pendidikan" value="{{ old('pendidikan') }}" id="pendidikan" class="form-control" placeholder="Universitas Terbuka">
                              @if ($errors->has('pendidikan'))
                              <div class="form-group has-error">
                                <span class="help-block">Pendidikan tidak boleh kosong, wajib diisi !</span>
                              </div>
                              @endif
                          </div>
                          <div class="col-xs-2">
                            <label>Tahun :</label>
                              <input type="text" name="tahun" value="{{ old('tahun') }}" id="tahun" class="form-control" placeholder="01-06-2019">
                              @if ($errors->has('tahun'))
                              <div class="form-group has-error">
                                <span class="help-block">Tahun tidak boleh kosong, wajib diisi !</span>
                              </div>
                              @endif
                          </div>
                          <div class="col-xs-4">
                            <label>Kab / Kota :</label>
                              <input type="text" name="kabko" value="{{ old('kabko') }}" id="kabko" class="form-control" placeholder="Universitas Terbuka">
                              @if ($errors->has('kabko'))
                              <div class="form-group has-error">
                                <span class="help-block">Kab / Kota tidak boleh kosong, wajib diisi !</span>
                              </div>
                              @endif
                          </div>
                          <input type="hidden" value="{{Auth::user()->nip}}" name="nip">
                          <input type="hidden" value="{{Auth::user()->name}}" name="user_create">
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
                        <th><center>Jenjang</center></th>
                        <th><center>Pendidikan</center></th>
                        <th><center>Tahun</center></th>
                        <th><center>Kab / Kota</center></th>
                        <th><center>Opsi</center></th>
                      </tr>
                      </thead>
                      @php $no = 1; @endphp
                      @foreach($result as $result)
                      <tbody>
                        <tr>
                          <td><center>{{$no++}}</center></td>
                          <td><center>{{$result->jenjang}}</center></td>
                          <td>{{$result->pendidikan}}</td>
                          <td><center>{{$result->tahun}}</center></td>
                          <td><center>{{$result->kabko}}</center></td>
                          <td>
                            <center>
                            <form method="PUT" action="/study/hapus/{{$result->id}}">
                              <a href="/study/form/{{encrypt($result->id)}}" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-edit"></span>&nbsp;Edit</a>
                              <button class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin akan menghapus data ini?');">Hapus</button>
                            </form>
                            </center>
                          </td>
                        </tr>
                      </tbody>
                      @endforeach
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
@endsection