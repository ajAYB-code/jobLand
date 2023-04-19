

@extends('layout.auth_layout')

@section('pageHead')
<link rel="stylesheet" href="{{asset('css/signup.css')}}">
@endsection


@section('navbar')
<x-auth.navbar>
    <x-slot name='navbarRight'>
        <h6>Already a member, <a href="/login">Login</a></h6>
    </x-slot>
</x-auth.navbar>
@endsection

@section('main')
<div class="signup-form-container container pt-5">
    <form action="" class="form" method="POST">
        @csrf
        <h3 class="form-header mb-5">Signup</h3>
        <div class="row mb-4">
            <div class="col">
                <div class="form-floating">
                    <input class="form-control" value="{{old('firstName')}}" type="text" name="firstName" id="firstName" placeholder="firstName">
                    <label for="firstName">First name</label>
                </div>
                @error('firstName')
                    <p style="font-size: 14px;color: red;">{{$message}}</p>
                @enderror
            </div>
            <div class="col">
                <div class="form-floating">
                    <input class="form-control" value="{{old('lastName')}}" type="text" name="lastName" id="lastName" placeholder="lastName">
                    <label for="lastName">last name</label>
                </div>
                @error('lastName')
                 <p style="font-size: 14px;color: red;">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="row mb-4">
            <div class="col">
             <div class="form-floating">
                <input class="form-control" value="{{old('email')}}" type="text" name="email" id="email" placeholder="email">
                <label for="email">Email</label>
            </div>
            @error('email')
            <p class="mb-0" style="font-size: 14px;color: red;">{{$message}}</p>
            @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <div class="form-floating">
                    <input class="form-control" type="password" name="password" id="password" placeholder="password">
                    <label for="password">Password</label>
                </div>
                @error('password')
                 <p style="font-size: 14px;color: red;">{{$message}}</p>
                @enderror
            </div>
            <div class="col">
                <div class="form-floating">
                    <input class="form-control" type="password" name="password_confirmation" id="rePassword" placeholder="Repeat password">
                    <label for="rePassword">Repeat your password</label>
                </div>
            </div>
        </div>
        <button class="signup-btn btn btn-primary">Signup</button>
    </form>
</div>
@endsection

@section('pageScript')
{{--  --}}
@endsection