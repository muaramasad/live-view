@extends('layouts.app')
@section('content')
<div class="columns">
    <div class="column is-6 is-offset-3">
        {!! Form::open(['route' => 'area.store']) !!}
        <div class="field is-grouped-centered">
            <label class="label">Area Name</label>
            <p class="control is-expanded">
                {!! Form::text('area_name', null ,['class' => 'input']) !!}
            </p>
        </div>
        <div class="field is-grouped-centered">
            <label class="label">Division</label>
            <p class="control is-expanded">
                <div class="select is-fullwidth">
                    {!! Form::select('division_id', $divisions, null, ['placeholder' => 'Select Division...']); !!}
                </div>
            </p>
        </div>
        <div class="field is-grouped-centered">
            <label class="label">Province</label>
            <p class="control is-expanded">
                <div class="select is-fullwidth">
                    {!! Form::select('province_id', $provinces, null, ['placeholder' => 'Select Province...']); !!}
                </div>
            </p>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">Submit</button>
            </div>
            <div class="control">
                <a href="{{route('area.index')}}" class="button is-text">Cancel</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection