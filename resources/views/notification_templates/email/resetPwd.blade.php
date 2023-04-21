<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="css/global.css"> --}}

    <style>

        .color-primary{
            color: rgb(252, 165, 5);
        }
        .background-primary{
            background-color: rgb(252, 165, 5) !important;
        }

    </style>
</head>

<body>
    <div class="mb-5">
        <a href="{{ route('home') }}" class="navbar-brand color-primary fs-5">Jobland</a>
    </div>
    <p class="fs-6 fst-italic">Hello there,</p>
    <p class="fs-6">This is your link for resetting your password</p>
    <a href="{{ $resetUrl }}" class="btn text-white background-primary btn-small">Reset password</a>
</body>
</html>