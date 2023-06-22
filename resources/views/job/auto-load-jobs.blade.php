

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