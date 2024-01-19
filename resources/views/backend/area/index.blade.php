@extends('backend.app')
@section('title', $title)


@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><a href="#" class="text-muted fw-light">Dashboard /</a> <a href="#"
                    class="text-muted fw-light">Area /</a> Area List</h4>


            <!-- Hoverable Table rows -->
            <div class="card">
                <h5 class="card-header">Area LIST</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover" id="table_id">
                        <thead>
                            <tr>
                                <th>Area Name</th>
                                <th>Division</th>
                                <th>District</th>
                                <th>Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($areas as $area)
                                <tr>
                                    <td>
                                        <a href="{{ route('area.edit', $area->id) }}">{{ $area->area_name }}</a>
                                    </td>
                                    <td>
                                        @if ($area->division)
                                            {{ $area->division->division_name }}
                                        @endif

                                    </td>

                                    <td>
                                        @if ($area->district)
                                            {{ $area->district->district_name }}
                                        @endif
                                    </td>
                                    @if ($area->status == 'Active')
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
                                                <a class="dropdown-item" href="{{route('area.edit', $area->id)}}"><i
                                                        class="bx bx-edit-alt me-1"></i>
                                                    Edit</a>
                                                    <form action="{{ route('area.destroy', $area->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="dropdown-item" type="submit" onclick="return confirm('Are you sure delete this area?')"><i
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
