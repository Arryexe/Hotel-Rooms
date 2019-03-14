@extends('layouts.app')

@section('content')
	
	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					Room Detail Number <b>{{ $room->number }}</b>
				</div>

				<div class="card-body">
					<table class="table">
						<tr>
							<th>Room Number</th>
							<td>{{ $room->number }}</td>
						</tr>

						<tr>
							<th>Category</th>
							<td>{{ $room->category->name }}</td>
						</tr>

						<tr>
							<th>Customer Name</th>
							<td>{{ $room->customer_name ? $room->customer_name : 'No Customer Yet' }}</td>
						</tr>

						<tr>
							<th>Status</th>
							<td>{{ $room->status }}</td>
						</tr>
					</table>
				</div>

				<div class="card-footer">
					<a href="{{ url('rooms') }}" class="btn btn-secondary">Back to Room's List</a>
					<a href="{{ url('rooms/'.$room->id.'/update') }}" class="btn btn-secondary float-right">Edit Room</a>
				</div>
			</div>
		</div>

		@if ($room->status == 'Available')
			<div class="col-6">
				<div class="card">
					<div class="card-header">Check In or Booking Form</div>

					<div class="card-body">
						<form action="{{ url('rooms/'.$room->id.'/booking') }}" method="post">
							{{ csrf_field() }}
							<table class="table">
								<tr>
									<td>
										<label for="customer_name">Customer Name</label>
										<input type="text" name="customer_name" id="customer_name" class="form-control" required>
									</td>
								</tr>

								<tr>
									<td>
										<table>
											<tr>
												<td>
													<label for="status"><b>Status</b></label>
													<select name="status" id="status" class="form-control" required>
														<option label="-- Select Status --"></option>

														<option value="Booking">Booking</option>
														<option value="Check In">Check In</option>
													</select>
												</td>
											</tr>
										</table>
									</td>
								</tr>

								<tr>
									<td>
										<label for="notes">Notes (Optional)</label>
										<textarea name="notes" id="notes" class="form-control"></textarea>
									</td>
								</tr>

								<tr>
									<td>
										<button class="btn btn-secondary float-right">Confirm</button>
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>

			<div class="col-6">
				<div style="margin-top: -100px;">
					<div class="card">
						<div class="card-header">
							<form action="{{ url('rooms/'.$room->id.'/unavailable') }}" method="post">
								{{ csrf_field() }}
								<button class="btn btn-secondary" value="Not Available" name="status_unavailable">Make This Room Unavailable</button>
								<div class="alert float-left" style="margin-bottom: -20px;">Note : This button make this room on Unavailable Status</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>

@endsection