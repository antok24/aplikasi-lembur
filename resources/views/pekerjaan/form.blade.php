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
                    <b>Data Riwayat Pekerjaan:</b><br><br>
                      <b>Nama &nbsp;:</b> {{Auth::user()->name}}<br>
                      <b>NIP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b> {{Auth::user()->nip}}<br>
                      <b>UPBJJ :</b> 24/Bandung
                  </h3>
                </div>
                  <div class="box-body">
                  @if(isset($edit))
                  <div class="box-body">
                    <form action="{{url('jobs/form/update', $edit->id)}}" method="POST">
                      {{csrf_field()}}
                      <div class="box-body">
                        <div class="row">          
                          <div class="col-xs-4">
                            <label>Tempat Kerja:</label>
                              <input type="text" name="unit_kerja" value="{{$edit->unit_kerja}}" id="unit_kerja" class="form-control" placeholder="Universitas Terbuka">
                          </div>
                          <div class="col-xs-2">
                            <label>Jabatan:</label>
                              <input type="text" name="jabatan" value="{{$edit->jabatan}}" id="jabatan" class="form-control" placeholder="IIIa/PENATA MUDA (CPNS)">
                          </div>
                          <div class="col-xs-2">
                            <label>Nomor SK:</label>
                              <input type="text" name="nomor_sk" value="{{$edit->nomor_sk}}" id="nomor_sk" class="form-control">
                          </div>
                          <div class="col-xs-2">
                            <label>Tahun :</label>
                              <input type="text" name="waktu" value="{{$edit->waktu}}" id="tahun" class="form-control" placeholder="01-08-2016">
                          </div>
                          <div class="col-xs-2">
                            <label>Keterangan:</label>
                              <input type="text" name="keterangan" value="{{$edit->keterangan}}" id="keterangan" class="form-control">
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
                    <form action="{{url('jobs/form/simpan')}}" method="POST" novalidate="">
                      {{csrf_field()}}
                      <div class="box-body">
                        <div class="row">          
                          <div class="col-xs-4">
                            <label>Tempat Kerja:</label>
                              <input type="text" name="unit_kerja" value="{{ old('unit_kerja') }}" id="unit_kerja" class="form-control" placeholder="Universitas Terbuka">
                              @if ($errors->has('unit_kerja'))
                              <div class="form-group has-error">
                                <span class="help-block">Unit Kerja tidak boleh kosong, wajib diisi !</span>
                              </div>
                              @endif
                          </div>
                          <div class="col-xs-2">
                            <label>Jabatan:</label>
                              <input type="text" name="jabatan" value="{{ old('jabatan') }}" id="jabatan" class="form-control" placeholder="IIIa/PENATA MUDA (CPNS)">
                              @if ($errors->has('jabatan'))
                              <div class="form-group has-error">
                                <span class="help-block">Jabatan tidak boleh kosong, wajib diisi !</span>
                              </div>
                              @endif
                          </div>
                          <div class="col-xs-2">
                            <label>Nomor SK:</label>
                              <input type="text" name="nomor_sk" value="{{ old('nomor_sk') }}" id="nomor_sk" class="form-control">
                              @if ($errors->has('nomor_sk'))
                              <div class="form-group has-error">
                                <span class="help-block">Nomor SK tidak boleh kosong, wajib diisi !</span>
                              </div>
                              @endif
                          </div>
                          <div class="col-xs-2">
                            <label>Tahun :</label>
                              <input type="text" name="waktu" value="{{ old('waktu') }}" id="tahun" class="form-control" placeholder="01-08-2016">
                              @if ($errors->has('waktu'))
                              <div class="form-group has-error">
                                <span class="help-block">Tahun tidak boleh kosong, wajib diisi !</span>
                              </div>
                              @endif
                          </div>
                          <div class="col-xs-2">
                            <label>Keterangan:</label>
                              <input type="text" name="keterangan" value="{{ old('keterangan') }}" id="keterangan" class="form-control">
                              @if ($errors->has('keterangan'))
                              <div class="form-group has-error">
                                <span class="help-block">Keterangan tidak boleh kosong, wajib diisi !</span>
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
                        <th><center>Unit Kerja</center></th>
                        <th><center>Jabatan</center></th>
                        <th><center>Nomor SK</center></th>
                        <th><center>Tahun</center></th>
                        <th><center>Keterangan</center></th>
                        <th><center>Opsi</center></th>
                      </tr>
                      </thead>
                      @php $no = 1; @endphp
                      @foreach($result as $result)
                      <tbody>
                        <tr>
                          <td><center>{{$no++}}</center></td>
                          <td>{{$result->unit_kerja}}</td>
                          <td><center>{{$result->jabatan}}</center></td>
                          <td><center>{{$result->nomor_sk}}</center></td>
                          <td><center>{{$result->waktu}}</center></td>
                          <td><center>{{$result->keterangan}}</center></td>
                          <td>
                            <center>
                            <form method="PUT" action="/jobs/hapus/{{$result->id}}">
                              <a href="/jobs/form/{{encrypt($result->id)}}" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-edit"></span>&nbsp;Edit</a>
                              <button class="btn btn-danger btn-xs" onclick="return confirm('Apakah anda yakin akan menghapus data ini?');"><i class="fa fa-trash"></i> Hapus</button>
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