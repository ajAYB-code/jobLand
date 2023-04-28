
@props(['job'])


<tr data-href = "/jobs/{{$job->id}}">

    {{-- Company logo, name | job title  --}}

       <td class="px-4">
          <div class="d-flex align-items-center">
           <div class="company-logo me-2">
               <img src="{{ asset('/storage' . $job->companyLogo) }}" height="30px" alt="">
           </div>
           <div>
               <h5 class="job-role">{{$job->title}}</h5>
               <p class="company-name mb-0">{{$job->companyName}}</p>
           </div>
          </div> 
       </td>

       {{-- Job keyowrds --}}

       <td class="px-4">
           <div class="keywords d-flex align-items-start justify-content-start gap-1 flex-wrap">
               @foreach($job->tags as $tag)
               <a href="/?tag={{$tag}}" class="keyword">{{$tag}}</a>
               @endforeach
           </div>
       </td>

       {{-- Location --}}

       <td class="px-4">
           <p class="location mb-0">
               {{$job->location}}
           </p>
       </td>

       {{-- added date --}}

       <td class="px-4">
           <p class="job-post-date mb-0">{{$job->created_at->diffForHumans()}}</p>
       </td>

       {{-- Table action buttons --}}
           
       <td class="px-4">
           <div class="action">

           {{ $actionButtons }}

           </div>
       </td>
   </tr>
