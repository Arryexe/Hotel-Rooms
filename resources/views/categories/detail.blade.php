@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">Detail of <b>{{ $categories->name }}</b> Category</div>

				<div class="card-body">
					<table class="table">
						<tbody>
							<tr>
								<th>Name</th>
								<td>{{ $categories->name }}</td>
							</tr>
							<tr>
								<th>Price</th>
								<td>${{ $categories->price }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-6">
			<div class="card">
				<div class="card-header">List Room's Using this Category</div>

				<div class="card-body">
					<table class="table">
						<tbody>
							<tr align="center">
								<th>Room Number</th>
								<th>Status</th>
							</tr>
							@foreach ($categories->room as $room)
							<tr>
								<td>{{ $room->number }}</td>
								<td>{{ $room->status }}</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col-5 my-3">
			<table class="table">
				<b>Action List</b>
				<tr>
					<td>
						<a href="{{ url('categories/'. $categories->id .'/edit') }}" class="btn btn-dark text-right">Edit This Category</a>
					</td>
					<td>
						<a href="{{ url('categories') }}" class="btn btn-dark text-right">Return to Categories Page</a>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						@if ($categories->room->count() == 0)
							<form action="{{ url('categories/'. $categories->id) }}" method="post" onsubmit="return confirm('Are you sure to Delete this Employee?')">
								{{ csrf_field() }} {{ method_field('DELETE') }}
								<button class="btn btn-danger">Delete This Categories</button>
							</form>
						@endif
					</td>
				</tr>
			</table>
		</div>
	</div>
@endsection