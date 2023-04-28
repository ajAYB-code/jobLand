
@extends('layout.layout')

@section('pageStyle')
<link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')

@include('partials._hero')

<main>
    <div class="container mt-5 pt-5">

        @php
        $jobsCount = count($jobs);
        @endphp

        <h6 class="mb-3"><span style="color: var(--color-primary);">{{$jobsCount}}</span> {{$jobsCount > 1 ? 'jobs' : 'job'}} found</h6>
        <div class="row">
            <div class="col-3">

                <!-- Filters -->

                <div class="filters-container pt-3 pe-4 sticky-top">
                    <h5 class="mb-4">Filter jobs</h5>
                    <form action="/">
                    <div class="search-container mb-2">
                            <div class="input-group">
                                <input class="form-control" type="text" name="search_for"  value="{{request()->search_for}}" id="" placeholder="Company, skills, tag">
                                <button class="btn btn-primary">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        
                    </div>
                    <div>
                       <button type="button" id="collapseToggleBtn" class="btn px-0" data-bs-toggle="collapse" data-bs-target="#specialtyCollapse">
                        <span>Employment type</span>
                        <i class="ms-2 fa fa-chevron-down"></i>
                       </button>
                       <ul class="collapse-menu list-unstyled collapse" id="specialtyCollapse">
                        <li>
                            <input type="checkbox" value="full-time" {{in_array('full-time', request()->employment_type ?? []) ? 'checked' : ''}} name="employment_type[]" id="">
                            <label for="">Full time</label>
                        </li>
                        <li>
                            <input type="checkbox" value="remote" {{in_array('remote', request()->employment_type ?? []) ? 'checked' : ''}} name="employment_type[]" id="">
                            <label for="">Remote</label>
                        </li>
                        <li>
                            <input type="checkbox" value="partial" {{in_array('partial', request()->employment_type ?? []) ? 'checked' : ''}} name="employment_type[]" id="">
                            <label for="">Partial</label>
                        </li>
                       </ul>
                    </div>
                        </form>
                </div>
            </div>

            <div class="col-9">


            {{-- Jobs table --}}
            
        <table id="jobsTable" class="table table-borderless">

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

            </div>
        </div>
    </div>
</main>

@endsection