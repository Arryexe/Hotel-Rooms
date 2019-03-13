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
					<a href="{{ url('rooms/'.$room->id.'/update') }}" class="btn btn-secondary float-right">Edit Data</a>
				</div>
			</div>
		</div>

		@if ($room->status == 'Check In' || $room->status == 'Booking')
			<div class="col-6">
				<div class="float-right">
					<div class="card">
						<div class="card-header">Room's Status Detail</div>

						<div class="card-body">
							<table class="table">
								<tr>
									<th>Check In Time</th>
									<td>{{ $room->checkin_time ? $room->checkin_time : "There's No Customer In This Room" }}</td>
								</tr>

								<tr>
									<th>Check Out Time</th>
									<td>{{ $room->checkout_time ? $room->checkout_time : "There's No Customer In This Room" }}</td>
								</tr>

								<tr>
									<th>Notes</th>
									<td>{{ $room->notes ? $room->notes : 'No Notes Here' }}</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</div>
		@endif
	</div>

@endsection