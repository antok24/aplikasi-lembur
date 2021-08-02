@extends('layouts.masterappfixed')

@section('content')

<section class="content">
  
  @include('layouts.message')

  <div class="box box-primary" data-select2-id="16">
    <div class="box-header with-border">
      <h3 class="box-title">Form Edit UPBJJ:</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <form action="{{ route('upbjj.update', $upbjj->id)}}" method="POST">
      @csrf
      <div class="box-body" data-select2-id="15">
        <div class="row">
          <div class="col-md-3">
            <label>Kode UPBJJ :</label>
            <input type="text" name="kode_upbjj"
              id="kode_upbjj" class="form-control" placeholder="" value="{{ $upbjj->kode_upbjj }} | {{ $upbjj->nama_upbjj }}" readonly>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <label>Alamat :</label>
            <input type="text" name="alamat"
              id="alamat" class="form-control" placeholder="" value="{{ $upbjj->alamat }}">
            @if ($errors->has('alamat'))
            <div class="form-group has-error">
              <span class="help-block">Alamat UPBJJ, wajib diisi !</span>
            </div>
            @endif
          </div>

          <div class="col-md-6">
            <label>Nomor Telp :</label>
            <input type="text" name="no_telp" value="{{ $upbjj->no_telp }}" id="no_telp"
              class="form-control" placeholder="Nama Kegiatan">
            @if ($errors->has('no_telp'))
            <div class="form-group has-error">
              <span class="help-block">Nomor Telepon, wajib diisi !</span>
            </div>
            @endif
          </div>
        </div>
        <!-- /.row -->
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-warning">Update Data</button>
        <a type="submit" href="{{ route('upbjj.index') }}" class="btn btn-default">Kembali</a>
      </div>
    </form>
  </div>
  <!-- /.box -->
</section>

@endsection