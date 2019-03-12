@extends('layouts.app')

@section('content')
	
	<div class="row">
		<div class="col-7">
			<div class="card">
				<div class="card-header">
					<b>Room's List</b>
				</div>

				<div class="card-body">
					<form action="" method="get">
						<div class="row">							
							<div class="col-9">
								<input type="text" name="search" class="form-control" placeholder="Search for Categories ...">
							</div>
							<div class="float-right">
								<input type="submit" value="Submit" class="btn btn-info text-light">
								<a href="{{ url('rooms') }}" style="text-decoration: none;" class="btn btn-secondary">Reset</a>
							</div>						
						</div>
					</form>
					<table class="table my-3">
						<tbody>
							<tr align="center">
								<th>Number</th>
								<th>Category</th>
								<th>Status</th>
							</tr>

							@foreach ($rooms as $room)
								<tr align="center">
									<td>{{ $room->number }}</td>
									<td>{{ $room->category->name }}</td>
									<td>{{ $room->status }}</td>
								</tr>
							@endforeach
						</tbody>	
					</table>
				</div>
			</div>
		</div>

		<div class="col-4">
			<table class="table">
				<b>Action List</b>
				<tr>
					<td>
						<a href="{{ url('rooms/create') }}" class="btn btn-secondary">Create a new Room</a>
					</td>
				</tr>
			</table>
		</div>
	</div>

@endsection