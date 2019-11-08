@extends('layouts.masterappfixed')

@section('content')


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script>
  $(document).ready(function(){
  $("input").keyup(function(){
      var timeOfCall = $('#timeOfCall').val(),
          timeOfResponse = $('#timeOfResponse').val(),
       hours = timeOfResponse.split(':')[0] - timeOfCall.split(':')[0] ,
          minutes = timeOfResponse.split(':')[1] - timeOfCall.split(':')[1];
      
      if (timeOfCall <= "12:00:00" && timeOfResponse >= "13:00:00"){
        a = 0;
      } else {
        a = 0;
      }
      minutes = minutes.toString().length<2?'0'+minutes:minutes;
      if(minutes<0){ 
          hours--;
          minutes = 60 + minutes;        
      }
      hours = hours.toString().length<2?'0'+hours:hours;
     
      $('#delay').val(hours-a+ " jam");
  });
  });
  </script>

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
		    	<strong>Whoops</strong> Data Gagal di Simpan, Semua Kolom harus diisi
		    	<ul>
		    		@foreach($errors as $error)
		    		<li>{{$error}}</li>
		    		@endforeach
		    	</ul>
		    </div>
		</div>
	    @endif
  <br/>
   <!-- @if(Auth::user()->group == '1' || Auth::user()->group == '4' || Auth::user()->group == '5')
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-purple">
            <div class="inner">
              <h3>150</h3>

              <p>Data Tervalidasi</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>

              <p>Data Lembur Masuk per Periode</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Data Lembur yang Harus Anda Validasi</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>User yang sedang Aktif</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
    @endif --> 

		<div class="col-md-10">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Input Lembur Anda disini</h3>
            </div>
            <div class="box-body">
              <form action="{{ route('lembur.store')}}" method="POST">
                {{csrf_field()}}
                  <div class="row">
                    <div class="col-md-10">
	                    <div class="form-group">
	                      <div class="col-xs-12">
	                        <label>Nama Staff :*</label>
	                        <input type="text" name="namapegawai" class="form-control" value="{{ Auth::user()->name}}" readonly="">
	                      </div>
	                 	</div>
                      <div class="form-group">
	                      <div class="col-xs-9">
	                        <label>NIP :*</label>
	                        <input type="text" name="nip" class="form-control" value="{{ Auth::user()->nip}}" readonly="">
                        </div>
	                    </div>                      
                      <div class="col-xs-4">
                        <label>Jam Masuk :*</label>
                        	<input type="text" name="masuk" id="timeOfCall" class="form-control" placeholder="00:00" required="">
                          <script src="/js/jquery.min.js"></script>
                          <script src="/js/jquery.maskedinput.js"></script>
                          <script>
                              jQuery(function($){
                                  $("#timeOfCall").mask("99:99");
                                  $("#timeOfResponse").mask("99:99");
                              });
                          </script>
                      </div>
                      <div class="col-xs-4">
                        <label>Jam Pulang :*</label>
                        	<input type="text" name="pulang" id="timeOfResponse" maxlength="5" class="form-control" placeholder="00:00" required="">
                      </div>
                      <div class="col-xs-4">
                        <label>Total :*</label>
                          <input type="text" name="totaljam" id="delay" class="form-control" readonly="">
                      </div>
                      <div class="col-xs-9">
                        <label>Tgl Lembur :*<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Diisi Tanggal Kegiatan (wajib diisi)"></i></label>  
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                              </div>
                                <input type="text" name="tgl_lembur" class="form-control" id="tanggal" required="">
                          </div>
                      </div>
                      <div class="col-xs-12">
                        <label> Nama kegiatan:*</label>
                          <input type="text" name="kegiatan" class="form-control" required="">
                      </div>
                      <div class="col-xs-6">
                        <label>Volume :*</label>
                        <script>
                          function hanyaAngka(evt) {
                            var charCode = (evt.which) ? evt.which : event.keyCode
                             if (charCode > 31 && (charCode < 48 || charCode > 57))
                       
                              return false;
                            return true;
                          }
                        </script>
                        	<input type="text" name="volume" maxlength="4" class="form-control" onkeypress="return hanyaAngka(event)" placeholder="Hanya Angka" required="">
                      </div>
                      <div class="col-xs-6">
                          <label>Satuan :*</label>
                          <select name="satuan" class="form-control select2" style="width: 100%;" required="">
                            <option></option>
                            <option value="Mahasiswa">Mahasiswa</option>
                            <option value="Kelas">Kelas</option>
                            <option value="Ruang">Ruang</option>
                            <option value="Data">Data</option>
                            <option value="Laporan">Laporan</option>
                            <option value="Ijazah">Ijazah</option>
                            <option value="SPP">SPP</option>
                            <option value="Nominatif">Nominatif</option>
                            <option value="BJU">BJU</option>
                            <option value="PKP">PKP</option>
                            <option value="Tutor">Tutor</option>
                            <option value="Peserta">Peserta</option>
                            <option value="Kegiatan">Kegiatan</option>
                            <option value="Materi">Materi</option>
                            <option value="Pemeriksa">Pemeriksa</option>
                          </select>
                        </div>
                    
                    <input type="hidden" name="status" value="0">
                    <input type="hidden" name="nip_atasan" value="{{ Auth::user()->nip_atasan}}">
                    <input type="hidden" name="kode_upbjj" value="{{ Auth::user()->kode_upbjj}}">
                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                    <div class="col-xs-12">                      
                      <div class="form-group">
                        <label>Uraian Kegiatan :*</label>
                        <textarea rows="2" cols="80" name="uraiankegiatan" maxlength="225" class="form-control" required>Harus diisi</textarea>
                      </div>
                    </div>
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-lg btn-primary center">Simpan</button>&nbsp;
                        <a href="{{ url('/EditLembur')}}" class="btn btn-warning btn-lg"><b>Klik Untuk EDIT / DELETE</b></a>

                        <!-- <a href="{{ url('/ImportLembur')}}" class="btn btn-danger btn-lg"><b>Import Lembur</b></a> -->
                    </div>
                  </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      <div>
    </div>
@endsection