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
              <h3 class="box-title"><b>Form Data Pegawai</b></h3>
            </div>
            <div class="box-body" align="center">
              <form action="{{ route('user.store')}}" method="POST">
                {{csrf_field()}}
                  <div class="row">
                    <div class="col-md-12">

                      <div class="form-group row">
                            <label for="nip" class="col-md-3 col-form-label text-md-right">{{ __('NIP') }}</label>

                            <div class="col-md-8">
                                <input id="nip" type="text" class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" name="nip" value="{{ old('nip') }}" required autofocus>

                                @if ($errors->has('nip'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nip') }}</strong>
                                    </span>
                                @endif
                            </div>
                      </div>

	                    <div class="form-group row">
	                        <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Nama') }}</label>

                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
	                 	  </div>

                      <div class="form-group row">
	                        <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-8">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
	                  	</div>

	                  	<div class="form-group row">
	                        <label for="email" class="col-md-3 col-form-label text-md-right">{{ __('UPBJJ') }}</label>

                            <div class="col-md-8">
                                <select name="kode_upbjj" class="form-control select2";" required="">
    			                  <option>--Pilih UPBJJ--</option>
    			                  <option value="24">Bandung</option>
    			                  <option value="">Serang</option>
    			                  <option value="">Jakarta</option>
    			                  <option value="23">Bogor</option>
    			                  <option value="41">Purwokerto</option>>
    			                </select>
                            </div>
	                  	</div>

                      <div class="form-group row">
                            <label for="nip_atasan" class="col-md-3 col-form-label text-md-right">{{ __('NIP Atasan') }}</label>

                            <div class="col-md-8">
                                <input id="nip_atasan" type="text" class="form-control{{ $errors->has('nip_atasan') ? ' is-invalid' : '' }}" name="nip_atasan" value="{{ old('nip_atasan') }}" required>

                                @if ($errors->has('nip_atasan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nip_atasan') }}</strong>
                                    </span>
                                @endif
                            </div>
                      </div>

                      <div class="form-group row">
                          <label for="group" class="col-md-3 col-form-label text-md-right">{{ __('Jabatan') }}</label>

                            <div class="col-md-8">
                                <select name="group" class="form-control select2";" required="">
                            <option value="7">User UPBJJ</option>
                            <option value="3">Operator</option>
                            <option value="8">Keuangan</option>
                            <option value="6">Arsiparis</option>
                            <option value="4">Manajer</option>
                            <option value="5">Direktur</option>
                            <option value="2">Admin</option>
                          </select>
                            </div>
                      </div>

	                  	<div class="form-group row">
	                      <label for="password" class="col-md-3 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
	                  	</div>
	                  	<div class="form-group row">
	                      <label for="password-confirm" class="col-md-3 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-8">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
	                  	</div>
	                  	<div class="form-group row mb-0">
                            <div class="col-md-11 offset-md-4" align="right">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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