@extends('app')

@section('content')

<div class="panel panel-info">
	<div class="panel-heading">Edit students for this teacher</div>
	<div class="panel-body">
		@if (Session::has('message'))
			<div class="alert-box error">
			<p>{!! Session::get('message') !!}</p>
			</div>
		@endif
		<div class="col-md-5 col-md-offset-2">
			{!! Form::model($students, array('method' => 'PUT', 'route' =>
	 array('teacher.update', $id))) !!}
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th>Id</th>
							<th>Students</th>
							<th></th>
							<th></th>
						</tr>
					</thead>

					<tbody>
					@foreach ($students as $student)
					<tr>
					<td>{!! $student->id !!}</td>
					<td>{!! $student->name !!}</td>
					<?php $count = false;?>
					@foreach ($student->teachers as $teacher)
						@if($teacher->id === $id) 
							<?php $count = true;?>	
						@endif
					@endforeach
					<td>{!! Form::checkbox('students[]', $student->id, $count) !!}</td>
					</tr>
					@endforeach
					</tbody>

				</table>
				<div class="container-fluid ">
			        <div class="row col-md-4 col-md-offset-4">
			              {!! Form::submit('Submit', array('class' => 'btn btn-primary')) !!}
			        </div>
			    </div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@stop