<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="stylesheet" href="{{asset('css/email.css')}}">
    <link rel="stylesheet" href="{{asset('css/global.css')}}"> --}}
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h2 class="logo mb-3" style="color: var(--color-primary)">jobLand</h2>
        <p class="subline">Hello there!</p>
        <p>You have a new candidate for your offre <i>{{$jobTitle}}</i></p>
        <p><strong>candidate email: </strong>{{$userEmail}}</p>
        <h4>candidate cv is below in the attachments</h4>
    </div>
</body>
</html>