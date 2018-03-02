@extends('layouts.app')
@section('content')
<div class="columns">
    <div class="column is-6 is-offset-3">
        {!! Form::open(['route' => 'division.store', 'files' => true]) !!}
        <div class="field is-grouped-centered">
            <label class="label">Division Name</label>
            <p class="control is-expanded">
                {!! Form::text('division_name', null ,['class' => 'input']) !!}
            </p>
        </div>
        <div class="field is-grouped-centered">
            <label class="label">Category</label>
            <p class="control is-expanded">
                <div class="select is-fullwidth">
                    {!! Form::select('category', ['poultry' => 'Poultry','aquaculture' => 'Aquaculture','beef cattle' => 'beef cattle'], null, ['placeholder' => '-- Select Category --']); !!}
                </div>
            </p>
        </div>
        <div class="field is-grouped-centered">
            <label class="label">Thumbnail</label>
            <p class="control is-expanded">
                <div class="file">
                    <label class="file-label">
                        <input class="file-input" type="file" name="thumbnail" onchange="readURL(this);">
                        <span class="file-cta">
                            <span class="file-icon">
                                <i class="fa fa-upload"></i>
                            </span>
                            <span class="file-label">
                                Choose a file…
                            </span>
                        </span>
                    </label>
                </div>
            </p>
            <p class="control is-expanded m-t-lg">
                <figure class="image is-128x128">
                    <img id="blah" alt="thumbnail" src="{{asset('images/default_pic.png')}}" width="230" height="auto">
                </figure>
            </p>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">Submit</button>
            </div>
            <div class="control">
                <a href="{{route('division.index')}}" class="button is-text">Cancel</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection