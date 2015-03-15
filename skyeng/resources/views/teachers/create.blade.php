@extends('app')

@section('content')
<div class="panel panel-info">
<div class="panel-heading">Create Teacher</div>
	<div class="panel-body">
		{!! Form::open(array('route' => 'teacher.store')) !!}
		 @if (!$errors->isEmpty())
		    <div class="alert alert-danger">
		        @foreach ($errors->all() as $error)
		        <p>{!! $error !!}</p>
		        @endforeach
		    </div>
		    @endif

	    <div class="col-md-3 col-md-offset-4">
				{!! Form::label('name', 'Teacher name') !!}
				{!! Form::text('name', '', array('class' => 'form-control')) !!}
				{!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
	    </div>
	    {!! Form::close() !!}
	</div>
</div>
@stop