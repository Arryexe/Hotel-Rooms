@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">Create New Category</div>

				<form action="{{ url('categories') }}" method="post">
{{ csrf_field() }}
					<div class="card-body">
						<div class="form-grup">
							<label for="name" class="form-label">Category Name</label>
							<input type="text" name="name" class="form-control col-9" required id="name" style="display: inline;">
						</div>
						<div class="form-grup">
							<div style="margin-top: 20px;">
								<label for="price" class="form-label">Category Price</label>
								<input type="text" name="price" class="form-control col-9" required id="price" style="display: inline;" placeholder="$">
							</div>
						</div>
					</div>

					<div class="card-footer">
						<button type="submit" value="submit" class="btn btn-info text-light" id="Create Category">Submit</button>
						<a href="{{ url('categories') }}" class="float-right btn btn-danger">Back to Categories List</a>
					</div>
				</form>
			</div>
		</div>

		<div class="col-6">
			<div class="alert alert-info">
				Fill this form to create a new Category
			</div>
		</div>
	</div>

@endsection