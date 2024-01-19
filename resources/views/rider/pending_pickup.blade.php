@extends('rider.app')
@section('title', 'Pending Pickup Delivery')

@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><a href="{{ URL::previous() }}" class="text-muted fw-light">Dashboard /</a> <a href="#"
                    class="text-muted fw-light">Delivery /</a>Pending Pickup List</h4>

            {{-- <!-- Search Box -->
            <form action="{{ route('rider.pending.pickup.list') }}" method="GET" class="mb-3">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search by item name, qty, vendor name, etc." aria-label="Search">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form> --}}

            <!-- button -->
            <form action="{{ route('rider.bulk.approve.pickup') }}" method="POST" class="mb-3" enctype="multipart/form-data">
                @csrf
                <div style="text-align:center; margin-bottom:10px;">
                    <button type="submit" class="btn btn-warning " style="color:black; font-weight: bold;">Bulk Assign</button>
                    </div>
            

            <!-- Hoverable Table rows -->
            <div class="card">
                
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="table_id">
                        <thead style="background-color: #393A42">
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>qty</th>
                                <th>Recepient Name</th>
                                <th>Recepient Number</th>
                                <th>Recepient Address</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($deliveries as $key => $delivery)
                                <tr>
                                    <!-- new td added -->
                                    <td> <input class="form-check-input" type="checkbox" value="{{$delivery->id}}" name="delivery[]" id="flexCheckDefault"></td>
                                    <!-- new td added -->
                                    <td>{{ $delivery->id }}</td>
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
                                        <p>{{ $delivery->recipient_address }}</p>

                                    </td>

                                    <td>

                                        <div class="d-flex flex-wrap flex-row">
                                            @if ($delivery->is_pick == 0)
                                                <form action="{{ route('approve.pickup.delivery.store', $delivery->id) }}">
                                                    @csrf
                                                    {{-- <input type="hidden" name="delivery_id" value="{{$delivery->id}}"> --}}
                                                    <button type="submit" class="badge bg-primary me-1">
                                                        Approve
                                                    </button>
                                                </form> 

                                                <form class="mt-1" action="{{ route('decline.pickup.delivery.store', $delivery->id) }}">
                                                    @csrf
                                                    {{-- <input type="hidden" name="delivery_id" value="{{$delivery->id}}"> --}}
                                                    <button type="submit" class="badge bg-danger me-1">
                                                        Decline
                                                    </button>
                                                </form>
                                            @endif

                                           
                                        </div>
                                      
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <button type="submit" class="btn btn-warning">Bulk Assign</button> --}}
            <!--/ Hoverable Table rows -->
        </form>
            <hr class="my-5" />


        </div>
        <!-- / Content -->



        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->

@endsection
