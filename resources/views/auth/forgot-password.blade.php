@extends('layouts.auth')

@section('content')
<div class="text-center">
    <h1 class="h4 text-gray-900 mb-4">Lupa Password?</h1>
    <p class="mb-4">Masukkan email Anda, kami akan mengirim tautan reset password.</p>
</div>

<form class="user" method="POST" action="{{ route('password.email') }}">
    @csrf
    <div class="form-group">
        <input type="email" name="email" class="form-control form-control-user" placeholder="Masukkan Email..." required>
    </div>
    <button type="submit" class="btn btn-primary btn-user btn-block">Kirim Link Reset</button>
</form>

<hr>
<div class="text-center">
    <a class="small" href="{{ route('login') }}">Kembali ke Login</a>
</div>
@endsection
