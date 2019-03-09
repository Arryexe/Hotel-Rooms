@extends('layouts.app')

@section('content')
	
	<div class="row">
		<div class="col-7">
			<div class="card">
				<div class="card-header">
					<b>Room's List</b>
				</div>

				<div class="card-body">
					<table class="table">
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
	</div>

@endsection