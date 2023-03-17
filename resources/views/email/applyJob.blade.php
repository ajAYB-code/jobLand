<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/email.css')}}">
    <link rel="stylesheet" href="{{asset('css/global.css')}}">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h2 class="logo mb-3" style="color: var(--color-primary)">jobLand</h2>
        <p>Hello there!</p>
        <p>My name is {{$fullName}}, I saw your job post on <i>jobLand</i> and i think that i'm suitable for this job</p>
        <p><strong>My email: </strong>{{$userEmail}}</p>
        <h4>My cv is below in the attachments</h4>
    </div>
</body>
</html>