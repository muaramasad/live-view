@extends('layouts.app')
@section('content')
<div class="columns">
    <div class="column is-8 is-offset-2">
        {!! Form::open(['route' => 'cam.store']) !!}
        <div class="field is-grouped-centered">
            <label class="label">CCTV Name</label>
            <p class="control is-expanded">
                {!! Form::text('cam_name', null ,['class' => 'input']) !!}
            </p>
        </div>
        <div class="field is-grouped-centered">
            <label class="label">Site</label>
            <p class="control is-expanded">
                <div class="select is-fullwidth">
                    {!! Form::select('site_id', $sites, $site->id, ['placeholder' => '-- Select Sites --', 'id' => 'selSite']); !!}
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
                <input class="input" type="text" name="ip_address">
            </div>
        </div>
        <div class="field">
            <label class="label">Video URL</label>
            <div class="control">
                <input class="input" type="text" name="video_url">
            </div>
        </div>
        <div class="field is-grouped">
            <div class="control">
                <button type="submit" class="button is-link">Submit</button>
            </div>
            <div class="control">
                <a href="{{route('cam.index')}}" class="button is-text">Cancel</a>
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
        lat = {{$site->cor_x}};
        lng = {{$site->cor_y}};
    }
    $('#latitude, #longitude').change(function() {
        set($('#latitude').val(), $('#longitude').val());
    });
    var map     = new google.maps.Map(document.getElementById('maps'), {center: new google.maps.LatLng(lat, lng), zoom: 18, mapTypeId: 'satellite'});
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