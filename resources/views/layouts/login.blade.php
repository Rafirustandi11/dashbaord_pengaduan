@extends('layouts.auth') @section('title', 'Login') @section('content') <div class="row justify-content-center">
    <div class="col-xl-6 col-lg-8 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <h1 class="h4 text-gray-900 mb-2 font-bold">{{ config('app.name') }}</h1>
                                <p class="mb-4">Selamat datang! Silakan masuk untuk melanjutkan.</p>
                            </div> <!-- Livewire Jetstream Login Form --> @livewire('login-form')
                            <hr>
                            <div class="text-center"> <a class="small" href="{{ route('password.request') }}">Lupa
                                    Password?</a> </div>
                            <div class="text-center"> <a class="small" href="{{ route('register') }}">Buat Akun
                                    Baru!</a> </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> @endsection
