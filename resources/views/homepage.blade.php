@extends('layouts.app')
@section('content')
{{ Breadcrumbs::render('home') }}
<div class="columns">
  <div class="column is-6 is-offset-3">
    @foreach($divisions as $division)
    <div class="field is-grouped-centered">
        <p class="control is-expanded">
            <a class="button is-primary is-fullwidth is-large" href="/map/division/{{$division->id}}">
                {{$division->division_name}}
            </a>
        </p>
    </div>
    @endforeach
  </div>
</div>
@endsection