@extends('vendor.app')
@section('title', $title)

@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
                <!-- Search Form -->
     {{-- <br>   <form action="{{ route('delivery.index') }}" method="GET" class="mb-3">
            @csrf
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search by weight, item price, delivery charge, etc." aria-label="Search">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form> --}}


        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><a href="{{ URL::previous() }}" class="text-muted fw-light">Dashboard /</a> <a href="#"
                    class="text-muted fw-light">Delivery /</a> Pending Delivery List</h4>

            <!-- Hoverable Table rows -->
            <!-- <div class="card">
                <h5 class="card-header">Pending Delivery List</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="table_id">
                        <thead style="background-color: #393A42">
                            <tr> -->
                             <!--   <th>SL No</th> -->
                                <!-- <th>Weight</th>
                                <th>Item Price</th>
                                <th>Delivery Charge</th>
                                <th>Receipient Name</th>
                                <th>Recipient Number</th>
                                <th>Recipient Address</th>
                                <th>View</th>
                                <th>Scan QR Code</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($deliveries as $key => $delivery)
                                <tr> -->
								<!--	<td>{{$key}}</td> -->
                                    <!-- <td>{{ $delivery->qty }} </td>
                                    <td>{{ $delivery->item_price }}</td>
                                    <td><p>{{ $delivery->delivery_charge }}</p>                                    </td>
									<td><p>{{ $delivery->recipient_name }}</p></td>
									<td><p>{{ $delivery->recipient_number }}</p></td>
                                    <td><p>{{$delivery->recipient_address}}</p></td>
                                    <td>
                                        @if ($delivery->status == 'Pending')
                                            <a href="{{ route('delivery.edit', $delivery->id) }}">
                                                <span class="badge bg-label-warning me-1">Edit</span>
                                            </a>
                                        @else
                                        
                                        @endif


                                        <a href="{{ route('vendor.tracking', $delivery->id) }}">
                                            <span class="badge bg-label-primary me-1">View</span>
                                        </a>

                                    </td>
                                    <td>
                                        <a href="{{ route('vendor.scan-qr-code', $delivery->id) }}">Scan QR Code</a>
                                    </td>   
                                  
									
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div> -->

            <div class="card">
    <h5 class="card-header" style='margin-left:10px;'>Pending Delivery List</h5>
    <div class="table-responsive">
        <table class="table table-hover" id="table_id">
            <thead class="bg-dark text-white">
                <tr>
                    <th>Weight</th>
                    <th>Item Price</th>
                    <th>Delivery Charge</th>
                    <th>Recipient Name</th>
                    <th>Recipient Number</th>
                    <th>Recipient Address</th>
                    <th>View</th>
                    <th>Scan QR Code</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deliveries as $key => $delivery)
                    <tr>
                        <td>{{ $delivery->qty }}</td>
                        <td>{{ $delivery->item_price }}</td>
                        <td>{{ $delivery->delivery_charge }}</td>
                        <td>{{ $delivery->recipient_name }}</td>
                        <td>{{ $delivery->recipient_number }}</td>
                        <td>{{ $delivery->recipient_address }}</td>
                        <td>
                            @if ($delivery->status == 'Pending')
                                <a href="{{ route('delivery.edit', $delivery->id) }}"
                                    class="badge bg-warning text-dark me-1">Edit</a>
                            @endif
                            <a href="{{ route('vendor.tracking', $delivery->id) }}"
                                class="badge bg-primary me-1">View</a>
                        </td>
                        <td>
                            <a href="{{ route('vendor.scan-qr-code', $delivery->id) }}">Scan QR Code</a>
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
