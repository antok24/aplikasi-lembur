@extends('layouts.masterappfixed')
@section('content')

        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"><b>Rekap Data Lembur Ter-Validasi</b></h3>
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
                              <a class="btn btn-xs btn-success" >{{$a->status_verifikasi}}</a>
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