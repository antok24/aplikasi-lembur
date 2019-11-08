@extends('layouts.masterappfixed')
@section('content')
		<br/>
      <div class="container">
        @if (session('success'))
        <div class="col-sm-10">
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             {{ session('success') }}
          </div>
        </div>
        @endif

    @if($errors->any())
    <div class="col-sm-10">
        <div class="alert alert-danger">
          <strong>Whoops</strong> Data Gagal di Hapus
          <ul>
            @foreach($errors as $error)
            <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
    </div>
      @endif
    </div>

		    <div class="col-md-8">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Rekap Data Lembur</b></h3>
            </div>
            <form action="{{url('/RagaValidasi/search')}}" method="POST" role="cari">              
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group has-success">
                  <label class="col-sm-2 control-label">Tangal Range</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="tgl_mulai" class="form-control" id="tanggal" required="">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" name="tgl_akhir" class="form-control" id="tanggal2" required="">
                  </div><br/>
                  <label class="col-sm-2 control-label">Status Data</label>
                  <div class="input-group">
                    <select name="cari" class="form-control select2" style="width: 100%;" required="">
                      <option>-- Pilih Salah Satu --</option>
                            <option value="1">Tervalidasi</option>
                            <option value="0">Belum Validasi</option>        
                    </select>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-info"><b>C a r i </b></button>
                    </span>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        @if(isset($result))
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"><b>Berikut data lembur anda yang siap di cetak</b></h3>
                </div>
                  <div class="box-body">
                  <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped table-condensed mb-none">
                      <thead style="background-color:#33CCFF; color:#696969;">
                      <tr>
                        <th><center>No</center></th>
                        <th><center>Nama</center></th>
                        <th><center>NIP</center></th>
                        <th width="50px"><center>TGL Lembur</center></th>
                        <th width="50px"><center>Jam Masuk</center></th>
                        <th width="50px"><center>Jam Pulang</center></th>
                        <th>Jam Lembur</th>
                        <th>Nama Kegiatan</th>
                        <th>Uraian Kegiatan</th>
                        <th><center>Volume</center></th>
                        <th width="50px"><center>Satuan</center></th>
                        <th><center>Status</center></th>
                        <th>Tgl Update</th>
                      </tr>
                      </thead>
                      <tbody>
                      @php $no = 1; @endphp
                      @foreach($result as $a)
                      <tr>
                        <td><center>{{$no++}}</center></td>
                        <td>{{$a->namapegawai}}</td>
                        <td>{{$a->nip}}</td>
                        <td width="50px"><center>{{$a->tgl_lembur}}</center></td>
                        <td width="50px"><center>{{$a->masuk}}</center></td>
                        <td width="50px"><center>{{$a->pulang}}</center></td>
                        <td>{{$a->totaljam}}</td>
                        <td>{{$a->kegiatan}}</td>
                        <td>{{$a->uraiankegiatan}}</td>
                        <td width="50px"><center>{{$a->volume}}</center></td>
                        <td>{{$a->satuan}}</td>
                        <td>{{$a->status}}</td>
                        <td>{{$a->updated_at}}</td>
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
        @elseif(isset($message))
        <p>{{ $message }}</p>
      @endif
@endsection