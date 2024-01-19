@extends('backend.app')

@section('content')
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
                    
                            <!-- Search Bar and Button -->
                            <div class="mb-4">
                                <form action="{{ route('admin.searching') }}" method="GET">
                                    <!-- <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search..." name="search">
                                        <button type="submit" class="btn btn-primary">Search</button>
                                    </div> -->
                                    <div class="input-group mb-3" style="display: flex; align-items: center; justify-content: center; height: 7vh; margin: 0; background: linear-gradient(to right, #808080, #FFFFFF);">
                                    <div style="display: flex; max-width: 400px; width: 100%; background-color: #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); border-radius: 4px; overflow: hidden;">
                                    <input name="search" class="form-control" aria-label="Search" type="text" style="flex: 1; padding: 10px; border: none; outline: none; font-size: 16px;" placeholder="Search here...">
                                    <button type="submit"  style="background: linear-gradient(to right, #ffeb3b, #ff9800); color: #000; border: none; padding: 10px; cursor: pointer;">Search</button>
                                </div>
                            </div>
                                </form>
                            </div>
                            <!-- End Search Bar and Button -->

                            <div class="row">
                                <h4 class="vendor-title">Admin Dashboard</h4>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('vendor.pending.delivery') }}" style="color: black">

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                    
                                                    <i style="background-color: #f7b614;padding: 10px;font-size: 22px;border-radius: 100px;" class="fa-solid fa-clock-rotate-left"></i>
                                                    </div>
                                                    
                                                </div>

                                                <span class="fw-semibold d-block mb-1">Pending Pickup</span>

                                                <h3 class="card-title text-nowrap mb-1">{{ $total_pending_delivery }}</h3>
                                                <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('vendor.pending.pickup') }}" style="color: black">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <!-- <img
                                                    src="../assets/img/icons/unicons/wallet-info.png"
                                                    alt="Credit Card"
                                                    class="rounded"
                                                  /> -->
                                                        <!-- <i  class='vendor-icon bx bx-group'></i> -->
                                                        <i style="background-color: #f7b614;padding-top: 12px; padding-bottom: 12px; padding-left: 10px; padding-right: 10px;font-size: 20px;border-radius: 100px;"  class="fa-solid fa-truck"></i>
                                                    </div>
                                                </div>

                                                <span class="fw-semibold d-block mb-1">Pending Delivery</span>


                                                <h3 class="card-title text-nowrap mb-1">{{ $pending_pickup }}</h3>
                                                <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('vendor.processing.delivery') }}" style="color: black">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">

                                                        <!-- <i class='vendor-icon bx bx-group'></i> -->
                                                        <i style="background-color: #f7b614;padding:12px 10px 12px 10px;font-size: 22px;border-radius: 100px;" class="fa-solid fa-truck-fast"></i>
                                                    </div>
                                                </div>

                                                <span class="fw-semibold d-block mb-1">Processing Delivery</span>

                                                <h3 class="card-title text-nowrap mb-1">{{ $total_processing_delivery }}
                                                </h3>
                                                <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('vendor.complete.delivery') }}" style="color: black">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">

                                                        <!-- <i class='vendor-icon bx bx-group'></i> -->
                                                        <i  style="background-color: #f7b614;padding: 10px;font-size: 22px;border-radius: 100px;" <i class="fa-solid fa-parachute-box"></i></i>
                                                       
                                                    </div>
                                                </div>

                                                <span class="fw-semibold d-block mb-1">Completed Delivery</span>
                                                <h3 class="card-title text-nowrap mb-1">{{ $total_completed_delivery }}</h3>
                                                <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                                            </div>
                                        </div>
                                </div>
                                </a>

                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('bulk.delivery.list') }}" style="color: black">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <!-- <i class='vendor-icon bx bx-notepad'></i> -->
                                                        <i  style="background-color: #f7b614;padding:12px 10px 12px 10px;font-size: 18px;border-radius: 100px;" class="fa-solid fa-envelopes-bulk"></i>
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Bulk Deliveries</span>
                                                <h3 class="card-title mb-2">{{ $total_bulk_delivery }}</h3>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('vendor.index') }}" style="color: black">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">

                                                        <!-- <i class='vendor-icon bx bx-cube-alt'></i> -->
                                                        <i style="background-color: #f7b614;padding:12px 10px 12px 10px;font-size: 18px;border-radius: 100px;" class="fa-solid fa-people-roof"></i>
                                                    </div>
                                                </div>
                                                <span class="fw-semibold d-block mb-1">Total Vendor</span>
                                                <h3 class="card-title mb-2">{{ $total_vendor }}</h3>

                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('rider.index') }}" style="color: black">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <!-- <i class='vendor-icon bx bx-check'></i> -->
                                                        <i style="background-color: #f7b614;padding:12px 10px 12px 10px;font-size: 18px;border-radius: 100px;" class="fa-solid fa-person-biking"></i>
                                                    </div>
                                                </div>
                                                <span>Total Rider</span>
                                                <h3 class="card-title text-nowrap mb-1">{{ $total_rider }}</h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <!-- <i class='vendor-icon bx bx-car'></i> -->
                                                    <i style="background-color: #f7b614;padding:12px 10px 12px 10px;font-size: 18px;border-radius: 100px;" class="fa-solid fa-panorama"></i>
                                                </div>
                                            </div>
                                            <span>Total Area</span>
                                            <h3 class="card-title text-nowrap mb-1">{{ $total_area }}</h3>
                                            <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <hr class="vendor-seperate">
                            <div class="row">
                                <h4 class="vendor-title">PickDrops</h4>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('pickdrop.list') }}" style="color: black">

                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <!-- <i class='vendor-icon bx bx-group'></i> -->
                                                        <i style="background-color: #f7b614;padding: 10px;font-size: 22px;border-radius: 100px;" class="fa-solid fa-crosshairs"></i>
                                                    </div>
                                                </div>

                                                <span class="fw-semibold d-block mb-1">Total PickDrops</span>

                                                <h3 class="card-title text-nowrap mb-1">{{ $total_pickdrops }}</h3>
                                                <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('processing.pickup') }}" style="color: black">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">
                                                        <!-- <img
                                                    src="../assets/img/icons/unicons/wallet-info.png"
                                                    alt="Credit Card"
                                                    class="rounded"
                                                  /> -->
                                                        <!-- <i class='vendor-icon bx bx-group'></i> -->
                                                        <i style="background-color: #f7b614;padding-top: 12px; padding-bottom: 12px; padding-left: 15px; padding-right: 15px;font-size: 18px;border-radius: 100px;" class="fa-regular fa-hourglass-half"></i>
                                                    </div>
                                                </div>

                                                <span class="fw-semibold d-block mb-1">Pending PickDrops</span>


                                                <h3 class="card-title text-nowrap mb-1">{{ $total_pending_pick }}</h3>
                                                <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('processing_pickupDrop') }}" style="color: black">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">

                                                        <!-- <i class='vendor-icon bx bx-group'></i> -->
                                                        <i style="background-color: #f7b614;padding:12px 10px 12px 10px;font-size: 18px;border-radius: 100px;" class="fa-solid fa-truck-ramp-box"></i>
                                                    </div>
                                                </div>

                                                <span class="fw-semibold d-block mb-1">Processing PickDrops</span>

                                                <h3 class="card-title text-nowrap mb-1">{{ $total_processing_pick }}
                                                </h3>
                                                <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('completed.pickup') }}" style="color: black">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">

                                                        <!-- <i class='vendor-icon bx bx-group'></i> -->
                                                        <i style="background-color: #f7b614;padding:12px 12px 12px 12px;font-size: 18px;border-radius: 100px;" class="fa-solid fa-dove"></i>
                                                    </div>
                                                </div>

                                                <span class="fw-semibold d-block mb-1">Completed PickDrops</span>
                                                <h3 class="card-title text-nowrap mb-1">{{ $total_completed_pick }}</h3>
                                                <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                                            </div>
                                        </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('cancel.pickdrop') }}" style="color: black">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="card-title d-flex align-items-start justify-content-between">
                                                    <div class="avatar flex-shrink-0">

                                                        <!-- <i class='vendor-icon bx bx-group'></i> -->
                                                        <i  style="background-color: #f7b614;padding:12px 10px 12px 10px;font-size: 18px;border-radius: 100px;" class="fa-solid fa-plane-slash"></i>
                                                    </div>
                                                </div>

                                                <span class="fw-semibold d-block mb-1">Cancel PickDrops</span>
                                                <h3 class="card-title text-nowrap mb-1">{{ $total_cancel_pick }}</h3>
                                                <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                                            </div>
                                        </div>
                                </div>
                                </a>
                            </div>

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
