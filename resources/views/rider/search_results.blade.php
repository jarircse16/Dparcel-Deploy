<!-- resources/views/rider/search_results.blade.php -->

@extends('rider.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Search Results for "{{ $searchTerm }}"</h4>

        @if ($results->isEmpty())
            <p>No results found.</p>
        @else
            <!-- Display the search results in a table -->
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <!-- Add more table headers based on your data structure -->
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Address</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $result)
                        <tr>
                            <td>{{ $result->id }}</td>
                            <!-- Add more table cells based on your data structure -->
                            <td>{{ $result->name }}</td>
                            <td>{{ $result->email }}</td>
                            <td>{{ $result->mobile }}</td>
                            <td>{{ $result->address }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
