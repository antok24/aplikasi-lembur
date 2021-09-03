@extends('layouts.masterappfixed')
@section('content')

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title"><b>Rekap Data Lembur Tervalidasi</b></h3>
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
                  <th>Total</th>
                  <th>Nama Kegiatan</th>
                  <th>Uraian Kegiatan</th>
                  <th>
                    <center>Volume</center>
                  </th>
                  <th>
                    <center>Satuan</center>
                  </th>
                  <th>
                    <center>Status</center>
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
                      @if ($a->status_validasi == 1)
                      <a class="btn btn-xs btn-success">Tervalidasi</a>
                      @endif
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