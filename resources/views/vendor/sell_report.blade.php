@extends('vendor.app')


@section('title', $title)

@section('css')
    <link rel="stylesheet" href="{{ asset('customer/css/jquery.dataTables.css') }}" />

@endsection

@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card-body">
                <h4 class="mb-2 text-uppercase text-center">Total Deliveries - {{$total_delivery}}</h4>
                <div class="since-report-border"></div>
                <div class="details-container">
                    <div class="d-flex flex-wrap justify-content-around align-items-center mt-4">
                        <strong class="text-uppercase">
                            Pending Deliveries = {{$total_pending}}
                        </strong>
                        <strong class="text-uppercase">
							cost = {{$total_pending_amount}}
                            {{-- @if ($t_a)
                                {{$t_a}}
                            @endif --}}
					
						</strong>
                    </div>
                    <div class="d-flex flex-wrap justify-content-around align-items-center">
                        <strong class="text-uppercase text-wrap">
                            Pending Pickup = {{$total_pending_pickup_delivery}}
                        </strong>
                        <strong class="text-uppercase m-0">cost = {{$total_pickup_amount}}</strong>
                    </div>
                    <div class="d-flex flex-wrap justify-content-around align-items-center mt-1">
                        <strong class="text-uppercase m-0">
                            Processing Deliveries = {{$total_processing_delivery}}
                        </strong>
                        <strong class="text-uppercase m-0">cost = {{$total_processing_amount}}</strong>
                    </div>
                    
                    <div class="d-flex flex-wrap justify-content-around align-items-center mt-1">
                        <strong class="text-uppercase m-0">
                            Completed Deliveries = {{$total_completed_delivery}}
                        </strong>
                        <strong class="text-uppercase m-0">cost = {{$total_complete_amount}}</strong>
                    </div>

					<div class="d-flex flex-wrap justify-content-around align-items-center mt-1">
                        <strong class="text-uppercase m-0">
                            Cancel Deliveries = {{$total_cancel_delivery}}
                        </strong>
                        <strong class="text-uppercase m-0">cost = {{$total_cancel_amount}}</strong>
                    </div>

					<div class="d-flex flex-wrap justify-content-around align-items-center mt-1">
                        <strong class="text-uppercase m-0">
                            Return Deliveries = {{$total_return_delivery}}
                        </strong>
                        <strong class="text-uppercase m-0">cost = {{$total_return_amount}}</strong>
                    </div>
                    <hr class="vendor-seperate total-separator" />
                    <div class="d-flex flex-wrap justify-content-around align-items-center mt-1">
                        <strong class="text-uppercase m-0">
                            Total Delivey = {{$total_delivery}}
                        </strong>
                        <strong class="text-uppercase m-0">Amount = {{$total_amount}}
                        </strong>
                    </div>
                   
                </div>
            </div>

            <hr class="my-5" />


        </div>
        <!-- / Content -->



        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->

@endsection

@section('script')
    <script src="{{ asset('customer/vendor/js/table.js') }}"></script>
    <script src="{{ asset('customer/vendor/js/jquery.dataTables.min.js') }}"></script>
@endsection
