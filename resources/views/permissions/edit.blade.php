@extends('layouts.app')
@section('content')
<div class="columns">
    <div class="column is-8 is-offset-2">
        {!! Form::open(['route' => ['permission.editStore',$permission->id],'method' => 'put']) !!}
        <div class="field is-grouped-centered">
            <label class="label">Permission Name</label>
            <p class="control is-expanded">
                {!! Form::text('name', $permission->name ,['class' => 'input']) !!}
            </p>
        </div>
        <div class="field">
            <label class="label">Display Name</label>
            <div class="control">
                {!! Form::text('display_name', $permission->display_name ,['class' => 'input']) !!}
            </div>
        </div>
        <div class="field">
            <label class="label">Description</label>
            <div class="control">
                {!! Form::text('description', $permission->description ,['class' => 'input']) !!}
            </div>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">Submit</button>
            </div>
            <div class="control">
                <a href="{{route('permission.index')}}" class="button is-text">Cancel</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection