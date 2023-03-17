


@extends('layout.layout')

@section('pageStyle')
    
@endsection

@section('content')

<main class="mt-5 min-h-100">
    <div class="container">
        <h4>My favorited jobs</h4>
        <p class="mb-5">Here you find the list of your favorited jobs</p>

        {{-- Jobs table --}}
        @php
        $icon = 'trash';
        $actionButtonClass = "removeFavoritedJobBtn";
        $modalId = "removeFavoriteModal";
        @endphp
        <x-jobs-table :jobs="$jobs" :icon="$icon" :modalId="$modalId" :actionButtonClass="$actionButtonClass" class="table table-striped">
            <x-slot name='table_header'>
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Tags</th>
                        <th>Location</th>
                        <th>Added date</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </x-slot>
        </x-jobs-table>

    </div>
</main>

{{-- Modal --}}

<x-modal :id="$modalId">

    {{-- Header --}}
    <x-slot name='header'>
        <h6 class="modal-title">Unfavorite</h6>
    </x-slot>

    {{-- Body --}}
    <x-slot name='body'>
        <p>Are you sure you wan to remove this job from your favorites ?</p>
    </x-slot>

    {{-- Footer --}}
    <x-slot name='footer'>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-primary agreeRemoveFavorite" data-bs-dismiss="modal">Yes,remove</button>
    </x-slot>

</x-modal>

@endsection