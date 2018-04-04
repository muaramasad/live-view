@extends('layouts.app')
@section('content')
@if(Request::route()->getName() != 'homepage')
{{ Breadcrumbs::render('home') }}
@endif
<div class="columns is-multiline">
    @forelse($divisions as $division)
    <div class="column is-one-quarter">
        <a href="/dashboard/division/{{$division->id}}">
        <div class="card is-shadowless">
            <div class="card-image">
                <figure class="image is-4by3">

                    <img src="{{asset('storage/thumbnails/'.basename($division->icon_path))}}" alt="Placeholder image">
                    <div class="is-overlay ">
                        <p class="p-l-sm  p-b-sm title is-size-5 has-text-white has-text-centered is-bottom">{{$division->division_name}}</p>
                        <p class="subtitle p-l-sm  p-b-sm is-size-6 has-text-white has-text-centered is-bottom is-capitalized">{{$division->category}}</p>
                    </div>
                </figure>
            </div>
        </div>
        </a>
    </div>
    @empty
    @endforelse
</div>
@endsection