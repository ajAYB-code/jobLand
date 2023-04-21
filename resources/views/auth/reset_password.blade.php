

@extends('layout.auth_layout')

@section('pageHead')
{{--  --}}
@endsection

@section('navbar')
<x-auth.navbar>
    <x-slot name='navbarRight'>
        <h6>Not a member yet, <a href="/signup">Signup</a></h6>
    </x-slot>
</x-auth.navbar>
@endsection

@section('main')
<div class="login-form-container container pt-5">
    <form action="" class="form mt-5 pt-5" method="POST">
        @csrf
        <h4 class="form-header mb-3">Create new password</h4>
        @if($errors->any())
        <p style="color: red;">{{ $errors->all()[0] }}</p>
        @endif
        <div class="form-floating mb-4">
            <input class="form-control" type="password" name="password" id="password" placeholder="password">
            <label for="password">Password</label>
        </div>
        <div class="form-floating mb-4">
            <input class="form-control" type="password" name="password_confirmation" id="confPassword" placeholder="Repeat password">
            <label for="confPassword">Repeat password</label>
        </div>
        <x-primary-button>
            <x-slot name="content">
                Change password
            </x-slot>
        </x-primary-button>
    </form>
</div>
@endsection

@section('pageScript')
{{--  --}}
@endsection