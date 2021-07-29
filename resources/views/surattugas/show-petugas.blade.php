@extends('layouts.masterappfixed')

@section('content')

<section class="content">
    
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary" data-select2-id="16">
                <div class="box-header">
                    <p>
                        <a href="{{ route('surattugas.index') }}" class="btn btn-primary"> <<< Kembali</a>
                    </p>
                </div>
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
                        </tr>
                        @php
                        $no= 1;
                        @endphp
                        @foreach ($stdetail->sortBy('tanggal_kegiatan')->sortBy('name') as $a)
                        <tr>
                            <th>
                                <center>{{ $no++ }}</center>
                            </th>
                            <th>{{ $a->nip }}</th>
                            <th>{{ $a->user->name }}</th>
                            <th>
                                <center>{{ $a->tanggal_kegiatan }}</center>
                            </th>
                        </tr>
                        @endforeach
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

@endsection