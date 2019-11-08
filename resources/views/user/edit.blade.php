@extends('layouts.masterappfixed')
@section('content')

	<br/>
  <div class="container">
		<div class="col-md-6" align="center">
      @if (session('success'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             {{ session('success') }}
          </div>
        @endif

            @if($errors->any())
              <div class="alert alert-danger">
                <strong>Whoops</strong>Data Gagal di Update
                <ul>
                  @foreach($errors as $error)
                  <li>{{$error}}</li>
                  @endforeach
                </ul>
              </div>
            @endif
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><b>Form Update Data Pegawai</b></h3>
            </div>
            <div class="box-body" align="center">
              <form action="{{url('userupdate', $user->id)}}" method="POST">
                {{csrf_field()}}
                  <div class="row">
                    <div class="col-md-12">

                      <div class="form-group row">
                            <label for="nip" class="col-md-3 col-form-label text-md-right">{{ __('NIP') }}</label>

                            <div class="col-md-8">
                                <input id="nip" type="text" class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" name="nip" value="{{$user->nip}}" required autofocus>

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
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$user->name}}" required autofocus>

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
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
	                  	</div>

                      <div class="form-group row">
                            <label for="nip_atasan" class="col-md-3 col-form-label text-md-right">{{ __('NIP Atasan') }}</label>

                            <div class="col-md-8">
                                <input id="nip_atasan" type="text" class="form-control{{ $errors->has('nip_atasan') ? ' is-invalid' : '' }}" name="nip_atasan" value="{{ $user->nip_atasan }}" required>

                                @if ($errors->has('nip_atasan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nip_atasan') }}</strong>
                                    </span>
                                @endif
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
                                <button type="submit" class="btn btn-warning">
                                    {{ __('Update') }}
                                </button>
                                <a href="{{ route('user.index')}}" class="btn btn-primary">
                                    {{ __('Kembali') }}
                                </a>
                            </div>
                      </div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      <div>
@endsection