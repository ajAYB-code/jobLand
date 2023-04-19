

@extends('layout.auth_layout')

@section('pageHead')
<link rel="stylesheet" href="{{asset('css/login.css')}}">
@endsection

@section('navbar')
<x-auth.navbar>
    <x-slot name='navbarRight'>
        <h6>Not a memeber yet, <a href="/signup">Signup</a></h6>
    </x-slot>
</x-auth.navbar>
@endsection

@section('main')
<div class="login-form-container container pt-5">
    <form action="" class="form" method="POST">
        @csrf
        <h3 class="form-header mb-5">Login</h3>
        @error('formError')
        <p style="color: red;">{{$message}}</p>
        @enderror
        <div class="form-floating mb-4">
            <input class="form-control" type="text" name="email" id="email" placeholder="email">
            <label for="email">Email</label>
            @error('email')
            <p style="color: red;">{{$message}}</p>
            @enderror
        </div>
        <div class="form-floating mb-4">
            <input class="form-control" type="password" name="password" id="password" placeholder="password">
            <label for="password">Password</label>
            @error('password')
            <p style="color: red;">{{$message}}</p>
            @enderror
        </div>
        <button class="login-btn btn btn-primary">Login</button>
    </form>
</div>
@endsection

@section('pageScript')
{{--  --}}
@endsection