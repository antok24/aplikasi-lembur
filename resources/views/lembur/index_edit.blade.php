@extends('layouts.masterappfixed')

@section('content')


<section class="content">
  @include('layouts.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title"><b>Berikut data lembur anda yang belum di Validasi oleh atasan Anda !
              <font color="red"><i> Segera Konfirmasi ke Atasan Anda</i>
                <br /><br />Anda hanya dapat meng-Edit Data Lembur yang Belum Ter-Validasi</font></b></h3>
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
                  <th width="50px">
                    <center>TGL Lembur</center>
                  </th>
                  <th width="50px">
                    <center>Jam Masuk</center>
                  </th>
                  <th width="50px">
                    <center>Jam Pulang</center>
                  </th>
                  <th>Jam Lembur</th>
                  <th>Nama Kegiatan</th>
                  <th width="90px">Uraian Kegiatan</th>
                  <th>
                    <center>Volume</center>
                  </th>
                  <th width="50px">
                    <center>Satuan</center>
                  </th>
                  <th>
                    <center>Opsi</center>
                  </th>
                </tr>
              </thead>
              <tbody>
                @php $no = 1; @endphp
                @foreach($lemburs as $a)
                <tr>
                  <td>
                    <center>{{$no++}}</center>
                  </td>
                  <td>{{ $a->user->name }}</td>
                  <td>{{$a->nip}}</td>
                  <td width="50px">
                    <center>{{ $a->surattugasdetail->tanggal_kegiatan }}</center>
                  </td>
                  <td width="50px">
                    <center>{{$a->masuk}}</center>
                  </td>
                  <td width="50px">
                    <center>{{$a->pulang}}</center>
                  </td>
                  <td>{{$a->totaljam}}</td>
                  <td>{{ $a->surattugasdetail->surattugas->nama_kegiatan }}</td>
                  <td width="90px">{!! $a->uraian_kegiatan !!}</td>
                  <td width="50px">
                    <center>{{$a->volume}}</center>
                  </td>
                  <td>{{$a->satuan}}</td>
                  <td>
                    <a href="{{ route('lembur.editlembur', base64_encode($a->id)) }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ route('lembur.deletelembur', base64_encode($a->id)) }}" class="btn btn-danger btn-sm">Hapus</a>
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