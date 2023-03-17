<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/signup.css')}}">
    <link rel="stylesheet" href="{{asset('css/global.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row h-100">

           <x-auth.left-image-wrapper/>

           <div class="col">
            <div class="container-lg">
            <!-- Navbar -->

            <nav class="navbar">
                <a href="/" class="navbar-brand">
                    <h4>jobLand</h4>
                </a>
                <div class="navbar-end">
                    <h6>Already a memeber, <a href="/login">Login</a></h6>
                </div>
            </nav>
            
            <!-- Main -->

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
            </div>
           </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>