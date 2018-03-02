@extends('layouts.app')
@section('content')
<div class="columns">
    <div class="column is-10 is-offset-1">
    {!!  Html::decode(link_to_route('permission.create', '<i class="fa fa-plus-circle"></i>&nbsp;&nbsp;create permission', array(), ['class' => 'button is-primary is-pulled-right m-b-sm'])) !!}
    	<table class="table is-fullwidth">
    		<thead>
    			<th>Name</th>
    			<th>Display Name</th>
    			<th>Description </th>
    			<th>Action</th>
    		</thead>
    		<tbody>
    			@foreach($permissions as $permission)
    				<tr>
    					<td>{{$permission->name}}</td>
    					<td>{{$permission->display_name}}</td>
    					<td>{{$permission->description}}</td>
    					<td>
                        <div class="field has-addons">
                            <p class="control">
                                <a href="/permission/edit/{{$permission->id}}" class="button is-link is-small">
                                    <span class="icon is-small">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </span>
                                    <span>Edit</span>
                                </a>
                            </p>
                            <p class="control">
                                {!! Form::open(['method' => 'DELETE','route' => ['permission.destroy', $permission->id]]) !!}
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