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
                <h5 class="card-header">PickDrop LIST</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="table_id">
                        <thead style="background-color: #393A42">
                            <tr>
                                <th>Item Name</th>
                                <th>Qty</th>
                                <th>Price</th>
								<th>Drop Address</th>
                                <th>Pick Address</th>
								<th>View</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($pick_drop as $p)
                                <tr>
                                   
                                    <td class="text-wrap">
                                        {{ $p->item_name }}
									</td>
                                    <td class="text-wrap">
                                        <p>{{ $p->qty }}</p>

                                    </td>
									<td class="text-wrap">
                                        <p>{{ $p->item_price }}</p>

                                    </td>
									<td class="text-wrap">
                                        <p>{{ $p->drop_address }}</p>

                                    </td>
									<td class="text-wrap">
                                        <p>{{ $p->pick_address }}</p>
                                    </td>
									<td>
                                        <div class="d-flex flex-wrap flex-row">
                                            @if ($p->is_pick == 0)
                                                <form action="{{ route('pick_drop.approved', $p->id) }}" method="post">
                                                    @csrf
                                                    {{-- <input type="hidden" name="delivery_id" value="{{$delivery->id}}"> --}}
                                                    <button type="submit" class="badge bg-primary me-1">
                                                        Approve
                                                    </button>
                                                </form> 

                                                <form class="mt-1" action="{{ route('pick_drop.declined', $p->id) }}">
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
            <!--/ Hoverable Table rows -->

            <hr class="my-5" />


        </div>
        <!-- / Content -->



        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->

@endsection
