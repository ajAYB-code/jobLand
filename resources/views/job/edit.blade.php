
@extends('layout.layout')

@section('pageStyle')
{{--  --}}
@endsection

@section('content')

<main class="mt-5">
    <div class="container">
        <h4 class="text-capitalize mb-4">Edit job</h4>
        <form class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-2">
                <div class="col">
                    <div class="form-group">
                        <label for="">Job title</label>
                        <input type="text" name="title" value="{{old('title') ?? $job->title}}" id="" class="form-control" placeholder="Java developer..">
                        @error('title')
                            <p class="input-error">{{$message}}</p>
                        @enderror
                      </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="">Company name</label>
                        <input type="text" name="companyName" value="{{old('companyName') ?? $job->companyName}}" id="" class="form-control" placeholder="">
                        @error('companyName')
                        <p class="input-error">{{$message}}</p>
                        @enderror
                      </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <div class="form-group">
                        <label for="">Company email</label>
                        <input type="text" name="companyEmail" value="{{old('companyEmail') ?? $job->companyEmail}}" id="" class="form-control" placeholder="Java developer..">
                        @error('companyEmail')
                        <p class="input-error">{{$message}}</p>
                        @enderror
                    </div>
                    <p class="mb-0" style="font-size: 14px; color: grey;">This is the email where the request will be sent</p>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="">Empolyment type</label>
                        <select name="employmentType" id="" class="form-control">
                            <option value="full-time" @if(old('employmentType') ?? $job->employmentType == 'full-time') {{'selected'}} @endif>Full time</option>
                            <option value="remote" @if(old('employmentType') ?? $job->employmentType == 'remote') {{'selected'}} @endif>Remote</option>
                            <option value="partial" @if(old('employmentType') ?? $job->employmentType == 'partial') {{'selected'}} @endif>Partial</option>
                        </select>
                      </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <div class="form-group">
                        <label for="">Salary(By year in $)</label>
                        <input type="number" name="salary" value="{{old('salary') ?? $job->salary }}" id="" class="form-control" placeholder="eg: 80 000">
                    </div>
                    <p class="mb-0" style="font-size: 14px; color: grey;">Optional*</p>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="">Company logo</label>
                        <input type="file" name="companyLogo" id="" class="form-control">
                    </div>
                     @error('companyLogo')
                     <p class="input-error">{{$message}}</p>
                     @else
                     <p class="input-info">Optional*</p>
                     @enderror
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-6">
                  <div class="form-group">
                    <label for="">Tags</label>
                      <input type="text" name="tags" value="{{ old('tags') ?? implode(',', $job->tags) }}" id="" class="form-control" placeholder="eg: web developement, api, java">
                      @error('tags')
                     <p class="input-error">{{$message}}</p>
                     @else
                     <p class="input-info">Use relevant max 3 comma seperated tags to rank your job</p>
                     @enderror
                  </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                      <label for="">Location</label>
                        <input type="text" name="location" value="{{old('location') ?? $job->location }}" id="" class="form-control" placeholder="eg: france">
                        @error('location')
                       <p class="input-error">{{$message}}</p>
                       @enderror
                    </div>
                  </div>
            </div>
            <div class="row mb-4">
                <div class="col">
                    <div class="form-group">
                        <label for="">Job description</label>
                        <textarea class="form-control" name="jobDescription" id="" cols="30" rows="10">{{old('jobDescription') ?? $job->jobDescription }}</textarea>
                        @error('jobDescription')
                           <p class="input-error">{{$message}}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="action-btns">
                <button class="btn btn-secondary">Reset</button>
                <button class="btn" style="background-color: var(--color-primary); color: white;">Update job</button>
            </div>
        </form>
    </div>
</main>

@endsection