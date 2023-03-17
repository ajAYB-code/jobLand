
@extends('layout.layout')

@section('pageStyle')
<link rel="stylesheet" href="{{asset('css/job.css')}}">
@endsection

@section('content')

<main class="mt-5 pt-3">
    <div class="container">
        <div class="row job-container">
            <div class="col-2">
                <div class="company border-1 p-2">
                    <div class="logo">
                        <img src="{{$job->companyLogo}}" alt="" style="height: 100%;">
                    </div>
                    <h5 class="text-center text-truncate">{{$job->companyName}}</h5>
                </div>
            </div>
            <div class="col-12">
               <div class="job-content py-4">
                  <h3 class="job-title text-truncate">{{$job->title}}</h3>
                    <div class="job-details d-flex gap-3 mb-4">
                        <div>
                            <strong>Employment type: </strong>
                            <span>{{$job->employmentType}}</span>
                        </div>
                        <div class="">
                            <strong>Salary: </strong>
                            <span>{{$job->salaryFormatted}}</span>
                        </div>
                    </div>
                    <div class="job-description">
                        <h5 class="mb-2">Description</h5>
                        <p class="description">{{$job->jobDescription}}</p>
                    </div>
                    <a id="applyToJobBtn" class="btn" {{!Auth::check() ? "href=/jobs/$job->id/apply" : 'data-bs-toggle=modal'}} data-bs-target='#uploadCvModal'>Apply to this job</a>
               </div>
            </div>
        </div>
    </div>
</main>

@php
$modalId = 'uploadCvModal';
@endphp

{{-- Modal --}}

<x-modal :id="$modalId">

    {{-- Header --}}
    <x-slot name='header'>
        <h6 class="modal-title">send your CV</h6>
    </x-slot>

    {{-- Body --}}
    <x-slot name='body'>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <p class="">Your CV will be sent as an email to the recruiting company email address</p>
            <input class="form-control" type="file" name="cvFile" id="">
            <p class="input-error"></p>
        </form>
    </x-slot>

    {{-- Footer --}}
    <x-slot name='footer'>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Quit</button>
        <button class="btn btn-primary sendCvBtn" data-job-id="{{$job->id}}">Send CV</button>
    </x-slot>

</x-modal>

@endsection