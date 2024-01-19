@extends('vendor.app')

@section('content')
@if(session('message'))
    {{-- <div class="alert alert-success"> --}}
        {{-- {{ session('message') }} --}}
    {{-- </div> --}}
@endif
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->


                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">

                            <!-- Vendor Food Orders row -->
                            <hr class="vendor-seperate">
                            <div class="row">
                                <h4 class="vendor-title">Vendor Dashboard</h4>

                                <br><form action="{{ route('delivery.index') }}" method="GET" class="mb-3">
                                    @csrf
                                    <!-- <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Search by Phone Number" aria-label="Search">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div> -->
                                    <div class="input-group mb-3" style="display: flex; align-items: center; justify-content: center; height: 7vh; margin: 0; background: linear-gradient(to right, #808080, #FFFFFF);">
                                    <div style="display: flex; max-width: 400px; width: 100%; background-color: #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); border-radius: 4px; overflow: hidden;">
                                    <input name="search" class="form-control" aria-label="Search" type="text" style="flex: 1; padding: 10px; border: none; outline: none; font-size: 16px;" placeholder="Search by phone number...">
                                    <button type="submit"  style="background: linear-gradient(to right, #ffeb3b, #ff9800); color: #000; border: none; padding: 10px; cursor: pointer;">Search</button>
                                </div>
                            </div>
                                </form>
                            

                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('delivery.create') }}" style="color: black">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <!-- <i class='vendor-icon bx bx-car'></i> -->
                                                        <i style="background-color: #f7b614;padding:12px 10px 12px 10px;font-size: 22px;border-radius: 100px;" class="fa-solid fa-box-open"></i>
                                                        
                                                    </div>
                                                </div>

                                                <span class="fw-semibold d-block mb-1">Add New Delivery</span>

                                                
                                                <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('delivery.index') }}" style="color: black">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <!-- <i class='vendor-icon bx bx-notepad'></i> -->
                                                    <i style="background-color: #f7b614;padding-top: 12px; padding-bottom: 12px; padding-left: 10px; padding-right: 10px;font-size: 20px;border-radius: 100px;"  class="fa-solid fa-truck"></i>
                                                </div>
                                            </div>
                                            
                                                <span class="fw-semibold d-block mb-1">Pending Deliveries</span>
                                            
                                            <h3 class="card-title mb-2">{{ $p_deliveries->count() }}</h3>

                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('vendor.pickup') }}" style="color: black">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i style="color: black;" class='vendor-icon bx bx-cube-alt'></i>
                                                </div>
                                            </div>
                                            
                                                <span class="fw-semibold d-block mb-1">Pending Pickup</span>
                                           
                                            <h3 class="card-title mb-2">{{ $pickup->count() }}</h3>

                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('vendor.processing') }}" style="color: black">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <!-- <i class='vendor-icon bx bx-check'></i> -->
                                                    <i style="background-color: #f7b614;padding:12px 10px 12px 10px;font-size: 18px;border-radius: 100px;" class="fa-solid fa-truck-ramp-box"></i>
                                                </div>
                                            </div>
                                           
                                                <span class="fw-semibold d-block mb-1">Processing Deliveries</span>
                                           
                                            <h3 class="card-title text-nowrap mb-1">{{ $processing->count() }}</h3>

                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('vendor.complete.list') }}" style="color: black">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <!-- <i class='vendor-icon bx bx-car'></i> -->
                                                        <i style="background-color: #f7b614;padding:12px 12px 12px 12px;font-size: 18px;border-radius: 100px;" class="fa-solid fa-dove"></i>
                                                    </div>
                                                </div>

                                                <span class="fw-semibold d-block mb-1">Completed Deliveries</span>

                                                <h3 class="card-title text-nowrap mb-1">
                                                    {{ $c_delivery->count() }}
                                                </h3>
                                                <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                                            </div>
                                        </div>
                                    </a>
                                </div>

                            

                            </div>
                            <hr class="vendor-seperate">


                            <div class="content-backdrop fade"></div>
                        </div>
                        <!-- Content wrapper -->
                    </div>
                    <!-- / Layout page -->
                </div>

                <!-- Overlay -->
                <div class="layout-overlay layout-menu-toggle"></div>
            </div>
            <!-- / Layout wrapper -->
        </div>
    </div>
@endsection
