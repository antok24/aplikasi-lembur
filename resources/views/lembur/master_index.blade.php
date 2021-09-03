@extends('layouts.masterappfixed')
@section('content')
<section class="content">
  @include('layouts.message')
  <div class="row">
    <div class="col-md-8">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Pencarian Data Lembur Pegawai</b></h3>
        </div>
        <form action="{{ route('mastereditlembur.cari')}}" method="GET" role="key">
          <div class="box-body">
            <div class="form-group has-success">
              <label class="col-sm-3 control-label">Masukkan NIP / Nama Pegawai</label>
              <div class="input-group">
                <input type="text" class="form-control" name="key" placeholder="Masukan NIP / Nama Pegawai" required="">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-info pull-right">Cari</button>
                </span>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  @if(isset($result))
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title"><b>Data Lembur Pegawai</b></h3>
        </div>
        <div class="box-body table-responsive no-padding">
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped table-condensed mb-none">
              <thead style="background-color:#33CCFF; color:#696969;">
                <tr>
                  <th>
                    <center>No</center>
                  </th>
                  <th>
                    <center>Nama</center>
                  </th>
                  <th>
                    <center>NIP</center>
                  </th>
                  <th>
                    <center>TGL Lembur</center>
                  </th>
                  <th>
                    <center>Jam Masuk</center>
                  </th>
                  <th>
                    <center>Jam Pulang</center>
                  </th>
                  <th>Jam Lembur</th>
                  <th>Nama Kegiatan</th>
                  <th>Uraian Kegiatan</th>
                  <th>
                    <center>Volume</center>
                  </th>
                  <th>
                    <center>Satuan</center>
                  </th>
                  <th>
                    <center>Opsi</center>
                  </th>
                  <th>
                    <center>Lanjutan</center>
                  </th>
                </tr>
              </thead>
              <tbody>
                @php $no = 1; @endphp
                @foreach($result as $a)
                <tr>
                  <td>
                    <center>{{$no++}}</center>
                  </td>
                  <td>{{$a->name}}</td>
                  <td>{{$a->nip}}</td>
                  <td>
                    <center>{{$a->tanggal_kegiatan}}</center>
                  </td>
                  <td>
                    <center>{{$a->masuk}}</center>
                  </td>
                  <td>
                    <center>{{$a->pulang}}</center>
                  </td>
                  <td>{{$a->totaljam}}</td>
                  <td>{{$a->nama_kegiatan}}</td>
                  <td>{!! $a->uraian_kegiatan !!}</td>
                  <td>
                    <center>{{$a->volume}}</center>
                  </td>
                  <td>{{$a->satuan}}</td>
                  <td>
                    <center>
                      <a target="_blank" href="{{ route('lembur.print', base64_encode($a->id)) }}" class="btn btn-success btn-xs">
                        <span class="glyphicon glyphicon-print"></span>&nbsp;
                        Cetak
                      </a>
                      <a href="{{ route('lembur.editlembur',base64_encode($a->id)) }}" class="btn btn-warning btn-xs">
                        <span class="glyphicon glyphicon-edit"></span>&nbsp;
                        Edit
                      </a>
                      <a href="{{ route('lembur.deletelembur', base64_encode($a->id)) }}" class="btn btn-danger btn-xs">
                        <span class="glyphicon glyphicon-trash"></span>&nbsp;
                        Delete
                      </a>
                    </center>
                  </td>
                  <td>
                    <center>
                      <a href="{{ route('lembur.batalvalidasi', base64_encode($a->id)) }}" class="btn btn-danger btn-xs">
                        <span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;
                        Batalkan Status Validasi
                      </a>
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
  @elseif(isset($message))
  <p>{{ $message }}</p>
  @endif
@endsection