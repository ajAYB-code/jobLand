
@extends('layout.layout')

@section('pageStyle')
<link rel="stylesheet" href="{{asset('css/about.css')}}">
@endsection

@section('content')

<main class="mt-5 pt-3 min-h-100">
    <div class="container">
        <section class="about-company">
          <h4 class="section-leader mb-4">About us</h4>
          <div class="row">
            <div class="col">
                <p class="about-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugit necessitatibus at aut expedita repellat enim minus, adipisci soluta inventore aperiam harum sequi odit, ullam veritatis magnam modi minima eveniet ea sunt quod rem eos facere laudantium sapiente. Quisquam, magnam necessitatibus.
                </p>
                <p class="about-text">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Fugit necessitatibus at aut expedita repellat enim minus, adipisci soluta inventore aperiam harum sequi odit, ullam veritatis magnam modi minima eveniet ea sunt quod rem eos facere laudantium sapiente. Quisquam, magnam necessitatibus.
                </p>
            </div>
            <div class="col px-5">
                <img class="company-image w-100" src="{{asset('images/company-image.png')}}" alt="">
            </div>
          </div>
        </section>

        <section class="team mt-5 pt-5">
            <h4 class="section-leader mb-4">Our team</h4>
            <div class="row">
                <div class="col team-member-card">
                    <img class="w-100 member-image" src="{{asset('images/team-member.jpg')}}" alt="">
                    <h6 class="full-name mt-3">Jack smith</h6>
                    <p class="role"><i>Full stack engineer</i></p>
                </div>
                <div class="col team-member-card">
                    <img class="w-100 member-image" src="{{asset('images/team-member2.jpg')}}" alt="">
                    <h6 class="full-name mt-3">Wil smith</h6>
                    <p class="role"><i>Content creator</i></p>
                </div>
                <div class="col team-member-card">
                    <img class="w-100 member-image" src="{{asset('images/team-member3.jpg')}}" alt="">
                    <h6 class="full-name mt-3">Sarah smith</h6>
                    <p class="role"><i>Marketing manager</i></p>
                </div>
            </div>
        </section>
    </div>
</main>

@endsection