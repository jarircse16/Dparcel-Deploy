@extends('rider.app')
@section('title', 'PickUp Delivery')

@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><a href="{{ URL::previous() }}" class="text-muted fw-light">Dashboard /</a> <a href="#"
                    class="text-muted fw-light">Delivery /</a> Pending Pickup List</h4>


            <!-- Hoverable Table rows -->
            <div class="card">
                
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="table_id">
                        <thead style="background-color: #393A42">
                            <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>qty</th>
                                <th>Recipiet Name</th>
                                <th>Recipiet Number</th>
                                <th>Total Price</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($deliveries as $key => $delivery)
                                <tr>
									<td>{{$delivery->id}}</td>
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

                                    <td>
                                        <a href="{{ route('rider.delivery.details', $delivery->id) }}">
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
