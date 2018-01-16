@foreach (['is-danger', 'is-warning', 'is-success', 'is-info'] as $key)
@if(Session::has($key))
<div class="notification {{ $key }}">
    <button class="delete"></button>
    <p><strong>{{ Session::get($key) }}</strong></p>
</div>
{{-- <article class="message {{ $key }}">
	<div class="message-header">
		@switch($key)
		@case("is-success")
		<p>Success</p>
		@breakswitch
		@case("is-warning")
		<p>Warning</p>
		@breakswitch
		@case("is-danger")
		<p>Error</p>
		@breakswitch
		@default
		<p>Info</p>
		@breakswitch
		@endswitch
		<button class="delete" aria-label="delete"></button>
	</div>
	<div class="message-body">
		{{ Session::get($key) }}
	</div>
</article> --}}
@endif
@endforeach