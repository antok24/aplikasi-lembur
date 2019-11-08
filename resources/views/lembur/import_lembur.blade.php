@extends('layouts.masterappfixed')
@section('content')
		<br/>
        <div class="container">
        <div class="row" style="padding-top: 30px">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ url('/ImportLemburX') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-success">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="form-group">
                                <h3>Silahkan Import Data lembur</h3>
                                <label for="">Hanya File (.xls, .xlsx)</label>
                                <input type="file" class="form-control" name="file">
                                <p class="text-danger">{{ $errors->first('file') }}</p>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-lg">Upload</button>
                            </div>
                        </form>
                        <!-- <a class="btn btn-danger btn-sm" href="{{('/delete')}}" onclick="return confirm('Apakah Anda yakin menghapus data ini ?')">Hapus Semua Data Peserta Seminar
                        </a> -->
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>
@endsection