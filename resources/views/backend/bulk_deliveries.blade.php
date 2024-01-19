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
            <h4 class="fw-bold py-3 mb-4"><a href="{{ URL::previous() }}" class="text-muted fw-light">Dashboard /</a> <a
                    href="#" class="text-muted fw-light">Vendors /</a> Vendor List</h4>
            <!-- Hoverable Table rows -->
            <div class="card">
                <h5 class="card-header">Bulk Delivery List</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="table_id">
                        <thead style="background-color: #393A42">
                            <tr>
                                <th>Upload Date</th>
                                <th>Vendor Name</th>
                                <th>Number</th>
                                <th>File</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($bulk_delivery as $b)
                                <tr>
                                    <td class="text-wrap">
                                        {{ $b->created_at->format('d-m-Y') }}
                                    </td>
                                    <td class="text-wrap">
                                        <a href="{{ route('vendor.show', $b->vendor->id) }}">
                                            {{ $b->vendor->vendor_name }}
                                        </a>
                                    </td>
                                    <td class="text-wrap">
                                        {{ $b->vendor->mobile }}
                                    </td>
                                    <td class="text-wrap">
                                       
                                        @if ($b->excel_file)
                                            <a href="{{ asset('uploads/vendor/profile/' . $b->excel_file) }}"
                                                target="_blank" download>
                                                Download
                                            </a>
                                        @else
                                            File not available
                                        @endif
                                    </td>
                                    <td><span class="badge bg-label-primary me-1">Active</span></td>

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
