@extends('layouts.app')
@section('content')
{{ Breadcrumbs::render('site',$division,$site) }}
<div class="columns">
	<div class="column">
		<div class="card">
			<header class="card-header">
				<p class="card-header-title">
					{{$site->site_name}}
				</p>
			</header>
			<div class="card-content">
				<div class="map">
					<div id="mapdiv" style="width: 100%; height: 600px;">
						{!! Mapper::render() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal">
	<div class="modal-background"></div>
	<div class="modal-content">
		<h3 id="camName" class="is-size-4 is-white"></h3>
		<img id="test">
	</div>
	<button class="modal-close is-large" aria-label="close"></button>
</div>
<script>
		var newYearCountdown;
		function showInfo(){
			$(".gm-style-iw").css("display: block");
		}
		function showModal(id,path,camName){
			$(".modal").addClass("is-active");
			var counter = 1;
			var date = moment(new Date());
			date = date.subtract(3, 'minutes');
    		newYearCountdown = setInterval(function(){
    		if (counter === 601) {
				counter = 1;
				date = date.add(1, 'minutes');
			}
        	var newImg = $('#test');
        	var nameCam = $('#camName');
        	var filename = '/video/'+path+'/ip-'+date.format("DDMMYYYY__HHmm")+'-'+counter+'.jpeg';
        	newImg.attr("src", filename);
        	nameCam.text(camName);
        	console.log(filename);
        	counter++;
			}, 1000/10);
		}
		$(document).on('click', '.modal-close', function() {
			 $(".modal").removeClass("is-active");
			 clearInterval(newYearCountdown);
		     return false;
		});
		$(document).on('click', '.notification > button.delete', function() {
		    $(this).parent().addClass('is-hidden');
		    return false;
		});
		</script>
@endsection