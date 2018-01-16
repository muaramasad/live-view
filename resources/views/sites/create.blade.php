@extends('layouts.app')
@section('content')
@if ($errors->any())
<article class="message is-danger">
    <div class="message-header">
        <p>Error</p>
        <button class="delete" aria-label="delete"></button>
    </div>
    <div class="message-body">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</article>
@endif
<div class="columns">
    <div class="column is-6 is-offset-3">
        {!! Form::open(['route' => 'site.store']) !!}
        <div class="field is-grouped-centered">
            <label class="label">Site Name</label>
            <p class="control is-expanded">
                {!! Form::text('site_name', null ,['class' => 'input']) !!}
            </p>
        </div>
        <div class="field is-grouped-centered">
            <label class="label">Division</label>
            <p class="control is-expanded">
                <div class="select is-fullwidth">
                    {!! Form::select('division_id', $divisions, null, ['placeholder' => '-- Select Division --', 'id' => 'selDiv']); !!}
                </div>
            </p>
        </div>
        <div class="field is-grouped-centered">
            <label class="label">Area</label>
            <p class="control is-expanded">
                <div class="select is-fullwidth">
                    {!! Form::select('area_id', $areas, null, ['placeholder' => '-- Select Areas --', 'id' => 'selArea']); !!}
                </div>
            </p>
        </div>
        <div class="field">
            <label class="label">Latitude</label>
            <div class="control">
                <input class="input" type="text" name="cor_x">
            </div>
        </div>
        <div class="field">
            <label class="label">Longitude</label>
            <div class="control">
                <input class="input" type="text" name="cor_y">
            </div>
        </div>
        <div class="field">
            <label class="label">Link URL 1</label>
            <div class="control">
                <input class="input" type="text" name="url_1">
            </div>
        </div>
        <div class="field">
            <label class="label">Link URL 2</label>
            <div class="control">
                <input class="input" type="text" name="url_2">
            </div>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">Submit</button>
            </div>
            <div class="control">
                <a href="{{route('site.index')}}" class="button is-text">Cancel</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<script>
$("#selDiv").on("change", function(){
var divId = $(this).val();
out = '<option>-- Select Area --</option>';
$.ajax({
url: "/api/area/" + divId,
type: 'GET',
success: function(data){
$.each(data, function(k, v) {
out += '<option value="' +k+ '">' +v+ '</option>'
});
$("#selArea").html(out);
},
error: function(){
console.log("error");
}
});
// var selected = $(this).val();
// $("#results").html("You selected: " + selected);
console.log($(this).val());
})
</script>
@endsection