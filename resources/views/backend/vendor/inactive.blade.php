@extends('backend.app')
@section('title', $title)

@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><a href="#" class="text-muted fw-light">Dashboard /</a> <a href="#"
                    class="text-muted fw-light">Vendor /</a>Pending List</h4>


            <!-- Hoverable Table rows -->
            <div class="card">
                <h5 class="card-header">Inactive Vendor List</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="table_id">
                        <thead style="background-color: #393A42">
                            <tr>
                                <th>Vendor Name</th>
                                <th>Username</th>
                                <th>Number</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($vendors as $key => $vendor)
                                <tr>
                                    <td>
                                        <a href="{{ route('vendor.show', $vendor->id) }}">
                                            {{ $vendor->vendor_name }} 
										</a>
                                    </td>
                                    <td>
                                        {{ $vendor->username }}
                                    </td>
                                    <td>
                                        <p>{{ $vendor->mobile }}</p>

                                    </td>
                                    <td>
                                        <p>{{ $vendor->email }}</p>

                                    </td>
									
									<td><span class="badge bg-label-danger me-1">InActive</span></td>
	
                                    <td>

                                        <div class="d-flex flex-wrap flex-row">
                                            @if ($vendor->status == 'Inactive')
                                                <form action="{{ route('active.vendor.store', $vendor->id) }}" method="POST">
                                                    @csrf
                                                    {{-- <input type="hidden" name="delivery_id" value="{{$delivery->id}}"> --}}
                                                    <button type="submit" class="badge bg-primary me-1">
                                                        Approve
                                                    </button>
                                                </form> 

												<form action="{{ route('vendor.destroy', $vendor->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge bg-danger me-1" onclick="return confirm('Are you sure delete this vendor?')">
                                                    Delete</button>
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
