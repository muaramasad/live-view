@extends('layouts.app')
@section('content')
<div class="columns">
    <div class="column is-8 is-offset-2">
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
                <input id="latitude" class="input" type="text" name="cor_x">
            </div>
        </div>
        <div class="field">
            <label class="label">Longitude</label>
            <div class="control">
                <input id="longitude" class="input" type="text" name="cor_y">
            </div>
        </div>
        <div class="field">
            <div id="maps" style="height: 500px; position: relative; overflow: hidden;">
                
            </div>
        </div>
        <div class="field">
            <label class="label">IP Address</label>
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
<script src="http://maps.googleapis.com/maps/api/js?sensor=true&key={{env('GOOGLE_API_KEY')}}"></script>
<script>
window.onload = function() {
    var lat = $('#latitude').val();
    var lng = $('#longitude').val();
    if (!lat || !lng) {
        lat = -3.157832;
        lng = 119.416569;
    }
    $('#latitude, #longitude').change(function() {
        set($('#latitude').val(), $('#longitude').val());
    });
    var map     = new google.maps.Map(document.getElementById('maps'), {center: new google.maps.LatLng(lat, lng), zoom: 5});
    var marker  = new google.maps.Marker({
                    position: new google.maps.LatLng(lat, lng),
                    draggable:true,
                    map: map
                });
    var set = function (lat, lng)
    {
        var latLng = new google.maps.LatLng(lat, lng);
        map.setOptions({center: latLng});
        marker.setOptions({position: latLng});
        $('#latitude').val(lat);
        $('#longitude').val(lng);
    }
    set(lat, lng);
    google.maps.event.addListener(map, 'click', function(event) {
        set(event.latLng.lat(), event.latLng.lng());
    });
    google.maps.event.addListener(marker, 'dragend', function(event) {
        set(event.latLng.lat(), event.latLng.lng());
    });
}
</script>
<script>
$("#selDiv").on("change", function() {
    var divId = $(this).val();
    out = '<option>-- Select Area --</option>';
    $.ajax({
        url: "/api/area/" + divId,
        type: 'GET',
        success: function(data) {
            $.each(data, function(k, v) {
                out += '<option value="' + k + '">' + v + '</option>'
            });
            $("#selArea").html(out);
        },
        error: function() {
            console.log("error");
        }
    });
    // var selected = $(this).val();
    // $("#results").html("You selected: " + selected);
    console.log($(this).val());
})
</script>
@endsection