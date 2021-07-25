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
      <h3 class="box-title">Buat Surat Tugas Lembur:</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <form action="{{ route('surattugas.store')}}" method="POST">
      @csrf
      <div class="box-body" data-select2-id="15">
        <div class="row">
          <div class="col-md-3">
            <label>Nomor Surat :</label>
            <input type="text" name="nomor_surat_tugas" value="{{ old('nomor_surat_tugas') }}"
              id="nomor_surat_tugas" class="form-control" placeholder="0001/UN31.UPBJJ15/KP/2021">
            @if ($errors->has('nomor_surat_tugas'))
            <div class="form-group has-error">
              <span class="help-block">Nomor Surat, wajib diisi !</span>
            </div>
            @endif
          </div>

          <div class="col-md-6">
            <label>Nama Kegiatan :</label>
            <input type="text" name="nama_kegiatan" value="{{ old('nama_kegiatan') }}" id="nama_kegiatan"
              class="form-control" placeholder="Nama Kegiatan">
            @if ($errors->has('nama_kegiatan'))
            <div class="form-group has-error">
              <span class="help-block">Nama Kegiatan, wajib diisi !</span>
            </div>
            @endif
          </div>
          <div class="col-md-3">
            <label>Tanggal Kegiatan :</label>
            <input type="date" name="tanggal_kegiatan" value="{{ old('tanggal_kegiatan') }}"
              class="form-control pull-right">
            @if ($errors->has('tanggal_kegiatan'))
            <div class="form-group has-error">
              <span class="help-block">Tanggal Kegiatan Tidak Boleh Kosong, wajib diisi !</span>
            </div>
            @endif
          </div>
        </div>
        <!-- /.row -->
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Buat Surat Tugas</button>
      </div>
    </form>
  </div>
  <!-- /.box -->

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
                  <a href="{{ route('surattugas.addpegawai',base64_encode($st->id)) }}" class="btn btn-success btn-xs">
                    <span class="glyphicon glyphicon-user"></span>&nbsp;Tambahkan Petugas</a>
                </center>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- <div class="box-body table-responsive no-padding">
      <table id="example1" class="table table-hover">
        <tbody><tr>
          <th>ID</th>
          <th>User</th>
          <th>Date</th>
          <th>Status</th>
          <th>Reason</th>
        </tr>
        <tr>
          <td>183</td>
          <td>John Doe</td>
          <td>11-7-2014</td>
          <td><span class="label label-success">Approved</span></td>
          <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
        </tr>
        <tr>
          <td>219</td>
          <td>Alexander Pierce</td>
          <td>11-7-2014</td>
          <td><span class="label label-warning">Pending</span></td>
          <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
        </tr>
        <tr>
          <td>657</td>
          <td>Bob Doe</td>
          <td>11-7-2014</td>
          <td><span class="label label-primary">Approved</span></td>
          <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
        </tr>
        <tr>
          <td>175</td>
          <td>Mike Doe</td>
          <td>11-7-2014</td>
          <td><span class="label label-danger">Denied</span></td>
          <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
        </tr>
      </tbody></table>
    </div> --}}
  </div>
</section>

@endsection