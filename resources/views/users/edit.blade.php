@extends('layouts.app')
@section('content')
<div class="columns">
    <div class="column is-8 is-offset-2">
        {!! Form::open(['route' => ['user.update',$user->id],'method' => 'put']) !!}
        <div class="field is-grouped-centered">
            <label class="label">Full Name</label>
            <p class="control is-expanded">
                {!! Form::text('name', $user->name ,['class' => 'input']) !!}
            </p>
        </div>
        <div class="field is-grouped-centered">
            <label class="label">Email</label>
            <p class="control is-expanded">
                {!! Form::text('email', $user->email ,['class' => 'input']) !!}
            </p>
        </div>
        <div class="field is-grouped-centered">
            <label class="label">Division</label>
            @foreach($divisions as $division)
            <label class="checkbox">
                    <input type="checkbox" value="{{$division->id}}"
                                               {{in_array($division->id, $userDivisionArray) ? "checked" : null}} name="divisions[]">
                {{$division->division_name}}
            </label> &nbsp;&nbsp;
            @endforeach
        </div>
        <div class="field is-grouped-centered">
            <label class="label">Area</label>
            @foreach($areas as $area)
            <label class="checkbox">
                    <input type="checkbox" value="{{$area->id}}"
                                               {{in_array($area->id, $userAreaArray) ? "checked" : null}} name="areas[]">
                {{$area->area_name}}
            </label> &nbsp;&nbsp;
            @endforeach
        </div>
        <div class="field is-grouped-centered">
            <label class="label">Site</label>
            @foreach($sites as $site)
            <label class="checkbox">
                    <input type="checkbox" value="{{$site->id}}"
                                               {{in_array($site->id, $userSiteArray) ? "checked" : null}} name="sites[]">
                {{$site->site_name}}
            </label> &nbsp;&nbsp;
            @endforeach
        </div>
        <div class="field is-grouped-centered">
            <label class="label">Role</label>
            <p class="control is-expanded">
                <div class="select is-fullwidth">
                    {!! Form::select('role_id[]', $roles, $userRoles, ['placeholder' => '-- Select Role --']); !!}
                </div>
            </p>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">Submit</button>
            </div>
            <div class="control">
                <a href="{{route('user.index')}}" class="button is-text">Cancel</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection