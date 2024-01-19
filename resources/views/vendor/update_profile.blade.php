@extends('vendor.app')
@section('title', $title)


@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / </span>Profile</h4>

            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Update Profile</h5>
                            <!-- <small class="text-muted float-end">Default label</small> -->
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                                @csrf
								@method('PUT')
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Vendor Name :</label>
                                    <div class="col-sm-10">
                                        <input required type="text" name="vendor_name" class="form-control"
                                            id="basic-default-name" value="{{$vendor->vendor_name}}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Owner Name :</label>
                                    <div class="col-sm-10">
										@if ($vendor->owner_name)
										<input type="text" name="owner_name" class="form-control"
										id="basic-default-company" value="{{$vendor->owner_name}}" />
										@else
										<input type="text" name="owner_name" class="form-control"
                                            id="basic-default-company" />
										@endif
                                        
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Username :</label>
                                    <div class="col-sm-10">
                                        <input required type="text" name="username" id="item_price"
                                            class="form-control phone-mask" value="{{$vendor->username}}" aria-label="658 799 8941"
                                            aria-describedby="basic-default-phone" />
                                    </div>
                                </div>

								<div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Email :</label>
                                    <div class="col-sm-10">
                                        <input required type="email" name="email" id="item_price"
                                            class="form-control phone-mask" value="{{$vendor->email}}" aria-label="658 799 8941"
                                            aria-describedby="basic-default-phone" />
                                    </div>
                                </div>

								<div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Mobile :</label>
                                    <div class="col-sm-10">
                                        <input required type="number" name="mobile" id="item_price"
                                            class="form-control phone-mask" value="{{$vendor->mobile}}" aria-label="658 799 8941"
                                            aria-describedby="basic-default-phone" />
                                    </div>
                                </div>

                           
                               

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Address :</label>
                                    <div class="col-sm-10">
										@if ($vendor->address)
										<input required type="text" name="address" id="delivery_charge"
										class="form-control phone-mask" value="{{$vendor->address}}" aria-label="658 799 8941"
										aria-describedby="basic-default-phone" />
										@else
										<input type="text" name="address" id="delivery_charge"
										class="form-control phone-mask" aria-label="658 799 8941"
										aria-describedby="basic-default-phone" />
										@endif
                                       
                                    </div>
                                </div>

                                {{-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Total Price :</label>
                                    <div class="col-sm-10">
                                        <input type="password" name="password"
                                            class="form-control phone-mask" value="{{$vendor->password}}" aria-label="658 799 8941"
                                            aria-describedby="basic-default-phone" />
                                    </div>
                                </div> --}}

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-address">Vendor Logo :</label>
                                    <div class="col-sm-10">
                                        <input name="vendor_logo" type="file" class="form-control"
                                            id="basic-default-address" />
                                    </div>
                                </div>
                         
                                <div class="row d-flex justify-content-center align-items-center">
                                    <div
                                        class="col-lg-12 d-flex justify-content-center align-items-center gap-4 form-button">
                                        <button type="submit" class="btn btn-primary">SUBMIT</button>
										<a href="{{ URL::previous() }}">
                                        <button type="button"
                                            class="btn rounded-pill btn-outline-warning">DISCARD</button>
										</a>
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

