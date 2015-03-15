@extends('app')

@section('content')

<div class="panel panel-info">
	<div class="panel-heading">Students</div>
	<div class="panel-body">
		<p><a href="/students/create">Add new Student</a></p>
		@if (Session::has('message'))
			<div class="alert-box error">
			<p>{!! Session::get('message') !!}</p>
			</div>
		@endif
		<div class="col-md-5 col-md-offset-2">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Id</th>
						<th>Students</th>
						<th>Count Teacher</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
				@foreach ($students as $student)
				<tr>
				<td>{!! $student->id !!}</td>
				<td>{!! $student->name !!}</td>
				<?php $count = 0;?>
				@foreach ($student->teachers as $teacher)
					<?php $count++; ?>
				@endforeach
				<td>{!! $count !!}</td>
				<td> {!! Form::open(array('route' => array('student.destroy', $student->id), 'method' => 'delete')) !!}
	        			<button type="submit" class="btn btn-danger btn-mini">Delete</button>
	    			{!! Form::close() !!}</td>
				</tr>
				@endforeach
				</tbody>

			</table>
		</div>
		<div class="pagination" style="clear:both;display:block;">
			<?php echo $students->render(); ?>
		</div>
	</div>
</div>
@stop