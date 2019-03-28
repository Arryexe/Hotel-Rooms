@extends('layouts.app')

@section('content')
	
	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					Update Data Room Number <b></b>

				</div>
			<form action="{{ url('rooms/'.$room->id) }}" method="post" id="edit_room_{{ $room->id }}">
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
								<label for="notes">Notes</label>
								<textarea name="notes" id="notes" class="form-control">{{ $room->notes }}</textarea>
							</td>
						</tr>
					</table>
				</div>

				<div class="card-footer">
					<button class="btn btn-info text-light" id="Update Room">Submit</button>
					<a href="{{ url('rooms/'.$room->id) }}" class="btn btn-secondary float-right">Back</a>
				</div>
			<form>
		</div>
	</div>

@endsection