@extends('app')

@section('content')

<div class="panel panel-info">
	<div class="panel-heading">Teachers</div>
	<div class="panel-body">
		<p><a href="/teachers/create">Add new Teacher</a></p>
		<div class="col-md-5 col-md-offset-2">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Id</th>
						<th>Teachers</th>
						<th>Students count</th>
						<th></th>
					</tr>
				</thead>

				<tbody>
				@foreach ($teachers as $teacher)
				<tr>
				<td>{!! $teacher->id !!}</td>
				<td>{!! $teacher->name !!}</td>
				<?php $count = 0;?>
				@foreach ($teacher->students as $student)
					<?php $count++; ?>
				@endforeach
				<td>{!! $count !!}</td>
				<td>{!! link_to_route('teacher.show', 'Show',
				array($teacher->id), array('class' => 'btn btn-info')) !!}</td>
				<td> {!! Form::open(array('route' => array('teacher.destroy', $teacher->id), 'method' => 'delete')) !!}
	        			<button type="submit" class="btn btn-danger btn-mini">Delete</button>
	    			{!! Form::close() !!}</td>
				</tr>
				@endforeach

				</tbody>

			</table>
		</div>
		<div class="pagination" style="clear:both;display:block;">
			<?php echo $teachers->render(); ?>
		</div>
	</div>
</div>
@stop