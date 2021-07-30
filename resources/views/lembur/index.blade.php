@extends('layouts.masterappfixed')
@section('content')

<section class="content">

  @include('layouts.message')
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title"><b>Peragaan Data Lembur Tervalidasi</b></h3>
        </div>
        <form action="{{ route('lembur.tervalidasi')}}" method="POST" role="cari">
          {{csrf_field()}}
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
                  <input type="text" class="form-control" name="tahun" value="2021" readonly >
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="input-group input-group">
                      <span class="input-group-btn">
                          <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                              Cari
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
  @if(isset($result))
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title"><b>Berikut data lembur anda yang siap di cetak</b></h3>
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
                  <td>{{$a->uraian_kegiatan}}</td>
                  <td>
                    <center>{{$a->volume}}</center>
                  </td>
                  <td>{{$a->satuan}}</td>
                  <td>
                    <center>
                      <a target="_blank" href="/lembur/{{encrypt($a->id)}}/print" class="btn btn-success btn-xs">
                        <span class="glyphicon glyphicon-print"></span>&nbsp;Cetak</a>
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