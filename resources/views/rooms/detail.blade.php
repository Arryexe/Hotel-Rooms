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
						<form action="" method="post">
							<table class="table">
								<tr>
									<td>
										<label for="customer_name">Customer Name</label>
										<input type="text" name="customer_name" id="customer_name" class="form-control">
									</td>
								</tr>

								<tr>
									<td>
										<table>
											<tr>
												<td>
													<input type="radio" name="booking" value="Booking" id="booking">
													<label for="booking">
														<p style="font-size: 20px;">Booking</p>
													</label>
												</td>
												<td>
													<input type="radio" name="checkin" value="Check In">
													<label>
														<p style="font-size: 20px;">Check In</p>
													</label>
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
		@endif
	</div>

@endsection