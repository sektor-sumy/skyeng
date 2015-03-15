@extends('app')

@section('content')

<div class="panel panel-info">
	<div class="panel-heading">Teachers who have max total students</div>
	<div class="panel-body">

		@if (Session::has('message'))
			<div class="alert-box error">
			<p>{!! Session::get('message') !!}</p>
			</div>
		@endif
		<div class="col-md-5 col-md-offset-2">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Teacher</th>
					</tr>
				</thead>

				<tbody>
				@foreach ($teachers as $teacher)
				<tr>
				<td>{!! $teacher['name']; !!}</td>
				</tr>
				@endforeach
				</tbody>

			</table>
		</div>
	</div>
</div>
@stop