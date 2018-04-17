@extends('layouts.app')
@section('content')
<div class="columns">
    <div class="column is-10 is-offset-1">
    {!!  Html::decode(link_to_route('role.create', '<i class="fa fa-plus-circle"></i>&nbsp;&nbsp;create role', array(), ['class' => 'button is-primary is-pulled-right m-b-sm'])) !!}
    	<table class="table is-fullwidth">
    		<thead>
    			<th>Name</th>
    			<th>Display Name</th>
    			<th>Description </th>
    			<th>Action</th>
    		</thead>
    		<tbody>
    			@foreach($roles as $role)
    				<tr>
    					<td>{{$role->name}}</td>
    					<td>{{$role->display_name}}</td>
    					<td>{{$role->description}}</td>
    					<td>
                        <div class="field has-addons">
                            <p class="control">
                                <a href="/role/edit/{{$role->id}}" class="button is-link is-small">
                                    <span class="icon is-small">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </span>
                                    <span>Edit</span>
                                </a>
                            </p>
                            <p class="control">
                                {!! Form::open(['method' => 'DELETE','route' => ['role.destroy', $role->id],'onsubmit' => 'return confirm("Do you really want to delete this role?");']) !!}
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