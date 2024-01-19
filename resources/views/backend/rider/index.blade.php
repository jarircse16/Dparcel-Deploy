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
                    class="text-muted fw-light">Riders /</a> Rider List</h4>


            <!-- Hoverable Table rows -->
            <div class="card">
                <h5 class="card-header">RIDER LIST</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="table_id">
                        <thead style="background-color: #393A42">
                            <tr>
                                <th>Rider Name</th>
                                <th>Number</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($riders as $rider)
                                <tr>
                                    <td>
                                        <a href="{{ route('rider.show', $rider->id) }}">{{ $rider->rider_name }}</a>
                                    </td>
                                    <td>
                                        <p>{{ $rider->mobile }}</p>

                                    </td>
                                    @if ($rider->status == 'Active')
                                        <td><span class="badge bg-label-primary me-1">Active</span></td>
                                    @else
                                        <td><span class="badge bg-label-danger me-1">Inactive</span></td>   
                                    @endif
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('rider.edit', $rider->id)}}"><i
                                                        class="bx bx-edit-alt me-1"></i>
                                                    Edit</a>
                                                <form action="{{ route('rider.destroy', $rider->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit" onclick="return confirm('Are you sure delete this rider?')"><i
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
