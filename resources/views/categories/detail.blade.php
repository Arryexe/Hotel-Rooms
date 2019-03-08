@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-5">
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

		<div class="col-4">
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
			</table>
		</div>
	</div>
@endsection