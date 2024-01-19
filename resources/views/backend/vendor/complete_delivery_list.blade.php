@extends('backend.app')
@section('title', $title)


@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><a href="{{ URL::previous() }}" class="text-muted fw-light">Dashboard /</a> <a href="#"
                    class="text-muted fw-light">Vendors /</a> COMPLETE DELIVERY LIST</h4>


            <!-- Hoverable Table rows -->
            <div class="card">
                <h5 class="card-header"> COMPLETE DELIVERY LIST</h5>
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
									<td class="text-wrap">{{$delivery->id}}</td>
                                    <td class="text-wrap">{{ $delivery->item_name }} </td>
                                    <td class="text-wrap">
                                        {{ $delivery->qty }}
									</td>
                                    <td class="text-wrap">
                                        <p>{{ $delivery->recipient_name }}</p>

                                    </td>
									<td class="text-wrap">
                                        <p>{{ $delivery->recipient_number }}</p>

                                    </td>
									<td class="text-wrap">
                                        <p>{{ $delivery->total_price }}</p>

                                    </td>

                                    <td class="text-wrap">
                                        <a href="{{ route('vendor.invoice', $delivery->id) }}">
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
            <br>
            {{ $deliveries->links('pagination::bootstrap-4') }}

            <hr class="my-5" />


        </div>
        <!-- / Content -->

       

        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->

@endsection

