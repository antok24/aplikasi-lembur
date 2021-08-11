@extends('layouts.masterappfixed')
@section('content')
<section class="content">
  @include('layouts.message')
  @if ($cekpejabat > 3)
  @else
  <div class="box box-primary" data-select2-id="16">
    <div class="box-header with-border">
      <h3 class="box-title">Setting Atasan Unit :</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <form action="{{ route('pejabat.simpan') }}" method="POST">
      @csrf
      <div class="box-body" data-select2-id="15">
        <div class="row">
          <div class="col-md-6">
            <label>Nama Lengkap :</label>
            <select name="data" class="form-control select2" required="">
              @foreach ($users as $user)
              <option value="{{ $user }}">{{ $user->name }}</option>
              @endforeach
            </select>
            @if ($errors->has('nip'))
            <div class="form-group has-error">
              <span class="help-block">Pegawai, wajib diisi !</span>
            </div>
            @endif
          </div>

          <div class="col-md-3">
            <label>Jabatan :</label>
            <select name="kode_jabatan" class="form-control select2" required="">
              @foreach ($jabatans as $jabatan)
              <option value="{{ $jabatan->kode_jabatan }}">{{ $jabatan->nama_jabatan }}</option>
              @endforeach
            </select>
            @if ($errors->has('kode_jabatan'))
            <div class="form-group has-error">
              <span class="help-block">Jabatan, wajib diisi !</span>
            </div>
            @endif
          </div>
        </div>
      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>  
  @endif

  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title"><b>Data Pejabat</b></h3>
        </div>

        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped table-condensed mb-none">
            <thead style="background-color:#33CCFF; color:#696969;">
              <tr>
                <th width="50px">
                  <center>No</center>
                </th>
                <th>
                  <center>NIP</center>
                </th>
                <th>
                  <center>Nama</center>
                </th>
                <th>
                  <center>Email</center>
                </th>
                <th>
                  <center>Opsi</center>
                </th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($pejabats as $a)
              <tr>
                <td>
                  <center>{{ $no++ }}</center>
                </td>
                <td>{{$a->nip}}</td>
                <td>{{$a->nama_atasan}}</td>
                <td>{{$a->jabatan->nama_jabatan}}</td>
                <td>
                  <center>
                    <a href="{{ route('pejabat.delete', base64_encode($a->id)) }}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> NonAktifkan</a>
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
</section>

@endsection