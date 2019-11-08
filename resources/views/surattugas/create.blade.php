@extends('layouts.masterappfixed')
@section('content')

        @if (session('success'))
        <div class="col-sm-7">
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             {{ session('success') }}
          </div>
        </div>
        @endif

        @if (session('error'))
          <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            {{ session('error') }}
          </div>
        @endif

      @if(session('sukses'))
      <div class="alert alert-success alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <h4><i class="icon fa fa-check"></i> Berhasil</h4>
          {{session('sukses')}}
      </div>
      @endif
       
		    <section class="content">
          <h1>Create Surat Tugas
            <br/><i>Dalam tahap pengembangan</i>, Page is Comingsoon</h1>
        </section>
        
@endsection