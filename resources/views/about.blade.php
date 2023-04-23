
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

        <section class="contact mt-5 py-5">
            <div class="row">
                <div class="col">
                    <h4 class="section-leader mb-4">Contact us</h4>
                    <p class="fs-5">We love hear from our clients</p>
                </div>
                <div class="col">
                    <div class="contact-box p-4 shadow rounded-3">
                        <div class="alert-box"></div>
                        <form id="contactForm" class="needs-validation" action="" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control shadow-none" name="first_name" id="firstName" placeholder="First name">
                                        <label for="firstName">First name</label>
                                    </div>
                                    <div class="text-dark input-error" data-input="first_name"></div>
                                </div>
                                <div class="col-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control shadow-none" name="last_name" id="lastName" placeholder="Last name">
                                        <label for="lastName">Last name</label>
                                    </div>
                                    <div class="text-dark input-error" data-input="last_name"></div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control shadow-none" name="email" id="email" placeholder="Email">
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="text-dark input-error" data-input="email"></div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control shadow-none" name="subject" id="subject" placeholder="Subject">
                                        <label for="subject">Subject</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                   <textarea name="message" class="form-control shadow-none" id="" cols="30" rows="7" placeholder="Message"></textarea>
                                    <div class="text-dark input-error" data-input="message"></div>
                                </div>
                                <div class="col-12">
                                    <div class="position-relative" style="width: fit-content">
                                        <button id="contactUsBtn" type="button" class="btn btn-primary shadow-none">Send message</button>
                                        <div id="contactBtnLoader" class="loader position-absolute start-50 top-50 translate-middle d-none" title="0">
                                            <svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             width="30px" height="30px" viewBox="0 0 40 40" enable-background="new 0 0 40 40" xml:space="preserve">
                                            <path opacity="0.2" fill="#000" d="M20.201,5.169c-8.254,0-14.946,6.692-14.946,14.946c0,8.255,6.692,14.946,14.946,14.946
                                              s14.946-6.691,14.946-14.946C35.146,11.861,28.455,5.169,20.201,5.169z M20.201,31.749c-6.425,0-11.634-5.208-11.634-11.634
                                              c0-6.425,5.209-11.634,11.634-11.634c6.425,0,11.633,5.209,11.633,11.634C31.834,26.541,26.626,31.749,20.201,31.749z"/>
                                            <path fill="#000" d="M26.013,10.047l1.654-2.866c-2.198-1.272-4.743-2.012-7.466-2.012h0v3.312h0
                                              C22.32,8.481,24.301,9.057,26.013,10.047z">
                                              <animateTransform attributeType="xml"
                                                attributeName="transform"
                                                type="rotate"
                                                from="0 20 20"
                                                to="360 20 20"
                                                dur="0.5s"
                                                repeatCount="indefinite"/>
                                              </path>
                                            </svg>
                                          </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

@endsection