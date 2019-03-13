@extends('layouts.app')

@section('content')
	
	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					Update Data Room Number <b></b>

				</div>
			<form action="{{ url('rooms/'.$room->id) }}" method="post">
			{{ csrf_field() }} {{ method_field('PATCH') }}
				<div class="card-body">
					<table class="table">
						<tr>
							<td>
								<label for="number">Room Number</label>
								<select name="number" class="form-control" id="number" required>
									<option label="{{ $room->number }}">{{ $room->number }}</option>
									@foreach ($availableNumbers as $no)
											<option value="{{ $no }}">{{ $no }}</option>
									@endforeach
								</select>
							</td>
						</tr>

						<tr>
							<td>
								<label for="category_name">Category</label>
								<select name="category_name" class="form-control" id="category_name" required>
									@foreach ($categories as $category)

										<option value="{{ $category->id }}" {{ $category->id == $room->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
									@endforeach
								</select>
							</td>
						</tr>

						<tr>
							<td>
								<label for="status">Status</label>
								<select name="status" id="status" class="form-control" required>
									@if ($room->status == 'Available')
										<option value="Available" selected>Available</option>
										<option value="Booking">Booking</option>
										<option value="Check In">Check In</option>
										<option value="Check Out">Check Out</option>
										<option value="On Service">On Service</option>
										<option value="Not Available">Not Available</option>
									@elseif($room->status == 'Booking')
										<option value="Available">Available</option>
										<option value="Booking" selected>Booking</option>
										<option value="Check In">Check In</option>
										<option value="Check Out">Check Out</option>
										<option value="On Service">On Service</option>
										<option value="Not Available">Not Available</option>
									@elseif($room->status == 'Check In')
										<option value="Available">Available</option>
										<option value="Booking">Booking</option>
										<option value="Check In" selected>Check In</option>
										<option value="Check Out">Check Out</option>
										<option value="On Service">On Service</option>
										<option value="Not Available">Not Available</option>
									@elseif($room->status == 'Check Out')
										<option value="Available">Available</option>
										<option value="Booking">Booking</option>
										<option value="Check In">Check In</option>
										<option value="Check Out" selected>Check Out</option>
										<option value="On Service">On Service</option>
										<option value="Not Available">Not Available</option>
									@elseif($room->status == 'On Service')
										<option value="Available">Available</option>
										<option value="Booking">Booking</option>
										<option value="Check In">Check In</option>
										<option value="Check Out">Check Out</option>
										<option value="On Service" selected>On Service</option>
										<option value="Not Available">Not Available</option>
									@elseif($room->status == 'Not Available')
										<option value="Available">Available</option>
										<option value="Booking">Booking</option>
										<option value="Check In">Check In</option>
										<option value="Check Out">Check Out</option>
										<option value="On Service">On Service</option>
										<option value="Not Available" selected>Not Available</option>
									@endif
								</select>
							</td>
						</tr>

						<tr>
							<td>
								<label for="customer_name">Customer Name</label>
								<input type="text" name="customer_name" id="customer_name" class="form-control">
							</td>
						</tr>
					
						<tr>
							<td>
								<label for="notes">Notes</label>
								<input type="text" name="notes" id="notes" class="form-control">
							</td>
						</tr>
					</table>
				</div>

				<div class="card-footer">
					<button class="btn btn-info text-light">Submit</button>
					<a href="{{ url('rooms/'.$room->id) }}" class="btn btn-secondary float-right">Back</a>
				</div>
			<form>
		</div>
	</div>

@endsection