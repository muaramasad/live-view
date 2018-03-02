@extends('layouts.app')
@section('content')
<div class="columns">
    <div class="column is-10 is-offset-1">
        <h3 class="is-size-4 is-pulled-left">{{$site->site_name}} CCTV</h3>
        <a href="/cctv/create/site/{{$site->id}}" class="button is-primary is-pulled-right m-b-sm">
            <span class="icon is-small">
                <i class="fa fa-plus"></i>
            </span>
            <span>Add CCTV</span>
        </a>
        <table class="table is-fullwidth">
            <thead>
                <th>CCTV Name</th>
                <th>IP Address</th>
                <th>Site</th>
                <th>Area</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($cams as $key => $cam)
                <tr>
                    <td>{{$cam->cam_name}}</td>
                    <td>{{$cam->cam_ip_address}}</td>
                    <td>{{$cam->site->site_name}}</td>
                    <td>{{$cam->site->area->area_name}}</td>
                    <td>
                        <div class="field has-addons">
                            <p class="control">
                                <a href="/cctv/edit/{{$cam->id}}/site/{{$cam->site->id}}" class="button is-link is-small">
                                    <span class="icon is-small">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </span>
                                    <span>Edit</span>
                                </a>
                            </p>
                            <p class="control">
                                {!! Form::open(['method' => 'DELETE','route' => ['cam.destroy', $cam->id]]) !!}
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
        {{ $cams->render() }}
    </div>
</div>
@endsection