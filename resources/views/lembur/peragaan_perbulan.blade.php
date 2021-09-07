@extends('layouts.masterappfixed')
@section('content')
<section class="content">

  @include('layouts.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Monitoring Data Lembur Berdasarkan Bulan</b></h3>
        </div>
        <form action="{{ route('lembur.peragaanlemburperbulan')}}" method="POST" role="cari">
        @csrf
          <div class="box-body">
            <div class="form-group has-success">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                      <select class="form-control select2" name="data" style="width: 100%;">
                          <option value="01">Januari</option>
                          <option value="02">Februari</option>
                          <option value="03">Maret</option>
                          <option value="04">April</option>
                          <option value="05">Mei</option>
                          <option value="06">Juni</option>
                          <option value="07">Juli</option>
                          <option value="08">Agustus</option>
                          <option value="09">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>
                      </select>
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="form-group">
                    <select class="form-control select2" name="tahun" style="width: 100%;">  
                    @foreach ($masa as $a)
                        <option value="{{ $a->masa }}">{{ $a->masa }}</option>
                    @endforeach
                    </select>
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="input-group input-group">
                      <span class="input-group-btn">
                          <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                              Tampilkan
                          </button>
                      </span>
                  </div>
              </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  @if(isset($datas))
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title"><b>Data Pegawai Lembur Berdasarkan Bulan</b></h3>
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
                    <center>Nomor Surat</center>
                  </th>
                  <th>
                    <center>Nama Kegiatan</center>
                  </th>
                  <th>
                    <center>Tanggal Kegiatan</center>
                  </th>
                  <th>
                    <center>Petugas</center>
                  </th>
                  <th>
                    <center>Status Laporan Lembur</center>
                  </th>
                  <th>
                    <center>Status Validasi Laporan</center>
                  </th>
                </tr>
              </thead>
              <tbody>
                @php $no = 1; @endphp
                @foreach($datas as $a)
                <tr>
                  <td>
                    <center>{{$no++}}</center>
                  </td>
                  <td>{{$a->nomor_surat_tugas}}</td>
                  <td>{{$a->nama_kegiatan}}</td>
                  <td>
                    <center>{{$a->tanggal_kegiatan}}</center>
                  </td>
                  <td>{{$a->name}}</td>
                  <td>
                    <center>
                        <span class="badge {{ $a->status == 1 ? 'bg-green' : 'bg-red' }}"> {{ $a->status == 1 ? 'Sudah dibuat' : 'Belum dibuat' }} </span>
                    </center>
                  </td>
                  <td>
                    <center>
                      <span class="badge {{ $a->status_validasi == 1 ? 'bg-green' : 'bg-red' }}"> {{ $a->status_validasi == 1 ? 'Tervalidasi' : 'Belum Divalidasi' }} </span>
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
</section>
@endsection