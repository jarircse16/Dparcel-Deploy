@extends('backend.app')
@section('title', $title)

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->

	<div class="container-xxl flex-grow-1 container-p-y">
	  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / </span>Edit Rider</h4>

	  <!-- Basic Layout & Basic with Icons -->
	  <div class="row">
		<!-- Basic Layout -->
		<div class="col-xxl">
		  <div class="card mb-4">
			<div class="card-header d-flex align-items-center justify-content-between">
			  <h5 class="mb-0">Edit Rider</h5>
			  <!-- <small class="text-muted float-end">Default label</small> -->
			</div>
			<div class="card-body">
			  <form method="POST" action="{{ route('rider.update', $rider->id) }}" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="row mb-3">
				  <label class="col-sm-2 col-form-label" for="basic-default-name">Rider Name :</label>
				  <div class="col-sm-10">
					<input required type="text" name="rider_name" class="form-control" id="basic-default-name" value="{{$rider->rider_name}}" />
				  </div>
				</div>
				<div class="row mb-3">
				  <label class="col-sm-2 col-form-label" for="basic-default-phone">Contact Number :</label>
				  <div class="col-sm-10">
					<input required type="number" name="mobile" id="basic-default-phone" class="form-control phone-mask"
					value="{{$rider->mobile}}" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
				  </div>
				</div>
				<div class="row mb-3">
				  <label class="col-sm-2 col-form-label" for="basic-default-email">Email Address :</label>
				  <div class="col-sm-10">
					<div class="input-group input-group-merge">
					  <input required type="email" name="email" id="basic-default-email" class="form-control" value="{{$rider->email}}"
						aria-label="john.doe" aria-describedby="basic-default-email2" />
					  <!-- <span class="input-group-text" id="basic-default-email2">@example.com</span> -->
					</div>

				  </div>
				</div>
				<div class="row mb-3">
				  <label class="col-sm-2 col-form-label" for="basic-default-address">Address :</label>
				  <div class="col-sm-10">
					<input required name="address" type="text" class="form-control" id="basic-default-address" value="{{$rider->address}}" />
				  </div>

				</div>
				<div class="row mb-3">
				  <label class="col-sm-2 col-form-label" for="files">Image :</label>
				  <div class="col-sm-10">
					
					  <input class="form-control" type="file" id="files" name="image">
					  <div class="form-text">Image must be in 1:1 (Square Shape)</div>
					
				  </div>

				</div>
				<hr>

				<div class="row mb-3">
				  <label class="col-sm-2 col-form-label" for="basic-default-name"> username:</label>
				  <div class="col-sm-10">
					<input name="username" type="text" class="form-control" id="basic-default-name" value="{{$rider->username}}" />
				  </div>
				</div>
				<div class="row mb-3">
				  <label class="col-sm-2 col-form-label" for="basic-default-password">Password :</label>
				  <div class="col-sm-10">
					<input name="password" type="password" class="form-control" id="basic-default-password"
					value="{{$rider->password}}" />
				  </div>
				</div>

				<div class="row mb-3">
					<label class="col-sm-2 col-form-label" for="basic-default-email">Drop Rider :</label>
					<div class="col-sm-10">
						<div class="input-group input-group-merge">
							<select id="status" name="status" class="form-control">
								@if ($rider->status == 'Active')
								<option value="Active" selected="selected">Active</option>
								<option value="Inactive">Inactive</option>
								@else
								<option value="Inactive">Inactive</option>
								<option value="Active">Active</option>
								@endif
							
							</select>
						</div>
					</div>
				</div>


				<div class="row d-flex justify-content-center align-items-center">
				  <div class="col-lg-12 d-flex justify-content-center align-items-center gap-4 form-button">
					<button type="submit" class="btn btn-primary">SUBMIT</button>
					<button type="submit" class="btn rounded-pill btn-outline-warning">DISCARD</button>
				  </div>

				</div>

			  </form>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	<!-- / Content -->

	

	<div class="content-backdrop fade"></div>
  </div>
  <!-- Content wrapper -->

@endsection