@if (session('success'))
  <div class="row">
    <div class="col-xs-12">
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('success') }}
      </div>
    </div>
  </div>
  @endif

  @if (session('error'))
  <div class="row">
    <div class="col-xs-12">
      <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('error') }}
      </div>
    </div>
  </div>
  @endif

  @if (session('warning'))
  <div class="row">
    <div class="col-xs-12">
      <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('warning') }}
      </div>
    </div>
  </div>
  @endif

  @if (session('any'))
  <div class="row">
    <div class="col-xs-12">
      <div class="alert alert-warning">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ session('any') }}
      </div>
    </div>
  </div>
  @endif