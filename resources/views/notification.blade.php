<h1>Notification</h1>
@if($data && count($data)>0)
@foreach ($data as $d)
<div>
    <p>{{ $d->title }} <span>{{ $d->date }}</span><span>{{ $d->time }}</span></p>
    <p>{{ $d->content }}
    <p>
</div>
@endforeach
@else
<p>No Notification !</p>
@endif