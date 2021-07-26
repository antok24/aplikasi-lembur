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

  @if (session('error'))
  <div class="row">
    <div class="col-xs-12">
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('error') }}
      </div>
    </div>
  </div>
  @endif

  @if (session('any'))
  <div class="row">
    <div class="col-xs-12">
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('any') }}
      </div>
    </div>
  </div>
  @endif
  <div class="box box-primary" data-select2-id="16">
    <div class="box-header with-border">
      <h3 class="box-title">Data Surat Tugas</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
      <div class="box-body">
        <table id="example1" class="table table-bordered table-striped table-condensed mb-none">
          <thead style="background-color:#33CCFF; color:#696969;">
            <tr>
              <th>
                <center>No</center>
              </th>
              <th>
                <center>Nomor Surat</center>
              </th>
              <th>
                <center>Nama Kegiatan</center>
              </th>
              <th>
                <center>Tanggal</center>
              </th>
              <th>
                <center>Opsi</center>
              </th>
            </tr>
          </thead>
          <tbody>
            @php $no = 1; @endphp
            @foreach($surattugas as $st)
            <tr>
              <td>
                <center>{{$no++}}</center>
              </td>
              <td>{{$st->nomor_surat_tugas}}</td>
              <td>{{$st->nama_kegiatan}}</td>
              <td>{{$st->tanggal_kegiatan}}</td>
              <td>
                <center>
                  <a href="" class="btn btn-success btn-xs">
                    <span class="glyphicon glyphicon-user"></span>&nbsp;Lihat Petugas</a>
                </center>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>

@endsection