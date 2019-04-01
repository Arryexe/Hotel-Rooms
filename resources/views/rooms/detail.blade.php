@extends('layouts.app')

@section('content')
	
	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-6">
							Room Detail Number <b>{{ $room->number }}</b>
						</div>
						
						<div class="col-6">
							<form action="{{ url('rooms/'.$room->id) }}" method="post">
								{{ csrf_field() }} {{ method_field('DELETE') }}
								<button class="btn btn-secondary float-right" id="delete_room_{{ $room->id }}">Delete This Room</button>
							</form>
						</div>
					</div>
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

						<tr>
							<th>Notes</th>
							<td>{{ $room->notes ? $room->notes : 'There is No Notes Here' }}</td>
						</tr>
					</table>
				</div>

				<div class="card-footer">
					<a href="{{ url('rooms') }}" class="btn btn-secondary">Back to Room's List</a>
					<a href="{{ url('rooms/'.$room->id.'/update') }}" class="btn btn-secondary float-right" id="room_update_{{ $room->id }}">Edit Room</a>
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
										<button class="btn btn-secondary float-right" id="Submit Room">Confirm</button>
									</td>
								</tr>
							</table>
						</form>
					</div>
				</div>
			</div>

			<div class="col-6">
				<div style="margin-top: -65px;">
					<div class="card">
						<div class="card-header">
							<form action="{{ url('rooms/'.$room->id.'/unavailable') }}" method="post">
								{{ csrf_field() }}
								<div class="row">
									<div class="col-6">
										<button class="btn btn-secondary" value="Not Available" name="status" id="make_room_not_available_from_available_page">Make This Room Not Available</button>
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
									<button class="btn btn-secondary" value="Check In" name="status" id="checkin">Check In Now !</button>
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
									<button class="btn btn-secondary" value="Check Out" name="status" id="checkout">Check Out Now !</button>
								</div>

								<div class="col-6">
									<div style="font-size: 9pt;">Note : Check Out Time Will count after you click this button</div>
								</div>
							</div>
						</form>
					</card>
				</div>
			</div>
		@elseif($room->status == 'Check Out')
			<div class="col-6">
				<div class="card my-3">
					<div class="card-body">
						<div class="row">
							<form action="{{ url('rooms/'.$room->id.'/available') }}" method="post">
								{{ csrf_field() }}
								<div class="col-6">
									<button class="btn btn-secondary" value="Available" name="status" id="make_available">Make This Room Available</button>
								</div>
							</form>

							<form action="{{ url('rooms/'.$room->id.'/onservice') }}" method="post">
								{{ csrf_field() }}
								<div class="col-6">
									<button class="btn btn-secondary" value="On Service" name="status" id="make_onservice">On Service</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@elseif($room->status == 'On Service')
			<div class="col-6">
				<div class="card my-3">
					<div class="card-body">
						<div class="row">
							<form action="{{ url('rooms/'.$room->id.'/available') }}" method="post">
								{{ csrf_field() }}
								<div class="col-6">
									<button class="btn btn-secondary" value="Available" name="status" id="make_available_from_onservice">Make This Room Available</button>
								</div>
							</form>

							<form action="{{ url('rooms/'.$room->id.'/unavailable') }}" method="post">
								{{ csrf_field() }}
								<div class="col-6">
									<button class="btn btn-secondary" value="Not Available" name="status" id="make_unavailable_from_onservice">Make This Room Not Available</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		@elseif($room->status == 'Not Available')
			<div class="col-6">
				<div class="card my-3">
					<div class="card-body">
						<div class="row">
							<form action="{{ url('rooms/'.$room->id.'/available') }}" method="post">
								{{ csrf_field() }}
								<div class="col-6">
									<button class="btn btn-secondary" value="Available" name="status" id="make_room_available_from_notavailable">Make This Room Available</button>
								</div>
							</form>							
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>

@endsection