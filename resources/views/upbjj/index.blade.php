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
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"><b>Data UPBJJ</b></h3> &nbsp; &nbsp; &nbsp;
                  <a class="btn btn-sm btn-success" href="{{ route('upbjj.create')}}"><i class="fa fa-plus"></i>  Add UPBJJ</a>
                </div>
                
                  <div class="box-body">
                    <table id="example1" class="table table-bordered table-striped table-condensed mb-none">
                      <thead style="background-color:#33CCFF; color:#696969;">
                      <tr>
                        <th width="50px"><center>No</center></th>
                        <th><center>Kode UPBJJ</center></th>
                        <th><center>Nama</center></th>
                        <th><center>Alamat</center></th>
                        <th>No Telp</th>
                        <th><center>Opsi</center></th>
                      </tr>
                      </thead>
                      <tbody>
                      @php $no = 1; @endphp
                      @foreach($upbjj as $a)
                      <tr>
                        <td><center>{{ $no++ }}</center></td>
                        <td>{{$a->kode_upbjj}}</td>
                        <td>{{$a->nama_upbjj}}</td>
                        <td>{{$a->alamat}}</td>
                        <td>{{$a->no_telp}}</td>
                        <td>
                          <center>
                            <a href="/UpbjjUpdatedX/{{encrypt($a->kode_upbjj)}}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit </a>

                            <!-- <form action="{{ route('upbjj.destroy', $a->kode_upbjj)}}" method="POST">
                              
                              <a href="/UpbjjUpdatedX/{{encrypt($a->kode_upbjj)}}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit </a>
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button>
                            </form> -->
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