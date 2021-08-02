@extends('layouts.masterappfixed')

@section('content')

<section class="content">

  @include('layouts.message')

  <div class="box box-primary" data-select2-id="16">
    <div class="box-header with-border">
      <h3 class="box-title">Update Data Pegawai :</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <form action="{{url('userupdate', $user->id)}}" method="POST">
      @csrf
      <div class="box-body" data-select2-id="15">
        <div class="row">
          <div class="col-md-3">
            <label>NIP :</label>
            <input type="text" name="nip" value="{{ $user->nip }}" id="nip" class="form-control" placeholder="">
            @if ($errors->has('nip'))
            <div class="form-group has-error">
              <span class="help-block">NIP, wajib diisi !</span>
            </div>
            @endif
          </div>
          <div class="col-md-3">
            <label>Nama Pegawai:</label>
            <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
            @if ($errors->has('name'))
            <div class="form-group has-error">
              <span class="help-block">Nama Pegawai, wajib diisi !</span>
            </div>
            @endif
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <label>Atasan :</label>
            <select name="nip_atasan" class="form-control select2" required="">
              @foreach ($pejabat as $pejabat)
              <option value="{{ $pejabat->nip }}">{{ $pejabat->user->name }}</option>
              @endforeach
            </select>
            @if ($errors->has('nip_atasan'))
            <div class="form-group has-error">
              <span class="help-block">Alamat UPBJJ, wajib diisi !</span>
            </div>
            @endif
          </div>

          <div class="col-md-3">
            <label>UPBJJ :</label>
            <select name="kode_upbjj" class="form-control select2" required="">
              @foreach ($upbjj as $a)
              <option value="{{ $a->kode_upbjj }}">{{ $a->nama_upbjj }}</option>
              @endforeach
            </select>
            @if ($errors->has('kode_upbjj'))
            <div class="form-group has-error">
              <span class="help-block">UPBJJ, wajib diisi !</span>
            </div>
            @endif
          </div>
        </div>

        <div class="row">
          <div class="col-md-3">
            <label>Email :</label>
            <input type="text" name="email" id="email" value="{{ $user->email }}" class="form-control" placeholder="">
            @if ($errors->has('email'))
            <div class="form-group has-error">
              <span class="help-block">Alamat UPBJJ, wajib diisi !</span>
            </div>
            @endif
          </div>
        </div>
        <!-- /.row -->
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a type="submit" href="{{ route('user.index') }}" class="btn btn-default">Kembali</a>
      </div>
    </form>
  </div>
  <!-- /.box -->
</section>

@endsection