@extends('layouts.masterappfixed')
@section('content')
@include('layouts.message')
       
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
                        <th><center>Kode UPBJJ</center></th>
                        <th><center>Nama</center></th>
                        <th><center>Alamat</center></th>
                        <th>No Telp</th>
                        <th><center>Opsi</center></th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($upbjj as $a)
                      <tr>
                        <td>{{$a->kode_upbjj}}</td>
                        <td>{{$a->nama_upbjj}}</td>
                        <td>{{$a->alamat}}</td>
                        <td>{{$a->no_telp}}</td>
                        <td>
                          <center>
                            <a href="{{ route('upbjj.edit',base64_encode($a->id)) }}" class="btn btn-xs btn-primary"><i class="fa fa-edit"></i> Edit </a>
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