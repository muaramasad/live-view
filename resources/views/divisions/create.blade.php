@extends('layouts.app')
@section('content')
<div class="columns">
    <div class="column is-6 is-offset-3">
        {!! Form::open(['route' => 'division.store']) !!}
        <div class="field is-grouped-centered">
            <label class="label">Nama Divisi</label>
            <p class="control is-expanded">
                {!! Form::text('division_name', null ,['class' => 'input']) !!}
            </p>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">Submit</button>
            </div>
            <div class="control">
                <a href="{{route('division.index')}}" class="button is-text">Cancel</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection