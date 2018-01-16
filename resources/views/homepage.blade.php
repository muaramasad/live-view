@extends('layouts.app')
@section('content')
{{ Breadcrumbs::render('home') }}
<div class="columns">
  <div class="column is-4 is-offset-4">
    @foreach($divisions as $division)
    <div class="field is-grouped-centered">
        <p class="control is-expanded">
            <a class="button is-info is-fullwidth is-large" href="/map/division/{{$division->id}}">
                <span class="icon">
                @if($division->id == 1)
                <img src="{{asset('images/chicken.png')}}">
                @elseif($division->id == 2)
                <img src="{{asset('images/fish.png')}}">
                @elseif($division->id == 3)
                <img src="{{asset('images/cow.png')}}">
                @else
                <img src="{{asset('')}}">
                @endif
                </span>
                <strong>{{$division->division_name}}</strong>
            </a>
        </p>
    </div>
    @endforeach
  </div>
</div>
@endsection