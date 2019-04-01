@extends('layouts.app')

@section('content')

	<div class="row">
		<div class="col-8">
			<div class="card">
				<div class="card-header">
					<h2 style="margin-bottom: -58px;">List Categories</h2>

					<form action="" method="get" class="float-right">
						<div class="row">
							<div class="col-7">
								<input type="text" name="search" class="form-control" placeholder="Search for Categories ..." style="margin: 20px 0 0 10px;">
							</div>

							<input type="submit" value="Submit" class="btn btn-info" style="margin-top: 20px;">
							<a href="{{ url('categories') }}" style="text-decoration: none; margin: 20px 0 0 4px;" class="btn btn-secondary">Reset</a>
						</div>
					</form>

				</div>

				<div class="card-body">
					<table class="table">
						<tbody>
							<tr align="center">
								<th>No.</th>
								<th>Name</th>
								<th>Price</th>
								<th>Action</th>
							</tr>
			
							@php
								$no = 1;
							@endphp

							@foreach ($categories as $category)
								<tr align="center">
									<td>{{ $no++ }}</td>
									<td>{{ $category->name }}</td>
									<td>${{ $category->price }}</td>
									<td>
										<a href="{{ url('categories/'. $category->id) }}" id="edit_category_{{ $category->id }}">View Detail</a>
									</td>
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
						<a href="{{ url('categories/create') }}" class="btn btn-secondary" id="create_new_category">Create a new Category</a>
					</td>
					<td>
						<a href="" class="btn btn-dark float-right">Back to Room's List</a>
					</td>
				</tr>
			</table>
		</div>
	</div>
@endsection 