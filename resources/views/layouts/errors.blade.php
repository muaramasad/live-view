@if ($errors->any())
<div class="notification is-danger">
    <button class="delete"></button>
    <ul>
        @foreach ($errors->all() as $error)
        <li><strong>{!! $error !!}</strong></li>
        @endforeach
    </ul>
</div>
@endif