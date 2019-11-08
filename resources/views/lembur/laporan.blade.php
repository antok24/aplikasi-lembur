@extends('layouts.masterappfixed')
@section('content')
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- konten modal-->
                <div class="modal-content">
                  <!-- heading modal -->
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Verifikasi Atasan</h4>
                  </div>
                  <!-- body modal -->
                  <div class="modal-body">
                    <p>Apakah anda yakin akan Validasi data ini ?</p>
                    <form action="{{ route('lembur.update', 'test')}}" method="POST">
                      {{method_field('patch')}}
                      {{csrf_field()}}
                          <input type="hidden" name="id" id="id">
                          <input type="hidden" name="namapegawai" id="myname">
                          <input type="hidden" name="nip" id="nip">
                          <input type="hidden" name="nip_atasan" id="nipatasan">
                          <input type="hidden" name="tgl_lembur" id="tgllembur">
                          <input type="hidden" name="masuk" id="masuk">
                          <input type="hidden" name="pulang" id="pulang">
                          <input type="hidden" name="kegiatan" id="kegiatan">
                          <input type="hidden" name="volume" id="volume">
                          <input type="hidden" name="satuan" id="satuan">
                          <input type="hidden" name="status" value="1">
                          <input type="hidden" name="kode_upbjj" value="{{ Auth::user()->kode_upbjj }}">
                          <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                          <input type="hidden" name="uraiankegiatan" id="uraiankegiatan">
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Verifikasi</button>
                            <button type="button" class="btn btn-inverse" data-dismiss="modal">Kembali</button>
                          </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

              @if (session('success'))
                  <div class="col-sm-11">
                    <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                       {{ session('success') }}
                    </div>
                  </div>
                  @endif

              @if($errors->any())
              <div class="col-sm-12">
                  <div class="alert alert-danger">
                    <strong>Whoops</strong>Data Gagal di Validasi
                    <ul>
                      @foreach($errors as $error)
                      <li>{{$error}}</li>
                      @endforeach
                    </ul>
                  </div>
              </div>
              @endif
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"><b>Data Lembur Belum di Validasi</b></h3>
                </div>
                  <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped">
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
                        <th><center>Opsi</center></th>
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
                              <button type="button" data-lemburid="{{$a->id}}" data-myname="{{$a->namapegawai}}" data-nip="{{$a->nip}}" data-nipatasan="{{$a->nip_atasan}}" data-tgllembur="{{$a->tgl_lembur}}" data-masuk="{{$a->masuk}}" data-pulang="{{$a->pulang}}" data-kegiatan="{{$a->kegiatan}}" data-uraiankegiatan="{{$a->uraiankegiatan}}" data-volume="{{$a->volume}}" data-satuan="{{$a->satuan}}" data-kodeupbjj="{{$a->kode_upbjj}}" data-userid="{{$a->user_id}}" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#myModal">Validasi Atasan</button>
                              <br/>&nbsp;
                              <button type="button" class="btn btn-danger btn-xs">Reject / Perbaiki</button>
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