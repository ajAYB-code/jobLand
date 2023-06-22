
@extends('layout.layout')

@section('pageStyle')
<link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')

@include('partials._hero')

<main>
    <div class="container mt-5 pt-5">

        <h6 class="mb-3"><span id="jobsCount" style="color: var(--color-primary);">{{ $jobs->total() }}</span> {{ $jobs->total() > 1 ? 'jobs' : 'job'}} found</h6>
        <div class="row">
            <div class="col-3">

                <!-- Filters -->

                <div class="filters-container pt-3 pe-4 sticky-top">
                    <div class="mb-4 d-flex justify-content-between align-items-center">
                        <h5>Filter jobs</h5>
                        <a href="{{ route('home') }}" class="btn-link">clear filters</a>
                    </div>
                    <form id="filtersForm" action="{{ route('home') }}" method="GET">
                    <div class="search-container mb-2">
                            <div class="input-group">
                                <input class="form-control" type="text" name="search_for"  value="{{request()->search_for}}" id="" placeholder="Company, skills, tag">
                                <button class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        
                    </div>
                    <div>
                       <button type="button" id="specialtyCollapseToggleBtn" class="btn px-0 w-100 text-start d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#specialtyCollapse">
                        <span>Employment type</span>
                        <i class="fa fa-chevron-down"></i>
                       </button>
                       <ul class="collapse-menu list-unstyled show" id="specialtyCollapse">
                        <li class="form-check">
                            <input type="checkbox" class="form-check-input" value="full-time" {{in_array('full-time', request()->employment_type ?? []) ? 'checked' : ''}} name="employment_type[]" id="">
                            <label class="form-check-label" for="">Full time</label>
                        </li>
                        <li class="form-check">
                            <input type="checkbox" class="form-check-input" value="remote" {{in_array('remote', request()->employment_type ?? []) ? 'checked' : ''}} name="employment_type[]" id="">
                            <label for="">Remote</label>
                        </li>
                        <li class="form-check">
                            <input type="checkbox" class="form-check-input" value="partial" {{in_array('partial', request()->employment_type ?? []) ? 'checked' : ''}} name="employment_type[]" id="">
                            <label for="">Partial</label>
                        </li>
                       </ul>
                    </div>
                    <div>
                        <button type="button" id="postDateCollapseToggleBtn" class="btn px-0 w-100 text-start d-flex justify-content-between align-items-center" data-bs-toggle="collapse" data-bs-target="#postDateCollapse">
                         <span>Post date</span>
                         <i class="fa fa-chevron-down"></i>
                        </button>
                        <ul class="collapse-menu list-unstyled show" id="postDateCollapse">
                         <li class="form-check">
                             <input type="radio" class="form-check-input" value="all_date" checked name="post_date" id="">
                             <label class="form-check-label" for="">All date</label>
                         </li>
                         <li class="form-check">
                             <input type="radio" class="form-check-input" value="last_day" {{request()->post_date == 'last_day' ? 'checked' : ''}} name="post_date" id="">
                             <label class="form-check-label" for="">Last day</label>
                         </li>
                         <li class="form-check">
                             <input type="radio" class="form-check-input" value="last_week"  {{request()->post_date == 'last_week' ? 'checked' : ''}} name="post_date" id="">
                             <label for="">Last week</label>
                         </li>
                         <li class="form-check">
                             <input type="radio" class="form-check-input" value="last_month"  {{request()->post_date == 'last_month' ? 'checked' : ''}} name="post_date" id="">
                             <label for="">Last month</label>
                         </li>
                        </ul>
                     </div>
                     <button id="applyFiltersBtn" class="btn btn-sm btn-outline-primary" type="submit" style="display: none;">Apply filters</button>
                    </form>
                </div>
            </div>

            <div class="col-9">


            {{-- Jobs table --}}
            
        <table id="jobsTable" class="table table-borderless" data-next-jobs-page="2">

            <tbody>
            @foreach($jobs as $job)

                 <x-jobs-table-row :job="$job">
                    <x-slot name="actionButtons">
                        @auth
                        <button title="favorite" id="" class="favoriteJobBtn btn {{ $job->isFavorited ? 'active' : '' }}" data-user-id="{{ Auth::user()->id }}" data-job-id="{{ $job->id  }}">
                            <i class="fa fa-star"></i>
                        </button>
                        @else
                        <a class="btn" href="{{ route('login') }}">
                            <i class="fa fa-star"></i>                                
                        </a>
                        @endauth
                    </x-slot>
                 </x-jobs-table-row>

            @endforeach
            </tbody>
        </table>

        {{-- Auto load loading animation --}}

        <div class="text-center auto-load-jobs-animation py-3">
            <svg version="1.1" id="L6" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve">
                <rect fill="none" stroke="orange" stroke-width="4" x="25" y="25" width="50" height="50">
                <animateTransform
                    attributeName="transform"
                    dur="0.5s"
                    from="0 50 50"
                    to="180 50 50"
                    type="rotate"
                    id="strokeBox"
                    attributeType="XML"
                    begin="rectBox.end"/>
                </rect>
                <rect x="27" y="27" fill="orange" width="46" height="50">
                <animate
                    attributeName="height"
                    dur="1.3s"
                    attributeType="XML"
                    from="50" 
                    to="0"
                    id="rectBox" 
                    fill="freeze"
                    begin="0s;strokeBox.end"/>
                </rect>
            </svg>
        </div>

            </div>
        </div>
    </div>
</main>

@endsection