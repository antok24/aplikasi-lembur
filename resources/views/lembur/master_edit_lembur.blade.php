@extends('layouts.masterappfixed')

@section('content')

  <br/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script>
  $(document).ready(function(){
  $("input").keyup(function(){
      var timeOfCall = $('#timeOfCall').val(),
          timeOfResponse = $('#timeOfResponse').val(),
       hours = timeOfResponse.split(':')[0] - timeOfCall.split(':')[0],
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
      	<div class="col-md-10">
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             {{ session('success') }}
          </div>
      	</div>
        @endif

		@if($errors->any())
		<div class="col-md-10">
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

		<div class="col-md-10">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Update Data Lembur</h3>
            </div>
            <div class="box-body">
              <form action="{{url('LemburUpdate', $result->id)}}" method="POST">
                {{csrf_field()}}
                  <div class="row">
                    <div class="col-md-10">
	                    <div class="form-group">
	                      <div class="col-xs-12">
	                        <label>Nama Staff :*</label>
	                        <input type="text" name="namapegawai" class="form-control" value="{{ $result->namapegawai}}" readonly="">
	                      </div>
	                 	</div>
                      <div class="form-group">
	                      <div class="col-xs-9">
	                        <label>NIP :*</label>
	                        <input type="text" name="nip" class="form-control" value="{{ $result->nip}}" readonly="">
                        </div>
	                    </div>                      
                      <div class="col-xs-4">
                        <label>Jam Masuk :*</label>
                        	<input type="text" name="masuk" id="timeOfCall" class="form-control" value="{{ $result->masuk}}" required="">
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
                        	<input type="text" name="pulang" id="timeOfResponse" maxlength="5" class="form-control" value="{{ $result->pulang}}" required="">
                      </div>
                      <div class="col-xs-4">
                        <label>Total :*</label>
                          <input type="text" name="totaljam" id="delay" class="form-control" value="{{$result->totaljam}}" readonly="">
                      </div>
                      <div class="col-xs-9">
                        <label>Tgl Lembur :*</label>  
                          <div class="input-group">
                              <div class="input-group-addon">
                                  <i class="fa fa-calendar"></i>
                              </div>
                                <input type="text" name="tgl_lembur" class="form-control" id="tanggal" value="{{$result->tgl_lembur}}" required="">
                          </div>
                      </div>
                      <div class="col-xs-12">
                        <label> Nama kegiatan:*</label>
                          <input type="text" name="kegiatan" class="form-control" value="{{$result->kegiatan}}" required="">
                      </div>
                      <div class="col-xs-6">
                        <label>Volume :*</label>
                        	<input type="text" name="volume" maxlength="5" class="form-control" value="{{$result->volume}}" required="">
                      </div>
                      <div class="col-xs-6">
                          <label>Satuan :*</label>
                          <select name="satuan" class="form-control select2" style="width: 100%;" required="">
                            <option>{{$result->satuan}}</option>
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
                    <input type="hidden" name="status" value="{{$result->status}}">
                    <input type="hidden" name="nip_atasan" value="{{$result->nip_atasan}}">
                    <input type="hidden" name="kode_upbjj" value="{{$result->kode_upbjj}}">
                    <input type="hidden" name="user_id" value="{{$result->user_id}}">
                    <div class="col-xs-12">                      
                      <div class="form-group">
                        <label>Uraian Kegiatan :*</label>
                        <textarea rows="2" cols="80" name="uraiankegiatan" class="form-control" required>{{$result->uraiankegiatan}}</textarea>
                      </div>
                    </div>
                    <div class="col-xs-6">
                        <label>Status :*<i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="jika status 1 = tervalidasi, jika 0 = belum divalidasi"></i></label>
                          <input type="text" name="status" maxlength="5" class="form-control" value="{{$result->status}}" required="">
                    </div>
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-lg btn-warning center">Update</button>
                    </div>
                  </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      <div>
@endsection