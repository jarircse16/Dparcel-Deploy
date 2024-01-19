
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
            <h4 class="fw-bold py-3 mb-4"><a href="#" class="text-muted fw-light">Dashboard /</a> <a href="#"
                    class="text-muted fw-light">PickDrop /</a> List</h4>
            <!-- Hoverable Table rows -->
            <div class="card">
                <h5 class="card-header">PickDrop LIST</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="table_id">
                        <thead style="background-color: #393A42">
                            <tr>
                                <th>Image</th>
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
                                    <td>
                                        @if ($p->product_image)
                                            <img class="mb-3"
                                                src="{{ asset('storage/vendor_logo/' . $p->product_image) }}"
                                                alt="">
                                        @else
                                            <img class="mb-3" src="{{ asset('customer/img/avator.png') }}" alt="">
                                        @endif
                                    </td>
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
                                        <a href="{{ route('pickdrop.details', $p->id) }}">
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
<script src="{{ asset('customer/vendor/js/table.js') }}"></script>
<script src="{{ asset('customer/vendor/js/jquery.dataTables.min.js') }}"></script>
@endsection
