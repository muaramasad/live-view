@extends('layouts.app')
@section('content')
<div class="columns">
    <div class="column is-10 is-offset-1">
    {!!  Html::decode(link_to_route('site.create', '<i class="fa fa-plus-circle"></i>&nbsp;&nbsp;create site', array(), ['class' => 'button is-primary is-pulled-right m-b-sm'])) !!}
        <table class="table is-fullwidth">
            <thead>
                <th>ID</th>
                <th>Site Name</th>
                <th>Division</th>
                <th>Area</th>
                <th>Number of CCTVs</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($sites as $site)
                <tr>
                    <td>{{$site->id}}</td>
                    <td>{!!  Html::decode(link_to_route('cam.listBySite', $site->site_name, array('id' => $site->id),['class' => 'is-link'])) !!}</td>
                    <td>{{$site->division->division_name}}</td>
                    <td>{{$site->area->area_name}}</td>
                    <td>{{$site->cam->count()}}</td>
                    <td>
                        <div class="field has-addons">
                            <p class="control">
                                <a href="/cctv/create/site/{{$site->id}}" class="button is-primary is-small">
                                    <span class="icon is-small">
                                        <i class="fa fa-plus"></i>
                                    </span>
                                    <span>Add CCTV</span>
                                </a>
                            </p>
                            <p class="control">
                                <a href="/site/edit/{{$site->id}}" class="button is-link is-small">
                                    <span class="icon is-small">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </span>
                                    <span>Edit</span>
                                </a>
                            </p>
                            <p class="control">
                                {!! Form::open(['method' => 'DELETE','route' => ['site.destroy', $site->id]]) !!}
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