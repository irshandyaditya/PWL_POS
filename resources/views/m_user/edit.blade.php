@extends('m_user/template')
@section('content')
<div class="row mt-5 mb-5">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Edit User</h2>
        </div>
        <div class="float-right">
            <a href="btn btn-secondary" href="{{ route('m_user.index') }}"> Kembali </a>
        </div>
    </div>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Ops!</strong> Error <br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('m_user.update') }}" method="POST">
@csrf
@method('PUT')
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>User_id:</strong>
            <input type="text" name="user_id" value="{{ $useri->user_id }}" class="form-control" placeholder="Masukkan User id">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Level_id:</strong>
            <input type="text" name="level_id" value="{{ $useri->level_id }}" class="form-control" placeholder="Masukkan Level">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Username:</strong>
            <input type="text" name="username" value="{{ $useri->username }}" class="form-control" placeholder="Masukkan Username">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nama:</strong>
            <input type="text" name="nama" value="{{ $useri->nama }}" class="form-control" placeholder="Masukkan Nama">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password:</strong>
            <input type="password" name="password" value="{{ $useri->password }}" class="form-control" placeholder="Masukkan password">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>
</form>
@endsection