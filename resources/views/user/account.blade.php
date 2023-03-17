
@extends('layout.layout')

@section('pageStyle')
<link rel="stylesheet" href="{{asset('css/account.css')}}">
@endsection

@section('content')

<main class="mt-5">
    <div class="container">
        <div class="account-container p-4">
            <h4 class="mb-4">Account</h4>
            <form action="" class="form w-50" method="POST">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group mb-2">
                            <label for="">First name</label>
                            <input type="text" name="firstName" id="" class="form-control" value="{{Auth::user()->firstName}}">
                            @error('firstName')
                            <p style="font-size: 13px;color:red;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group mb-2">
                            <label for="">Last name</label>
                            <input type="text" name="lastName" id="" class="form-control" value="{{Auth::user()->lastName}}">
                            @error('lastName')
                            <p style="font-size: 13px;color:red;">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="">Email</label>
                    <input type="text" name="email" id="" class="form-control" value="{{Auth::user()->email}}">
                    @error('email')
                    <p style="font-size: 13px;color:red;">{{$message}}</p>
                    @enderror
                </div>
                <div class="action-btns">
                    <a href="/user/account" class="btn btn-secondary">Cancel</a>
                    <button class="btn" style="background-color: var(--color-primary); color: white;">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</main>


@endsection