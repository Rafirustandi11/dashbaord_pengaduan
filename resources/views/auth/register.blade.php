@extends('layouts.auth')

@section('content')
<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4 font-weight-bold">Buat Akun Baru</h1>
</div>

<form class="user" method="POST" action="{{ route('register') }}">
    @csrf
    <div class="form-group">
        <input type="text" name="name" class="form-control form-control-user" placeholder="Nama Lengkap" required autofocus>
    </div>
    <div class="form-group">
        <input type="email" name="email" class="form-control form-control-user" placeholder="Alamat Email" required>
    </div>
    <div class="form-group">
        <input type="password" name="password" class="form-control form-control-user" placeholder="Password" required>
    </div>
    <div class="form-group">
        <input type="password" name="password_confirmation" class="form-control form-control-user" placeholder="Ulangi Password" required>
    </div>
    <button type="submit" class="btn btn-primary btn-user btn-block">Daftar Akun</button>
</form>

<hr>
<div class="text-center">
    <a class="small" href="{{ route('login') }}">Sudah Punya Akun? Login!</a>
</div>
@endsection
