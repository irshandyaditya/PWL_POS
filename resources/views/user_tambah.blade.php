{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah User</title>
</head>
<body>
    <h1>Form Tambah Data User</h1>
    <form action="/user/tambah_simpan" method="POST">
    
        {{ csrf_field() }}

        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan Username">
        <br>
        <label>Nama</label>
        <input type="text" name="nama" placeholder="Masukkan Nama">
        <br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan Password">
        <br>
        <label>Level ID</label>
        <input type="number" name="level_id" placeholder="Masukkan ID Level">
        <br><br>
        <input type="submit" class="btn btn-success" value="Simpan">

    </form>
</body>
</html> --}}

@extends('adminlte::page')
@section('content_header')
<h1>Tambah User</h1>
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
              <label>Username</label>
              <input type="text" class="form-control" name="username" placeholder="Enter Username ...">
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
              <!-- text input -->
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" placeholder="Enter Nama ...">
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-7">
              <!-- text input -->
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="pass" placeholder="Enter password ...">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-7">
              <!-- select -->
              <div class="form-group">
                <label>Pilih Level</label>
                <select class="custom-select" name="level">
                  @foreach ($data as $u)
                    <option value="{{ $u->level_jd }}">{{ $u->level_nama }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-7">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
      </form>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@stop
@section('js')
<script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop