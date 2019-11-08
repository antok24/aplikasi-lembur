@extends('layouts.masterappfixed')
@section('content')

	<br/>
		<div class="col-md-6" align="center">
      @if (session('success'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             {{ session('success') }}
          </div>
        @endif

            @if($errors->any())
              <div class="alert alert-danger">
                <strong>Whoops</strong>Data Gagal di Simpan
                <ul>
                  @foreach($errors as $error)
                  <li>{{$error}}</li>
                  @endforeach
                </ul>
              </div>
            @endif
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Form Master UPBJJ</b></h3>
            </div>
            <div class="box-body" align="center">
              <form action="{{ route('upbjj.store')}}" method="POST">
                {{csrf_field()}}
                  <div class="row">
                    <div class="col-md-12">

                      <div class="form-group row">
                            <label for="kode_upbjj" class="col-md-3 col-form-label text-md-right">{{ __('Kode UPBJJ') }}</label>

                            <div class="col-md-8">
                                <input id="kode_upbjj" type="text" class="form-control{{ $errors->has('kode_upbjj') ? ' is-invalid' : '' }}" name="kode_upbjj" value="{{ old('kode_upbjj') }}" required autofocus>

                                @if ($errors->has('kode_upbjj'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('kode_upbjj') }}</strong>
                                    </span>
                                @endif
                            </div>
                      </div>

	                    <div class="form-group row">
	                        <label for="nama_upbjj" class="col-md-3 col-form-label text-md-right">{{ __('Nama UPBJJ') }}</label>

                            <div class="col-md-8">
                                <input id="nama_upbjj" type="text" class="form-control{{ $errors->has('nama_upbjj') ? ' is-invalid' : '' }}" name="nama_upbjj" value="{{ old('nama_upbjj') }}" required>

                                @if ($errors->has('nama_upbjj'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nama_upbjj') }}</strong>
                                    </span>
                                @endif
                            </div>
	                 	  </div>

                      <div class="form-group row">
                            <label for="alamat" class="col-md-3 col-form-label text-md-right">{{ __('Alamat') }}</label>

                            <div class="col-md-8">
                                <input id="alamat" type="text" class="form-control{{ $errors->has('alamat') ? ' is-invalid' : '' }}" name="alamat" value="{{ old('alamat') }}" required>

                                @if ($errors->has('alamat'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
                            </div>
                      </div>

                      <div class="form-group row">
                            <label for="no_telp" class="col-md-3 col-form-label text-md-right">{{ __('Nomor Telepon') }}</label>

                            <div class="col-md-8">
                                <input id="no_telp" type="text" class="form-control{{ $errors->has('no_telp') ? ' is-invalid' : '' }}" name="no_telp" value="{{ old('no_telp') }}" required>

                                @if ($errors->has('no_telp'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('no_telp') }}</strong>
                                    </span>
                                @endif
                            </div>
                      </div>
	                  	<div class="form-group row mb-0">
                            <div class="col-md-11 offset-md-4" align="right">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Simpan') }}
                                </button>
                            </div>
                        </div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
@endsection