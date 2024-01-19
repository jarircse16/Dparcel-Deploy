@extends('backend.app')
@section('title', 'Date Wise Delivery List')

@section('css')
    <link rel="stylesheet" href="{{ asset('customer/css/jquery.dataTables.css') }}" />
@endsection

@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card-body">
                <h4 class="mb-2 text-uppercase text-center">Date : {{$delivery_date}}</h4>
                <div class="since-report-border"></div>
                <div class="details-container">
                    <div class="d-flex flex-wrap justify-content-around align-items-center mt-2">
                        <strong class="text-uppercase m-0">
                            Pending Deliveries ={{$total_pending}}
                        </strong>
                        <strong class="text-uppercase m-0">cost = {{$total_pending_amount}}</strong>
                    </div>
                    <div class="d-flex flex-wrap justify-content-around align-items-center mt-2">
                        <strong class="text-uppercase m-0">
                            Pending Pickup = {{$total_pickup}}
                        </strong>
                        <strong class="text-uppercase m-0">cost = {{$total_pickup_amount}}</strong>
                    </div>
                    <div class="d-flex flex-wrap justify-content-around align-items-center mt-2">
                        <strong class="text-uppercase m-0">
                            Processing Deliveries = {{$total_processing}}
                        </strong>
                        <strong class="text-uppercase m-0">cost = {{$total_processing_amount}}</strong>
                    </div>
                    
                    <div class="d-flex flex-wrap justify-content-around align-items-center mt-2">
                        <strong class="text-uppercase m-0">
                            Completed Deliveries = {{$total_completed}}
                        </strong>
                        <strong class="text-uppercase m-0">cost = {{$total_completed_amount}}</strong>
                    </div>
                    <hr class="vendor-seperate total-separator" />
                    <div class="d-flex flex-wrap justify-content-around align-items-center mt-2">
                        <strong class="text-uppercase m-0">
                            Total Delivey = {{$deliveries->count()}}
                        </strong>
                        <strong class="text-uppercase m-0">Amount = {{$total_amount}}
                        </strong>
                    </div>
                    <div class="d-flex flex-wrap justify-content-around align-items-center mt-2">
                        <strong class="text-uppercase m-0">
                            Delivery Charge
                        </strong>
                        <strong class="text-uppercase m-0">Charge = {{$delivery_charge}}
                        </strong>
                    </div>
                    <hr class="vendor-seperate total-separator" />
                    <div class="d-flex flex-wrap justify-content-around align-items-center mt-2">
                        <strong class="text-uppercase m-0">
                            PayOff
                        </strong>
                        <strong class="text-uppercase m-0">Payoff = {{$payoff}}
                        </strong>
                    </div>
                </div>
            </div>
            <!-- Hoverable Table rows -->
            <div class="card">
                <h5 class="card-header"> Today DELIVERY LIST</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="table_id">
                        <thead style="background-color: #393A42">
                            <tr>
                                <th>#</th>
                                <th>Vendor Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($vendors as $key => $vendor)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-wrap">{{ $vendor->vendor_name }}</td>
                                <td class="text-wrap">{{ $vendor->mobile }}</td>
                                <td class="text-wrap">
                                    <p>{{ $vendor->email }}</p>
                                </td>
                                <td class="text-wrap">
                                    <a href="{{ route('vendor.d2d.invoice', $vendor->id) }}">
                                        <span class="badge bg-label-primary me-1">View</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                          
                        </tbody>
                    </table>
                </div>
            </div>
            <!--/ Hoverable Table rows -->

            <hr class="my-5" />
            
        </div>
        <!-- / Content -->



        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->

@endsection

@section('script')
    <script src="https://kit.fontawesome.com/8d65650676.js" crossorigin="anonymous"></script>

    <script src="{{ asset('customer/vendor/js/table.js') }}"></script>
    <script src="{{ asset('customer/vendor/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('customer/vendor/js/jspdf.min.js') }}"></script>
    <script src="{{ asset('customer/vendor/js/html2canvas.min.js') }}"></script>
@endsection
