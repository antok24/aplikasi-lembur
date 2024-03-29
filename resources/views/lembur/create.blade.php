@extends('layouts.masterappfixed')

@section('content')

<section class="content">
  
  @include('layouts.message')

  @php
    $kegiatans = \App\SuratTugasDetail::where('nip',Auth::user()->nip)->where('status',
    0)->with('surattugas')->get();
  @endphp

  @if (isset($lembur))
  <div class="row">
    <div class="col-md-12">
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Form Edit Laporan Lembur</h3>
        </div>
        <div class="box-body">
          <form action="{{ route('lembur.update', $lembur->id)}}" method="POST">
            @method('PUT')
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="col-md-12">
                    <label>Nama Lengkap | NIP:</label>
                    <input type="text" name="nama_pegawai" class="form-control"
                      value="{{ Auth::user()->name}} | {{ Auth::user()->nip}}" readonly="">
                  </div>
                </div>
                <div class="form-group text-primary">
                  <div class="col-md-12">
                    <label>Tanggal | Nama Kegiatan :</label>
                    <input type="text" name="data" class="form-control"
                      value="{{ $lembur->surattugasdetail->tanggal_kegiatan }} | {{ $lembur->surattugasdetail->surattugas->nama_kegiatan }}" readonly="">
                  </div>
                </div>
                <div class="col-md-4">
                  <label>Jam Masuk :*</label>
                  <input type="text" name="masuk" value="{{ $lembur->masuk }}" id="timeOfCall" class="form-control" placeholder="00:00" required="">
                  <script src="/js/jquery.min.js"></script>
                  <script src="/js/jquery.maskedinput.js"></script>
                  <script>
                    jQuery(function($){
                        $("#timeOfCall").mask("99:99");
                        $("#timeOfResponse").mask("99:99");
                    });
                  </script>
                </div>
                <div class="col-md-4">
                  <label>Jam Pulang :*</label>
                  <input type="text" name="pulang" value="{{ $lembur->pulang }}" id="timeOfResponse" maxlength="5" class="form-control"
                    placeholder="00:00" required="">
                </div>
                <div class="col-md-4">
                  <label>Total :*</label>
                  <input type="text" name="totaljam" value="{{ $lembur->totaljam }}" id="delay" class="form-control" readonly="">
                </div>

                <div class="col-md-6">
                  <label>Volume :*</label>
                  <script>
                    function hanyaAngka(evt) {
                      var charCode = (evt.which) ? evt.which : event.keyCode
                        if (charCode > 31 && (charCode < 48 || charCode > 57))
                  
                        return false;
                      return true;
                    }
                  </script>
                  <input type="text" name="volume" value="{{ $lembur->volume }}" maxlength="4" class="form-control"
                    onkeypress="return hanyaAngka(event)" placeholder="Hanya Angka" required="">
                </div>
                <div class="col-md-6">
                  <label>Satuan :*</label>
                  <select name="satuan" class="form-control select2" required="">
                    <option value="{{ $lembur->satuan }}">{{ $lembur->satuan }}</option>
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
              </div>
              <div class="col-md-6">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Uraian Kegiatan :*</label>
                    <textarea rows="10" cols="80" name="uraian_kegiatan" class="form-control"
                      required>{{ $lembur->uraian_kegiatan }}</textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <button type="submit" class="btn btn-warning center">Update</button>&nbsp;
                  <a href="{{ route('lembur.editshow')}}" class="btn btn-primary"><b>Kembali</b></a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @elseif($kegiatans->count() > 0)
  <div class="row">
    <div class="col-md-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Buat Laporan Lembur Anda</h3>
        </div>
        <div class="box-body">
          <form action="{{ route('lembur.store')}}" method="POST">
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="col-md-12">
                    <label>Nama Lengkap | NIP:</label>
                    <input type="text" name="namapegawai" class="form-control"
                      value="{{ Auth::user()->name}} | {{ Auth::user()->nip}}" readonly="">
                  </div>
                </div>
                <div class="form-group text-primary">
                  <div class="col-md-12">
                    <label>Tanggal | Nama Kegiatan | Nomor Surat :</label>
                    <select name="data" class="form-control select2" required="">
                      @foreach ($kegiatans as $kegiatan)
                      <option value="{{ $kegiatan }}">{{ $kegiatan->tanggal_kegiatan }} |
                        {{ $kegiatan->surattugas->nama_kegiatan }} | {{ $kegiatan->surattugas->nomor_surat_tugas }}
                      </option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
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
                <div class="col-md-4">
                  <label>Jam Pulang :*</label>
                  <input type="text" name="pulang" id="timeOfResponse" maxlength="5" class="form-control"
                    placeholder="00:00" required="">
                </div>
                <div class="col-md-4">
                  <label>Total :*</label>
                  <input type="text" name="totaljam" id="delay" class="form-control" readonly="">
                </div>

                <div class="col-md-6">
                  <label>Volume :*</label>
                  <script>
                    function hanyaAngka(evt) {
                      var charCode = (evt.which) ? evt.which : event.keyCode
                        if (charCode > 31 && (charCode < 48 || charCode > 57))
                  
                        return false;
                      return true;
                    }
                  </script>
                  <input type="text" name="volume" maxlength="4" class="form-control"
                    onkeypress="return hanyaAngka(event)" placeholder="Hanya Angka" required="">
                </div>
                <div class="col-md-6">
                  <label>Satuan :*</label>
                  <select name="satuan" class="form-control select2" required="">
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
              </div>
              <div class="col-md-6">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Uraian Kegiatan :*</label>
                    <textarea name="uraian_kegiatan" class="form-control" required></textarea>
                  </div>
                </div>
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary center">Simpan</button>&nbsp;
                  <a href="{{ route('lembur.editshow')}}" class="btn btn-warning"><b>Laporan Belum Di Validasi</b></a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @else
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-warning">
        <h3><strong>Okay</strong> Saat ini Anda belum memiliki surat tugas lembur, atau jika anda sudah melakukan pekerjaan lembur silahkan laporkan ke bagian persuratan.
        </h3>
      </div>
    </div>
  </div>
  @endif
</section>
@endsection

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

@section('scripts')
  <script>
    CKEDITOR.replace( 'uraian_kegiatan', {
      uiColor: '#CCEAEE',
    });
  </script>
@endsection