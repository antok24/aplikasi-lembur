@extends('layouts.masterappfixed')
@section('content')

      <div class="container">
        @if (session('success'))
        <div class="col-sm-10">
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             {{ session('success') }}
          </div>
        </div>
        @endif

    @if($errors->any())
    <div class="col-sm-10">
        <div class="alert alert-danger">
          <strong>Whoops</strong> Data Gagal di Hapus
          <ul>
            @foreach($errors as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
    </div>
      @endif
    </div>
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"><b>Berikut data lembur anda yang belum di Validasi oleh atasan Anda !
                  <font color="red"><i> Segera Konfirmasi ke Atasan Anda</i>
                    <br/><br/>Anda hanya dapat meng-Edit Data Lembur yang Belum Ter-Validasi</font></b></h3>
                </div>
                  <div class="box-body">
                  <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped table-condensed mb-none">
                      <thead style="background-color:#33CCFF; color:#696969;">
                      <tr>
                        <th><center>No</center></th>
                        <th><center>Nama</center></th>
                        <th><center>NIP</center></th>
                        <th width="50px"><center>TGL Lembur</center></th>
                        <th width="50px"><center>Jam Masuk</center></th>
                        <th width="50px"><center>Jam Pulang</center></th>
                        <th>Jam Lembur</th>
                        <th>Nama Kegiatan</th>
                        <th width="90px">Uraian Kegiatan</th>
                        <th><center>Volume</center></th>
                        <th width="50px"><center>Satuan</center></th>
                        <th><center>Opsi</center></th>
                      </tr>
                      </thead>
                      <tbody>
                      @php $no = 1; @endphp
                      @foreach($result as $a)
                      <tr>
                        <td><center>{{$no++}}</center></td>
                        <td>{{$a->namapegawai}}</td>
                        <td>{{$a->nip}}</td>
                        <td width="50px"><center>{{$a->tgl_lembur}}</center></td>
                        <td width="50px"><center>{{$a->masuk}}</center></td>
                        <td width="50px"><center>{{$a->pulang}}</center></td>
                        <td>{{$a->totaljam}}</td>
                        <td>{{$a->kegiatan}}</td>
                        <td width="90px">{{$a->uraiankegiatan}}</td>
                        <td width="50px"><center>{{$a->volume}}</center></td>
                        <td>{{$a->satuan}}</td>
                        <td>
                          <center>
                          <form action="{{route('lembur.destroy', $a->id)}}" method="POST">
                          <a href="/EditLembur/{{encrypt($a->id)}}/mXaD" class="btn btn-primary btn-xs">
                              <span class="glyphicon glyphicon-edit"></span>&nbsp;E d i t</a> <br/>&nbsp;
                          @csrf
                          @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span>Delete</button>
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