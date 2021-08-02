@extends('layouts.masterappfixed')
@section('content')
<section class="content">
  @include('layouts.message')
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title"><b>Data Pegawai</b></h3> &nbsp; &nbsp; &nbsp;
          <a class="btn btn-sm btn-success" href="{{ route('user.create')}}"><i class="fa fa-plus"></i> Add Data
            Pegawai</a>
        </div>

        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped table-condensed mb-none">
            <thead style="background-color:#33CCFF; color:#696969;">
              <tr>
                <th width="50px">
                  <center>No</center>
                </th>
                <th>
                  <center>Nama</center>
                </th>
                <th>
                  <center>Email</center>
                </th>
                <th width="50px">
                  <center>UPBJJ</center>
                </th>
                <th>
                  <center>Opsi</center>
                </th>
              </tr>
            </thead>
            <tbody>
              @php $no = 1; @endphp
              @foreach($user as $a)
              <tr>
                <td>
                  <center>{{ $no++ }}</center>
                </td>
                <td>{{$a->name}}</td>
                <td>{{$a->email}}</td>
                <td>
                  <center>{{$a->kode_upbjj}}</center>
                </td>
                <td>
                  <center>
                    <form action="{{ route('user.destroy', $a->id)}}" method="POST">
                      @if(isset($a->id))
                      @if($a->id == '1' || $a->id == '2')
                      <a class="btn btn-xs btn-default"><i class="fa fa-key"></i>&nbsp;No Action</a>
                      @endif
                      @if($a->id != '1' && $a->id !='2')
                      <a href="/user/{{encrypt($a->id)}}/mXaD" class="btn btn-xs btn-primary"><i
                          class="fa fa-edit"></i>Edit</a>
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</button>
                      @endif
                      @endif
                    </form>
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