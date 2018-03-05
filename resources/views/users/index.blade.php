@extends('layouts.app')
@section('content')
<div class="columns">
    <div class="column is-8 is-offset-2">
    {!!  Html::decode(link_to_route('user.create', '<i class="fa fa-plus-circle"></i>&nbsp;&nbsp;add user', array(), ['class' => 'button is-primary is-pulled-right m-b-sm'])) !!}
        <table class="table is-fullwidth">
            <thead>
                <th>Full Name</th>
                <th>Email</th>
                <th>Division</th>
                <th>Area</th>
                <th>Site</th>
                <th>Role</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($users as $key => $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if(!empty($user->division))
                                @foreach($user->division as $division)
                                    <span class="tag is-dark">{{ $division->division_name }}</span>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if(!empty($user->area))
                                @foreach($user->area as $area)
                                    <span class="tag is-dark">{{ $area->area_name }}</span>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if(!empty($user->site))
                                @foreach($user->site as $site)
                                    <span class="tag is-dark">{{ $site->site_name }}</span>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @if(!empty($user->roles))
                                @foreach($user->roles as $role)
                                    <span class="tag is-dark">{{ $role->display_name }}</span>
                                @endforeach
                            @endif
                        </td>
                        <td>
                        <div class="field has-addons">
                            <p class="control">
                                <a href="/user/{{$user->id}}/edit/" class="button is-link is-small">
                                    <span class="icon is-small">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </span>
                                    <span>Edit</span>
                                </a>
                            </p>
                            <p class="control">
                                {!! Form::open(['method' => 'DELETE','route' => ['user.destroy', $user->id]]) !!}
                                <button type="submit" class="button is-danger is-small">
                                <span class="icon is-small">
                                    <i class="fa fa-trash-o"></i>
                                </span>
                                <span>Delete</span>
                                </button>
                                {!! Form::close() !!}
                            </p>
                        </div>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection