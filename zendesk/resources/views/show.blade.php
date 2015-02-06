@extends('app')

@section('content')
	<ul class="list-group">
	  <li class="list-group-item col-md-2 col-md-offset-5">
	        <span class="badge" data-toggle="modal" data-target=".bs-example-modal-sm">{{count($data->tickets)}}</span>
	        <span style="margin-right:10px;">{{$userInfo->name}}</span><button class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Details</button>
	      </li>
	</ul>

	<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-sm">
	    <div class="modal-content">
	     	<div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
	          <h4 class="modal-title" id="myLargeModalLabel">Tickets</h4>
	        </div>
	        <div class="modal-body">
		  		<table class="table table-bordered table-striped">
		  			<tr><th>Subject</th><th>Assignee name</th><th>Status</th></tr>
				  	@foreach($data->tickets as $value)
				  		<tr @if (is_array($value->tags) && in_array('urgent', $value->tags)) class="green" @endif><td>{{$value->subject}}</td><td>{{$value->assignee_name}}</td><td>{{$value->status}}</td></tr>
				  	@endforeach
			  	</table>
	        </div>
	    </div>
	  </div>
	</div>

	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-lg">
	   <div class="modal-content">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myLargeModalLabel">More information</h4>
        </div>
        <div class="modal-body">
         	<ul class="nav nav-tabs">
			  <li class="active"><a href="#laravel" data-toggle="tab">Laravel Info</a></li>
			  <li><a href="#zendesk" data-toggle="tab">Zendesk Info</a></li>
			</ul>
			<div class="tab-content">
			  <div class="tab-pane active" id="laravel">
			  	<table class="table table-bordered table-striped">
				  	<tr><td>Email</td><td>{{$userInfo->email}}</td></tr>
					<tr><td>Name</td><td>{{$userInfo->name}}</td></tr>
			  	</table>
			  </div>
			  <div class="tab-pane" id="zendesk">
			  		<table class="table table-bordered table-striped">
					  	@foreach($zenInfo->results[0] as $key => $value)
							@if (!is_object($value) && !is_array($value) && $value != NULL)
								<tr><td>{{$key}}</td><td>{{$value}}</td></tr>
							@endif
					  	@endforeach
				  	</table>
			  </div>
			</div>
        </div>
      </div>
	  </div>
	</div>
@endsection