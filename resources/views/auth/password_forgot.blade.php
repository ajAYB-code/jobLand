

@extends('layout.auth_layout')

@section('pageHead')
{{--  --}}
@endsection

@section('navbar')
<x-auth.navbar>
    <x-slot name='navbarRight'>
        <h6>Not a member yet, <a href="{{ route('signup') }}">Signup</a></h6>
    </x-slot>
</x-auth.navbar>
@endsection

@section('main')
<div class="login-form-container container pt-5">
    <form action="" class="form mt-5 pt-5" method="POST">
        @csrf
        <h4 class="form-header mb-3">Recover password</h4>
        <div class="form-floating mb-4">
            <input class="form-control" type="text" name="email" id="email" placeholder="email">
            <label for="email">Email</label>
            @if($errors->any())
            <p class="text-danger">{{$errors->all()[0]}}</p>
            @endif
            @if(null !== session('status'))
            <p class="text-success">{{ session('status') }}</p>                   
            @endif
        </div>
        <x-primary-button>
            <x-slot name="content">
                Reset password
            </x-slot>
        </x-primary-button>
    </form>
</div>
@endsection

@section('pageScript')
{{--  --}}
@endsection