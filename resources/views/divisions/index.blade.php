@extends('layouts.app')
@section('content')
<div class="columns">
    <div class="column is-8 is-offset-2">
    {!!  Html::decode(link_to_route('division.create', '<i class="fa fa-plus-circle"></i>&nbsp;&nbsp;create division', array(), ['class' => 'button is-primary is-pulled-right m-b-sm'])) !!}
        <table class="table is-fullwidth">
            <thead>
                <th>ID</th>
                <th>Division Name</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($divisions as $division)
                <tr>
                    <td>{{$division->id}}</td>
                    <td>{{$division->division_name}}</td>
                    <td>
                        <div class="field has-addons">
                            <p class="control">
                                <a href="/division/edit/{{$division->id}}" class="button is-link is-small">
                                    <span class="icon is-small">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </span>
                                    <span>Edit</span>
                                </a>
                            </p>
                            <p class="control">
                                {!! Form::open(['method' => 'DELETE','route' => ['division.destroy', $division->id]]) !!}
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