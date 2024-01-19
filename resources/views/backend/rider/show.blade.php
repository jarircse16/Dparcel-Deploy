@extends('backend.app')
@section('title', $title)

@section('content')


        <!-- Content wrapper -->
        <div class="content-wrapper">
			<!-- Content -->
  
			<div class="container-xxl flex-grow-1 container-p-y">
			  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / RIDER / </span> RIDER DETAILS
			  </h4>
  
			  <!-- Basic Layout & Basic with Icons -->
			  <div class="row">
				<!-- Basic Layout -->
				<div class="col-xxl">
				  <div class="card mb-4">
  
					<div class="card-header">
						
						@if ($rider->image)
							<img class="mb-3" src="{{ asset('uploads/rider/'.$rider->image) }}" alt="">
						@else
							<img class="mb-3" src="{{ asset('customer/img/avator.png') }}" alt="">

						@endif
					  <h4>{{$rider->owner_name }}</h4>
					</div>
					<hr class="vendor-seperate">
  
					<div class="card-body">
					  <form id="formAuthentication" class="mb-3" action="index.html" method="POST">
  
						<div class="mb-3 d-flex  align-items-center gap-3 ">
						  <h6 class="m-0 text-uppercase fw-bold">Rider Name : </h6>
						  <p class="m-0">{{$rider->rider_name }}</p>
						</div>
						<div class="mb-3 d-flex align-items-center gap-4">
						  <h6 class="m-0 text-uppercase fw-bold">Contact Number : </h6>
						  <p class="m-0">{{$rider->mobile }}</p>
						</div>
  
						<div class="mb-3 d-flex  align-items-center gap-4">
						  <h6 class="m-0 text-uppercase fw-bold">EMAIL ADDRESS : </h6>
						  <p class="m-0">{{$rider->email }}</p>
						</div>
						<div class="mb-3 d-flex align-items-center gap-4">
						  <h6 class="m-0 text-uppercase fw-bold">Address : </h6>
						  <p class="m-0">{{$rider->address }}</p>
						</div>
						<div class="mb-3 d-flex align-items-center gap-4">
						  <h6 class="m-0 text-uppercase fw-bold">Action : </h6>
						  @if ($rider->status == 'Active')
						  	<p class="m-0">Active</p>
						  @else
							<p class="m-0">Inactive</p>
						  @endif
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