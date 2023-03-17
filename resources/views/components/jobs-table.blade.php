
@aware(['jobs', 'icon', 'modalId', 'actionButtonClass'])

<table {{$attributes}}>

    {{ $table_header }}

    @foreach($jobs as $job)
       <tr data-href = "/jobs/{{$job->id}}">
           <td class="px-4">
              <div class="d-flex align-items-center">
               <div class="company-logo me-2">

                {{-- Company log image base on the 'getCompanyLogo' accessor  --}}
                {{-- If it exists display it else display deafutl logo image --}}

                   <img src="{{$job->companyLogo}}" height="30px" alt="">
               </div>
               <div>
                   <h5 class="job-role">{{$job->title}}</h5>
                   <p class="company-name mb-0">{{$job->companyName}}</p>
               </div>
              </div> 
           </td>
           <td class="px-4">

               {{-- Job keyowrds --}}

               <div class="keywords d-flex align-items-start justify-content-start gap-1 flex-wrap">
                   @foreach($job->tags as $tag)
                   <a href="/?tag={{$tag}}" class="keyword">{{$tag}}</a>
                   @endforeach
               </div>
           </td>
           <td class="px-4">
               <p class="location mb-0">
                   {{$job->location}}
               </p>
           </td>
           <td class="px-4">
               <p class="job-post-date mb-0">{{$job->created_at->diffForHumans()}}</p>
           </td>
           <td class="px-4">
               <div class="action">

               {{-- Action button --}}
               @if($icon == 'star')
                   <x-table-action-button :icon="$icon" data-job-id='{{$job->id}}' class="btn favoriteJobBtn {{$job->isFavorited ? 'active' : ''}}" />
               @else
                    <x-table-action-button :icon="$icon" data-job-id='{{$job->id}}' class="btn {{$actionButtonClass}}" data-bs-toggle="modal" data-bs-target="#{{$modalId}}" />
               @endif

               {{-- User id --}}
               <input type="hidden" name="userId" value="{{Auth::check() ? Auth::user()->id : '-1'}}">
                   
               </div>
           </td>
       </tr>
       @endforeach

</table>