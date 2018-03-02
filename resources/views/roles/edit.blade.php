@extends('layouts.app')
@section('content')
<div class="columns">
    <div class="column is-8 is-offset-2">
        {!! Form::open(['route' => ['role.editStore',$role->id],'method' => 'put']) !!}
        <div class="field is-grouped-centered">
            <label class="label">Role Name</label>
            <p class="control is-expanded">
                {!! Form::text('name', $role->name ,['class' => 'input']) !!}
            </p>
        </div>
        <div class="field">
            <label class="label">Display Name</label>
            <div class="control">
                {!! Form::text('display_name', $role->display_name ,['class' => 'input']) !!}
            </div>
        </div>
        <div class="field">
            <label class="label">Description</label>
            <div class="control">
                {!! Form::text('description', $role->description ,['class' => 'input']) !!}
            </div>
        </div>
        <div class="field is-grouped-centered">
            <label class="label">Permissions</label>
            @foreach($permissions as $permission)
            <label class="checkbox">
                <input name=permissions[] type="checkbox" value="{{$permission->id}}">
                {{$permission->display_name}}
            </label> &nbsp;&nbsp;
            @endforeach
        </div>
        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">Submit</button>
            </div>
            <div class="control">
                <a href="{{route('role.index')}}" class="button is-text">Cancel</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection