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
                    class="text-muted fw-light">Vendors /</a> Vendor List</h4>
            <!-- Hoverable Table rows -->
            <div class="card">
                <h5 class="card-header">VENDOR LIST</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="table_id">
                        <thead style="background-color: #393A42">
                            <tr>
                                <th>Owner Name</th>
                                <th>Vendor Name</th>
                                <th>Number</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($vendors as $vendor)
                                <tr>
                                    <td class="text-wrap">
                                        <a href="{{ route('vendor.show', $vendor->id) }}">
											{{ $vendor->owner_name }}
										</a>
                                    </td>
                                    <td class="text-wrap">
                                        {{ $vendor->vendor_name }}
									</td>
                                    <td class="text-wrap">
                                        <p>{{ $vendor->mobile }}</p>

                                    </td>
                                    <td><span class="badge bg-label-primary me-1">Active</span></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('vendor.edit', $vendor->id)}}"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Edit</a>
                                                <form action="{{ route('vendor.destroy', $vendor->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit" onclick="return confirm('Are you sure delete this vendor?')"><i
                                                        class="bx bx-trash me-1"></i>
                                                    Delete</button>
                                                </form>
                                                
                                                
                                            </div>
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

@section('script')
<script src="{{ asset('customer/vendor/js/table.js') }}"></script>
<script src="{{ asset('customer/vendor/js/jquery.dataTables.min.js') }}"></script>
@endsection