@extends('app')

@section('content')
	<div class="list-group">
		@foreach($data as $user)
			<a href="/{{$user->id}}/show" class="list-group-item"> {{$user->name}}</a></li>
		@endforeach
	</div>
@endsection