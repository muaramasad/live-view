@extends('layouts.app')
@section('content')
<div class="columns is-centered p-t-lg">
    <div class="column is-one-third">
        <div class="logo-login m-b-md">
            <img src="{{ asset('images/logo_japfa.png') }}">
        </div>
        <nav class="panel">
            <p class="panel-heading">
                Login | Japfa CCTV Monitoring System
            </p>
            <div class="panel-block is-fullwidth">
                {!! Form::open(['route' => 'login', 'class' => 'is-fullForm']) !!}
                <div class="field is-grouped-centered">
                    <label class="label">Email</label>
                    <p class="control is-expanded">
                        {!! Form::text('email', null ,['class' => 'input is-expanded']) !!}
                    </p>
                </div>
                <div class="field is-grouped-centered">
                    <label class="label">Password</label>
                    <p class="control is-expanded">
                        <input type="password" name="password" class="input is-expanded">
                    </p>
                </div>
                <div class="field is-grouped">
                    <div class="control">
                        <button type="submit" class="button is-link">Submit</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </nav>
    </div>
</div>
@endsection