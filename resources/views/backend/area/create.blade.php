@extends('backend.app')
@section('title', $title)

@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / </span>Add New Area</h4>

            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">ADD NEW Area</h5>
                            <!-- <small class="text-muted float-end">Default label</small> -->
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('area.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Area Name :</label>
                                    <div class="col-sm-10">
                                        <input required type="text" name="area_name" class="form-control"
                                            id="basic-default-name" placeholder="Area Name" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Division</label>
                                    <div class="col-sm-10">
									<select name="division_id" class="form-control" id="basic-default-phone">
                                        <option selected="selected" disabled>Select Division</option>
                                        @foreach ($divisions as $div)
                                            <option value="{{ $div->id }}">{{ $div->division_name }}</option>
                                        @endforeach

                                    </select>
									</div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">District</label>
                                    <div class="col-sm-10">
									<select name="district_id" class="form-control" id="basic-default-phone">
                                        <option selected="selected" disabled>Select Division</option>
                                        @foreach ($districts as $dis)
                                            <option value="{{ $dis->id }}">{{ $dis->district_name }}</option>
                                        @endforeach

                                    </select>
									</div>
                                </div>

								<div class="row mb-3">
									<label class="col-sm-2 col-form-label" for="files">Area Image :</label>
									<div class="col-sm-10">
									  
										<input class="form-control" type="file" id="files" name="area_image">
										<div class="form-text">Image must be in 1:1 (Square Shape)</div>
									  
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
