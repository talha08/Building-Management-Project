@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
			</h3>
		</div>
		@include('includes.alert')
		<table class="display table table-bordered table-striped" id="example">
			<thead>
				<tr>
					<th>Username</th>
					<th>Email</th>
					<th>Role</th>
					<th>Flat</th>

					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($members as $member)
					<tr>

						<td>{{ $member->userInfo->fullName }}</td>
						<td>{{ $member->email }}</td>
						<td>{{ Role::find($member->role_id)->name }}</td>

						<td class="text-center">
							<a class="btn btn-xs btn-success btn-edit" >{{$member->flats->name}}</a>
						</td>


						<td><a href="#" class="btn btn-danger btn-xs btn-archive deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deleteId="{{ $member->id }}">Delete</a></td>

					</tr>
				@endforeach
			</tbody>
		</table>
	</div>



	<!-- Modal -->
	<div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        	<h4 class="modal-title" id="myModalLabel">Confirmation</h4>
		      	</div>
		      	<div class="modal-body">
					Are you sure to delete this Member?
		      	</div>
		      	<div class="modal-footer">
		        	{{ Form::open(array('route' => array('members.delete',0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
		        		<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
		        		{{ Form::submit('Yes, Delete', array('class' => 'btn btn-success')) }}
		        	{{ Form::close() }}
		      	</div>
	    	</div>
		</div>
	</div>





@stop


@section('script')
	{{ HTML::script('assets/data-tables/jquery.dataTables.js') }}
	{{ HTML::script('assets/data-tables/DT_bootstrap.js') }}

	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#example').dataTable({
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function() {

			// delete a member
			$('.deleteBtn').click(function() {
				var deleteId = $(this).attr('deleteId');
				var url = "<?php echo URL::route('members.view.client'); ?>";
				$(".deleteForm").attr("action", url+'/'+deleteId);
			});

		});
	</script>
@stop