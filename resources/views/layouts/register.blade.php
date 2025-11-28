@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="row justify-content-center">

    <div class="col-xl-6 col-lg-8 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center mb-4">
                                <h1 class="h4 text-gray-900 mb-2 font-bold">{{ config('app.name') }}</h1>
                                <p class="mb-4">Daftar akun baru untuk mengakses sistem.</p>
                            </div>

                            <!-- Livewire Jetstream Register Form -->
                            @livewire('register-form')

                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('login') }}">Sudah punya akun? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
