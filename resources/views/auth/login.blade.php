<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
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
                    <h6>Not a memeber yet, <a href="/signup">Signup</a></h6>
                </div>
            </nav>
            
            <!-- Main -->

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
            </div>
           </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>