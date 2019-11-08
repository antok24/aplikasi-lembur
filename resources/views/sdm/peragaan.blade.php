@extends('layouts.masterappfixed')

@section('content')

  <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="/adminlte/img/user2-160x160.jpg" alt="User profile picture">

              <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

              <p class="text-muted text-center">{{Auth::user()->nip}}</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>NIP</b> <a class="pull-right">{{Auth::user()->nip}}</a>
                </li>
                <li class="list-group-item">
                  <b>Email</b> <a class="pull-right">{{Auth::user()->email}}</a>
                </li>
                
              </ul>

              <a href="#" class="btn btn-primary btn-block"><b>Universitas Terbuka Bandung</b></a>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Riwayat Pendidikan</a></li>
              <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Riwayat Pekerjaan</a></li>
              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Riwayat Pengembangan SDM</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="activity">
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-orange">
                          Riwayat Pendidikan {{Auth::user()->name}}
                        </span>
                  </li>
                  <li>
                    <i class="fa fa-graduation-cap bg-blue"></i>
                    <div class="timeline-item">
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-condensed mb-none">
                          <thead style="background-color:#33CCFF; color:#696969;">
                          <tr>
                            <th><center>No</center></th>
                            <th><center>Pendidikan</center></th>
                            <th><center>Tahun</center></th>
                          </tr>
                          </thead>
                          @php $no = 1; @endphp
                          @foreach($pendidikan as $result)
                          <tbody>
                            <tr>
                              <td><center>{{$no++}}</center></td>
                              <td>{{$result->pendidikan}}</td>
                              <td><center>{{$result->tahun}}</center></td>
                            </tr>
                          </tbody>
                          @endforeach
                        </table>
                    </div>
                </div>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-blue">
                          Riwayat Pekerjaan {{Auth::user()->name}}
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-cubes bg-green"></i>

                    <div class="timeline-item">
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-condensed mb-none">
                          <thead style="background-color:#33CCFF; color:#696969;">
                          <tr>
                            <th><center>No</center></th>
                            <th><center>Unit Kerja</center></th>
                            <th><center>Tahun</center></th>
                          </tr>
                          </thead>
                          @php $no = 1; @endphp
                          @foreach($pekerjaan as $a)
                          <tbody>
                            <tr>
                              <td><center>{{$no++}}</center></td>
                              <td>{{$a->unit_kerja}}</td>
                              <td><center>{{$a->waktu}}</center></td>
                            </tr>
                          </tbody>
                          @endforeach
                        </table>
                    </div>
                </div>
                  </li>
                </ul>
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
                <ul class="timeline timeline-inverse">
                  <!-- timeline time label -->
                  <li class="time-label">
                        <span class="bg-green">
                          Riwayat Pengembangan SDM {{Auth::user()->name}}
                        </span>
                  </li>
                  <!-- /.timeline-label -->
                  <!-- timeline item -->
                  <li>
                    <i class="fa fa-graduation-cap bg-orange"></i>
                    <div class="timeline-item">
                    <div class="box-body">
                        <table class="table table-bordered table-striped table-condensed mb-none">
                          <thead style="background-color:#33CCFF; color:#696969;">
                          <tr>
                            <th><center>No</center></th>
                            <th><center>Nama Kegiatan</center></th>
                            <th><center>Pelatih</center></th>
                            <th><center>Tahun</center></th>
                          </tr>
                          </thead>
                          @php $no = 1; @endphp
                          @foreach($sdm as $b)
                          <tbody>
                            <tr>
                              <td><center>{{$no++}}</center></td>
                              <td>{{$b->nama_kegiatan}}</td>
                              <td>{{$b->pelatih}}</td>
                              <td><center>{{$b->waktu}}</center></td>
                            </tr>
                          </tbody>
                          @endforeach
                        </table>
                    </div>
                </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12">
          <a href="{{url('sdm/cetak')}}" class="btn btn-primary btn-block"><i class="fa fa-print"></i> Cetak Data Riwayat Pengembangan Kompetensi SDM </a>
        </div>
        </div>
      </div>
    </section>

@endsection