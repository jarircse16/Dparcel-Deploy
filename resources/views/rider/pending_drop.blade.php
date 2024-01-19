@extends('rider.app')
@section('title', 'Pending Drop List')

@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><a href="{{ URL::previous() }}" class="text-muted fw-light">Dashboard /</a> <a href="#"
                    class="text-muted fw-light">Delivery /</a> Pending Drop List</h4>

               {{-- <!-- Search Box -->
               <div class="mb-3">
                <form action="{{ route('rider.pending.drop.search') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search by Item Name" name="search">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
            </div>
            <!-- /Search Box -->          --}}
         <form action="{{ route('rider.bulk.approve.drop') }}" method="POST" class="mb-3" enctype="multipart/form-data">
                @csrf
                

            <!-- Hoverable Table rows -->
            <div class="card">
                <div style="display:flex; align-items:center; gap:40px;">
                    <h5 class="card-header">Pending Drop List</h5>
                    <div>
                    <button type="submit" class="btn btn-warning " style="color:black; font-weight: bold;">Bulk Assign</button>
                    </div>
                    </div>
                {{-- <h5 class="card-header">Pending Drop List</h5> --}}
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
                                    <!--New td-->
                                    <td> <input class="form-check-input" type="checkbox" value="{{$delivery->id}}" name="delivery[]" id="flexCheckDefault"></td>
                                    <!--New td-->
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

                                        <div class="d-flex flex-wrap flex-row">
                                            @if ($delivery->is_drop == 0)
											<form action="{{ route('approve.drop.delivery.store', $delivery->id) }}">
												@csrf
												{{-- <input type="hidden" name="delivery_id" value="{{$delivery->id}}"> --}}
												<button type="submit" class="badge bg-primary me-1">
													Approve
												</button>
											</form>

                                            <form class="mt-1" action="{{ route('decline.drop.delivery.store', $delivery->id) }}">
                                                @csrf
                                                {{-- <input type="hidden" name="delivery_id" value="{{$delivery->id}}"> --}}
                                                <button type="submit" class="badge bg-danger me-1">
                                                    Decline
                                                </button>
                                            </form>
																												
										@endif

                                        <a class="mt-1" href="{{ route('rider.delivery.details', $delivery->id) }}">
											
                                            <button type="button" class="badge bg-success me-1">
                                                View
                                            </button>
										</a>
                                        </div>
										
                                    </td>
                                  
									
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!--<button type="submit" class="btn btn-warning">Bulk Assign</button>-->
            <!--/ Hoverable Table rows -->
        </form>
            <hr class="my-5" />


        </div>
        <!-- / Content -->



        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->

@endsection
