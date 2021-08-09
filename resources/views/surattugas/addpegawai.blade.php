@extends('layouts.masterappfixed')

@section('content')

<section class="content">
    @include('layouts.message')
    <div class="row">
        <div class="col-md-3">
            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Surat Tugas Lembur</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i> Nomor Surat</strong>
                    <p class="text-muted">
                        {{ $st->nomor_surat_tugas }}
                    </p>
                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Nama Kegiatan</strong>
                    <p>
                        {{ $st->nama_kegiatan }}
                    </p>
                    <hr>
                    <strong><i class="fa fa-calendar margin-r-5"></i> Tanggal</strong>
                    <p>
                        {{ $st->tanggal_kegiatan }}
                    </p>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-9">
            <div class="box box-primary" data-select2-id="16">
                <div class="box-header with-border">
                    <h3 class="box-title">Tambahkan Pegawai yang bertugas</h3>

                    <div class="box-tools pull-right">
                        <a href="{{ route('surattugas.create') }}" class="btn btn-box-tool btn-default">
                            Kembali
                        </a>
                    </div>
                </div>
                <div class="box-body" data-select2-id="15">
                    <form action="{{ route('surattugas.simpanaddpegawai',$st->id)}}" method="POST">
                        @csrf
                        <div class="col-md-6">
                            <div class="form-group">
                                <select class="form-control select2" name="data" style="width: 100%;">
                                    @foreach ($pegawais as $pegawai)
                                    <option value="{{ $pegawai }}">{{ $pegawai->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <input type="date" class="form-control" name="tanggal_kegiatan">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="input-group input-group">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary btn-flat">
                                        Add Pegawai
                                    </button>
                                </span>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.box-header -->
                @if (isset($stdetail))
                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-hover">
                        <tr>
                            <th>
                                <center>No</center>
                            </th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>
                                <center>Tanggal</center>
                            </th>
                            <th>
                                <center>Opsi</center>
                            </th>
                        </tr>
                        @php
                        $no= 1;
                        @endphp
                        @foreach ($stdetail as $a)
                        <tr>
                            <th>
                                <center>{{ $no++ }}</center>
                            </th>
                            <th>{{ $a->nip }}</th>
                            <th>{{ $a->user->name }}</th>
                            <th>
                                <center>{{ $a->tanggal_kegiatan }}</center>
                            </th>
                            <th>
                                <center>
                                    <a href="{{ route('surattugas.deletepegawai',$a->id) }}"
                                        class="btn btn-danger btn-sm">Hapus</a>
                                </center>
                            </th>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @endif

                @if ($stdetail->isEmpty())
                @else
                <div class="box-footer">
                    <a href="{{ route('surattugas.updatestatusst',base64_encode($st->id)) }}"
                        class="btn btn-warning">Simpan Semua Petugas | Dan Siap Cetak Surat Tugas</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection