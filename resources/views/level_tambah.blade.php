@extends('adminlte::page')
@section('content_header')
<h1>Tambah Level</h1>
@stop

@section('content')
<!-- general form elements disabled -->
<div class="card card-warning">
    <!-- /.card-header -->
    <div class="card-body">
      <form>
        <div class="row">
          <div class="col-sm-7">
            <!-- text input -->
            <div class="form-group">
              <label>Level Kode</label>
              <input type="text" class="form-control" name="level_kode" placeholder="Enter Kode Level ...">
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
              <!-- text input -->
              <div class="form-group">
                <label>Level Nama</label>
                <input type="text" class="form-control" name="level_nama" placeholder="Enter Nama Level ...">
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@stop
@section('js')
<script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop