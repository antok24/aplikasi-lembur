@extends('layouts.masterappfixed')
@section('content')
<section class="content">

  @include('layouts.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Monitoring Data Lembur Berdasarkan Nomor Surat Tugas UPBJJ</b></h3>
        </div>
        <form action="{{ route('lembur.peragaanlembur')}}" method="POST" role="cari">
          @csrf
          <div class="box-body">
            <div class="form-group has-success">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <select class="form-control select2" name="data" style="width: 100%;">
                        @foreach ($surattugas as $data)
                          <option value="{{ $data->nomor_surat_tugas }}">{{ $data->nomor_surat_tugas }} | {{ $data->nama_kegiatan }}</option>
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
          <h3 class="box-title"><b>Data Pegawai Lembur Berdasarkan Nomor Surat Tugas</b></h3>
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