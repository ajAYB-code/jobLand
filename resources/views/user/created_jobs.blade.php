


@extends('layout.layout')

@section('pageStyle')
    
@endsection

@section('content')

<main class="mt-5 min-h-100">
    <div class="container">
        <h4>My jobs</h4>
        <p class="mb-5">Here you find the list of the created jobs</p>

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
                        <a id="" class="editJob btn btn-success" href="{{ route('job.edit', ['jobId' => $job->id]) }}" data-job-id="{{ $job->id }}">
                            <i class="fa fa-edit"></i>
                        </a>            
                        <button id="" class="deleteJob btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteJobModal" data-job-id="{{ $job->id }}">
                            <i class="fa fa-trash"></i>
                        </button>            
                    </x-slot>
                </x-jobs-table-row>
                @endforeach
            </tbody>
        </table>
        @else
        <h4 class="mt-5 pt-5 text-center" style="color: var(--color-primary-dark);">You didn't create any job yet!</h4>
        @endif

           

        <x-modal id="deleteJobModal">

            
            <x-slot name='header'>
                <h6 class="modal-title">Delete this job</h6>
            </x-slot>
        
 
            <x-slot name='body'>
                <p>Are you sure you wan to delete this job ?</p>
            </x-slot>
        
            
            <x-slot name='footer'>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-primary agreeDeleteJob" data-bs-dismiss="modal">Yes, Delete</button>
            </x-slot>
        
        </x-modal>

    </div>
</main>

@endsection