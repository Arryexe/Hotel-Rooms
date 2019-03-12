@extends('layouts.app')

@section('content')
	
	<div class="row">
		<div class="col-7">
			<div class="card">
				<div class="card-header">Create a new Room</div>
				<form action="{{ url('rooms') }}" method="post">
				{{ csrf_field() }}
				<div class="card-body">
					<table class="table">
						<tr>
							<td>
								<label for="number">Room Number</label>
								<select name="number" class="form-control" id="number" required>
										<option label="-- Select Room Number --"></option>
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
									<option label="-- Select Category --"></option>
									@foreach ($categories as $category)
										<option value="{{ $category->id }}">{{ $category->name }}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<tr>
							<td>
								<label for="status">Status</label>
								<select name="status" id="status" class="form-control" required>
									<option label="-- Select Option --"></option>

									<option value="Available">Available</option>
									<option value="Not Available">Not Available</option>
								</select>
							</td>
						</tr>
					</table>
				</div>

				<div class="card-footer">
					<button type="submit" value="submit" class="btn btn-info text-light">Submit</button>
					<a href="{{ url('rooms') }}" class="btn btn-secondary float-right">Back</a>
				</div>
			</div>
		</div>
	</div>

@endsection