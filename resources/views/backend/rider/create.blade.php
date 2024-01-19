@extends('backend.app')
@section('title', $title)

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->

	<div class="container-xxl flex-grow-1 container-p-y">
	  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / </span>Add New Rider</h4>

	  <!-- Basic Layout & Basic with Icons -->
	  <div class="row">
		<!-- Basic Layout -->
		<div class="col-xxl">
		  <div class="card mb-4">
			<div class="card-header d-flex align-items-center justify-content-between">
			  <h5 class="mb-0">ADD NEW RIDER</h5>
			  <!-- <small class="text-muted float-end">Default label</small> -->
			</div>
			<div class="card-body">
			  <form method="POST" action="{{ route('rider.store') }}" enctype="multipart/form-data">
				@csrf
				<div class="row mb-3">
				  <label class="col-sm-2 col-form-label" for="basic-default-name">Rider Name :</label>
				  <div class="col-sm-10">
					<input required type="text" name="rider_name" class="form-control" id="basic-default-name" placeholder="Rider Name" />
				  </div>
				</div>
				<div class="row mb-3">
				  <label class="col-sm-2 col-form-label" for="basic-default-phone">Contact Number :</label>
				  <div class="col-sm-10">
					<input required type="number" name="mobile" id="basic-default-phone" class="form-control phone-mask"
					  placeholder="+880" aria-label="658 799 8941" aria-describedby="basic-default-phone" />
				  </div>
				</div>
				<div class="row mb-3">
				  <label class="col-sm-2 col-form-label" for="basic-default-email">Email Address :</label>
				  <div class="col-sm-10">
					<div class="input-group input-group-merge">
					  <input required type="email" name="email" id="basic-default-email" class="form-control" placeholder="Your Email"
						aria-label="john.doe" aria-describedby="basic-default-email2" />
					  <!-- <span class="input-group-text" id="basic-default-email2">@example.com</span> -->
					</div>

				  </div>
				</div>
				<div class="row mb-3">
				  <label class="col-sm-2 col-form-label" for="basic-default-address">Address :</label>
				  <div class="col-sm-10">
					<input required name="address" type="text" class="form-control" id="basic-default-address" placeholder="Address" />
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
					<input name="username" type="text" class="form-control" id="basic-default-name" placeholder="Usename" />
				  </div>
				</div>
				<div class="row mb-3">
				  <label class="col-sm-2 col-form-label" for="basic-default-password">Password :</label>
				  <div class="col-sm-10">
					<input name="password" type="password" class="form-control" id="basic-default-password"
					  placeholder="Password" />
				  </div>
				</div>


				<div class="row d-flex justify-content-center align-items-center">
				  <div class="col-lg-12 d-flex justify-content-center align-items-center gap-4 form-button">
					<button type="submit" class="btn btn-primary">SUBMIT</button>
					<button type="button" class="btn rounded-pill btn-outline-warning">DISCARD</button>
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