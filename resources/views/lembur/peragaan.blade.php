@extends('layouts.masterappfixed')
@section('content')

		<br/>
		<div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Peragaan Data Lembur Per UPBJJ</h3>
            </div>
            <form action="{{url('/peragaan-lembur1')}}" method="POST" role="upbjjX">              
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
	                <div class="form-group">
	                <div class="col-xs-4">
	                  <label>Pilih Bulan</label>
	                  <select name="kode_upbjj" class="form-control" style="width: 100%;">
                        <option></option>
          			        <option value="1">Januari</option>
          			        <option value="2">Februari</option>
          			        <option value="3">Maret</option>
          			        <option value="4">April</option>
          			        <option value="5">Mei</option>
          			        <option value="6">Juni</option>
          			        <option value="7">Juli</option>
          			        <option value="8">Agustus</option>
          			        <option value="9">September</option>
          			        <option value="10">Oktober</option>
          			        <option value="11">November</option>
          			        <option value="12">Desember</option>
          			    </select>
	                </div>
	                </div>
	                <label></label>
    				<span class="input-group-btn">
                        <button type="submit" class="btn btn-lg btn-info">Cari Data Lembur</button>
                    </span>
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
                  <h3 class="box-title"><b>Rekap Data Lembur</b></h3>
                </div>
                  <div class="box-body">
                    <table id="example" class="table table-bordered table-striped">
                      <thead style="background-color:#33CCFF; color:#696969;">
                      <tr>
                        <th><center>No</center></th>
                        <th><center>Nama</center></th>
                        <th><center>NIP</center></th>
                        <th width="50px"><center>TGL Lembur</center></th>
                        <th width="50px"><center>Jam Masuk</center></th>
                        <th width="50px"><center>Jam Pulang</center></th>
                        <th>Total</th>
                        <th>Nama Kegiatan</th>
                        <th>Uraian Kegiatan</th>
                        <th><center>Volume</center></th>
                        <th width="50px"><center>Satuan</center></th>
                        <th><center>Status</center></th>
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
                        <td>
                          <center>
                              <a class="btn btn-xs btn-success" >{{$a->status}}</a>
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
        @elseif(isset($message))
        <p>{{ $message }}</p>
      @endif
@endsection