  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/adminlte/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu" data-widget="tree">
        <li><a href="{{ route('lembur.create')}}"><i class="fa fa-file-text"></i> Form Lembur</a></li>
        <li><a href="{{ url('/EditLembur')}}"><i class="fa fa-edit"></i> Edit Data Lembur</a></li>
        <li><a href="{{ route('lembur.index')}}"><i class="fa fa-print"></i> Cetak Data Lembur Tervalidasi</a></li>
        <li><a href="{{url('RekapLembur')}}"><i class="fa fa-folder-open-o"></i> Rekap Data Lembur Anda</a></li>
      </ul>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i> <span>Riwayat Pengembangan SDM</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <li><a href="{{ route('study.form')}}">
                <i class="fa fa-circle-o"></i><span>Pendidikan</span>
              </a></li>
              <li><a href="{{ route('jobs.form')}}">
                <i class="fa fa-circle-o"></i><span>Pekerjaan</span>
              </a></li>
              <li><a href="{{ route('sdm.form')}}">
                <i class="fa fa-circle-o"></i><span>Pengembangan</span>
              </a></li>
              <li><a href="{{ route('sdm.peragaan')}}">
                <i class="fa fa-print"></i><span>Cetak Data SDM</span>
              </a></li>
            </li>
          </ul>
        </li>
      </ul>
      @if(isset(Auth::user()->group))
      @if(Auth::user()->group == '1' || Auth::user()->group == '4' || Auth::user()->group == '5')
      <ul class="sidebar-menu" data-widget="tree">
        <li>
          <a href="{{url('rekap-lembur-pegawai')}}"><i class="fa fa-bookmark-o"></i> Validasi Data Lembur
          <span class="pull-right-container">
            <small class="label pull-right bg-green"><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="center" title="Data yang belum anda Validasi"></i> 100</small>
          </span>
          </a>
        </li>
      </ul>      
        @endif
        @if(Auth::user()->group == '1' || Auth::user()->group == '2' || Auth::user()->group == '4' || Auth::user()->group == '5')
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope-o"></i> <span>Surat Tugas Lembur</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('surattugas.create')}}"><i class="fa fa-file-text"></i> Buat Surat Tugas Lembur</a></li>
          </ul>
        </li>
      </ul>
        @endif

      @if(Auth::user()->group == '1' || Auth::user()->group == '2' || Auth::user()->group == '6' || Auth::user()->group == '8' || Auth::user()->group == '4' || Auth::user()->group == '5') 
      <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
          <a href="#">
            <i class="fa fa-reorder"></i> <span>Laporan</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('peragaan-lembur-upbjj')}}"><i class="fa fa-book"></i> Laporan Data Lembur</a></li>
          </ul>
        </li>
      @endif
      @if(Auth::user()->group == '1' || Auth::user()->group == '2')
        <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i> <span>Master Data</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#">
                <i class="fa fa-circle-o"></i> <span>Master UPBJJ</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('upbjj.index')}}"><i class="fa fa-book"></i> Peragaan Data</a></li>
              </ul>
            </li>
            
            <li class="treeview">
              <a href="#">
                <i class="fa fa-circle-o"></i> <span>Data Pegawai</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{ route('user.index')}}"><i class="fa fa-book"></i> Peragaan Data</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-circle-o"></i> <span>Master Penyelesaian</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="{{url('MasterEditLembur')}}"><i class="fa fa-book"></i> Cari Data Lembur</a></li>
                <li><a href="{{url('RagaValidasi')}}"><i class="fa fa-book"></i> Data Belum di Validasi</a></li>
              </ul>
            </li>
          </ul>
        </li>
        @endif
      @endif
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>