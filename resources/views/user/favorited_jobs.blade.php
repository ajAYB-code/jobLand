


@extends('layout.layout')

@section('pageStyle')
    
@endsection

@section('content')

<main class="mt-5 min-h-100">
    <div class="container">
        <h4>My favorited jobs</h4>
        <p class="mb-5">Here you find the list of your favorited jobs</p>


        {{-- Favorited jobs table --}}

        @if(count($jobs) > 0)
        <table class="table table-striped">
            <thead>
                    <tr>
                        <th>Company</th>
                        <th>Tags</th>
                        <th>Location</th>
                        <th>Added date</th>
                        <th>Action</th>
                    </tr>
            </thead>

            <tbody>
                @foreach($jobs as $job)
                <x-jobs-table-row :job="$job">
                    <x-slot name="actionButtons">
                        <button class="btn favoriteJobBtn active" data-user-id="{{ Auth::user()->id }}" data-job-id="{{ $job->id }}">
                            <i class="fa fa-star"></i>
                        </button>            
                    </x-slot>
                </x-jobs-table-row>
                @endforeach
            </tbody>
        </table>
        @else
        <h4 class="mt-5 pt-5 text-center" style="color: var(--color-primary-dark);">You didn't favorite any job yet!</h4>
        @endif

    </div>
</main>

@endsection