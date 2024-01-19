@extends('vendor.app')
@section('title', 'Bulk Delivery')

@section('content')

<!-- Content wrapper -->
<div class="content-wrapper">
	<!-- Content -->

	<div class="container-xxl flex-grow-1 container-p-y">
	  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> Download / </span>Excel File</h4>

	  <!-- Basic Layout & Basic with Icons -->
	  <div class="row">
		<!-- Basic Layout -->
		<div class="col-xxl">
		  <div class="card mb-4 text-center">
			<div class="card-header  d-flex align-items-center justify-content-center">
			  <h5 class="text-center"> Download the excel file </h5>
			  <!-- <small class="text-muted float-end">Default label</small> -->
			</div>
			<div class="card-body">
				
			  <form method="POST" action="{{ route('delivery.export') }}" enctype="multipart/form-data">
				@csrf
			
				<div class="row d-flex justify-content-center align-items-center">
				  <div class="col-lg-12 d-flex justify-content-center align-items-center gap-4 form-button">
					<button type="submit" class="btn btn-primary"><a href= "{{asset('uploads/bulkdeliveries/bulkDeliveries.xlsx')}}" style="color: white;">Download</button>
					<a href="{{ '/vendor/dashboard/' }}">
						<button type="button" class="btn rounded-pill btn-outline-warning">DISCARD</button>
					</a>
				  </div>

				</div>

			  </form>
			</div>

            <div class="card-body">
                <h5 class="text-center"> Upload the excel file </h5>
				
                <form method="POST" action="{{ route('upload.file.store') }}" enctype="multipart/form-data">
                  @csrf
              
                  <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-lg-12 d-flex justify-content-center align-items-center gap-4 form-button">
                      <input required type="file" name="file" accept=".xlsx, .xls, .csv">
                    <button type="submit" class="btn btn-primary">Upload</button>
                     
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