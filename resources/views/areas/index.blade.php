@extends('layouts.app')
@section('content')
<div class="columns">
    <div class="column is-8 is-offset-2">
    {!!  Html::decode(link_to_route('area.create', '<i class="fa fa-plus-circle"></i>&nbsp;&nbsp;create area', array(), ['class' => 'button is-primary is-pulled-right m-b-sm'])) !!}
        <table class="table is-fullwidth">
            <thead>
                <th>ID</th>
                <th>Area Name</th>
                <th>Division</th>
                <th>Province</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($areas as $area)
                <tr>
                    <td>{{$area->id}}</td>
                    <td>{{$area->area_name}}</td>
                    <td>{{$area->division->division_name}}</td>
                    <td>{{$area->province->province_name}}</td>
                    <td>
                        <div class="field has-addons">
                            <p class="control">
                                <a href="/area/edit/{{$area->id}}" class="button is-link is-small">
                                    <span class="icon is-small">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </span>
                                    <span>Edit</span>
                                </a>
                            </p>
                            <p class="control">
                                {!! Form::open(['method' => 'DELETE','route' => ['area.destroy', $area->id],'onsubmit' => 'return confirm("Do you really want to delete this area?");']) !!}
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