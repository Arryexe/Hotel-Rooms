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
		
		@if ($room->status == 'Booking')
			<div class="col-6">
				<div class="card">
					<div class="card-header">Room Status</div>

					<div class="card-body">
						<table class="table">
							<tr>
								<th>Booking Time</th>
								<td>{{ $room->booking_time }}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		@elseif($room->status == 'Check In')
			<div class="col-6">
				<div class="card">
					<div class="card-header">Room's Status</div>

					<div class="card-body">
						<table class="table">
							<tr>
								<th>Check In Time</th>
								<td>{{ $room->checkin_time }}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		@elseif($room->status == 'Check Out')
			<div class="col-6">
				<div class="card">
					<div class="card-header">Room Status</div>

					<div class="card-body">
						<table class="table">
							<tr>
								<th>Check In Time</th>
								<td>{{ $room->checkin_time }}</td>
							</tr>

							<tr>
								<th>Check Out Time</th>
								<td>{{ $room->checkout_time }}</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		@endif

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
								<div class="row">
									<div class="col-6">
										<button class="btn btn-secondary" value="Not Available" name="status">Make This Room Unavailable</button>
									</div>
									<div class="col-6">
										<div style="font-size: 9pt;">Note : This Button Make this room Not Available</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

		@elseif($room->status == 'Booking')
			<div class="col-6">
				<div class="card my-3">
					<div class="card-body">
						<form action="{{ url('rooms/'.$room->id.'/checkin') }}" method="post">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-6">
									<button class="btn btn-secondary" value="Check In" name="status">Check In Now !</button>
								</div>
								
								<div class="col-6">
									<div style="font-size: 9pt;">Note : Check In Time will count after you click this Button</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

		@elseif($room->status == 'Check In')
			<div class="col-6">
				<div class="card my-3">
					<card class="card-body">
						<form action="{{ url('rooms/'.$room->id.'/checkout') }}" method="post">
							{{ csrf_field() }}
							<div class="row">
								<div class="col-6">
									<button class="btn btn-secondary" value="Check Out" name="status">Check Out Now !</button>
								</div>

								<div class="col-6">
									<div style="font-size: 9pt;">Note : Check Out Time Will count after you click this button</div>
								</div>
							</div>
						</form>
					</card>
				</div>
			</div>
		@endif
	</div>

@endsection