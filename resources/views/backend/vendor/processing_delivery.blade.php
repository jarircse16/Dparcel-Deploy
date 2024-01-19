@extends('backend.app')
@section('title', $title)

@section('css')
<link rel="stylesheet" href="{{ asset('customer/css/jquery.dataTables.css') }}" />

@endsection

@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
<form method="POST" action="{{ route('processing.delivery.storex') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><a href="#" class="text-muted fw-light">Dashboard /</a> <a href="#"
                    class="text-muted fw-light">Vendors /</a> PROCESSING DELIVERY LIST</h4>

                    <!-- drop rider -->
                     {{-- <div class="input-group input-group-merge">
                                            <select required id="drop_rider" name="drop_rider" class="form-control" >
                                                <option disabled selected value="">Choose</option>
												@foreach($riders as $rider)
												<option value="{{$rider->id}}">{{$rider->rider_name}}</option>
												@endforeach
                                            </select>
                                        </div>  --}}
                                        <!-- drop rider --> 

            <!-- Hoverable Table rows -->
            <div class="card">
                <div style="display:flex; gap:40px; margin:10px; align-items: center;">
                    <h5 class="card-header">PROCESSING DELIVERY LIST</h5>
                    <div style="display:flex; gap:20px;">
                        <!-- drop rider -->
                         
                                            <div class="input-group input-group-merge" style="width:130px; height:30px;  ">
                                                <select style="background-color:#393A42; color:white; " required id="drop_rider" name="drop_rider"class="form-control">
                                                    <option style="text-align: center;" disabled selected value="">Choose Rider</option>
                                                    @foreach($riders as $rider)
                                                    <option value="{{$rider->id}}">{{$rider->rider_name}}</option>
                                                    @endforeach 
                                                </select>
                                            </div>
                                            <!-- drop rider -->
                                            <button style="height:38px; color:black; " type="submit" class="btn btn-primary">Drop rider</button>
    </div>
    </div>
                {{-- <h5 class="card-header">PROCESSING DELIVERY LIST</h5> --}}
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="table_id">
                        <thead style="background-color: #393A42">
                            <tr>
                                <th></th>
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
                                    <!-- new td added -->
                                    <td> <input class="form-check-input" type="checkbox" value="{{$delivery->id}}" name="delivery[]" id="flexCheckDefault"></td>
                                    <!-- new td added -->
									<td>{{$delivery->id}}</td>
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
                                        <a href="{{ route('vendor.complete', $delivery->id) }}">
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
        {{-- <button type="submit" class="btn btn-primary">SUBMIT</button> --}}
</form>
    </div>
    <!-- Content wrapper -->

@endsection

@section('script')
<script src="{{ asset('customer/vendor/js/table.js') }}"></script>
<script src="{{ asset('customer/vendor/js/jquery.dataTables.min.js') }}"></script>


@endsection
