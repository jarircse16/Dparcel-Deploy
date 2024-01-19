@extends('backend.app')
@section('title', $title)
@section('css')
<link rel="stylesheet" href="{{ asset('customer/css/jquery.dataTables.css') }}" />

@endsection

@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><a href="{{ URL::previous() }}" class="text-muted fw-light">Dashboard /</a> <a href="#"
                    class="text-muted fw-light">Vendors /</a>Hold LIST</h4>


            <!-- Hoverable Table rows -->
            <div class="card">
                <h5 class="card-header">Hold LIST</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="table_id">
                        <thead style="background-color: #393A42">
                            <tr>
                                <th>#</th>
                                <th>Vendor Name</th>
                                <th>Vendor Phone</th>
                                <th>Item Name</th>
                                <th>qty</th>
                                <th>Recipiet Name</th>
                                <th>Recipiet Number</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($deliveries as $key => $delivery)
                                <tr>
									<td>{{$delivery->id}}</td>
                                    <td>{{ $delivery->vendor->vendor_name }}</td>
                                    <td>{{ $delivery->vendor->mobile }}</td>
                                    <td>{{ $delivery->item_name }} </td>
                                    <td>
                                        {{ $delivery->qty }}
									</td>
                                    <td>
                                        <p>{{ $delivery->recipient_name }}</p>

                                    </td>
									<td>
                                        <p>{{ $delivery->recipient_number }}</p>

                                    </td>
									<td>
                                        <p>{{ $delivery->total_price }}</p>

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
<script src="{{ asset('customer/vendor/js/table.js') }}"></script>
<script src="{{ asset('customer/vendor/js/jquery.dataTables.min.js') }}"></script>
@endsection
