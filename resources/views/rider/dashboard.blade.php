
@extends('rider.app')
{{-- @php
$conn=mysqli_connect("localhost", "root", "", "test_dparcel");
if(mysqli_connect_errno()){
echo "Connection Fail".mysqli_connect_error();
}

// Handle the search request
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
    $searchTerm = $_GET["search"];

    // Perform the search query
    $sql = "SELECT pick_drops.*, vendors.vendor_name, vendors.mobile, vendors.address 
            FROM pick_drops
            LEFT JOIN vendors ON pick_drops.id = vendors.id 
            WHERE pick_drops.item_name LIKE '%$searchTerm%' 
            OR pick_drops.qty LIKE '%$searchTerm%' 
            OR vendors.vendor_name LIKE '%$searchTerm%' 
            OR vendors.mobile LIKE '%$searchTerm%' 
            OR vendors.address LIKE '%$searchTerm%'";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display search results
        echo "<h2>Search Results:</h2>";
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Item Name</th><th>Qty</th><th>Vendor Name</th><th>Mobile</th><th>Address</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>{$row['id']}</td><td>{$row['item_name']}</td><td>{$row['qty']}</td><td>{$row['vendor_name']}</td><td>{$row['mobile']}</td><td>{$row['address']}</td></tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No results found.</p>";
    }

    // Close the database connection
    $conn->close();
}
@endphp --}}
@section('content')
    <!-- Layout wrapper -->
    <!-- Add this to the head section -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

               
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">

                                      <!-- Search Box -->
                            <div class="mb-3">
                                <form id="searchForm" method="GET">
                                    <!-- <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search rider information..." id="search" name="search">
                                        <button type="submit" onclick="performSearch()" class="btn btn-primary">Search</button>
                                    </div> -->
                                    <div class="input-group mb-3" style="display: flex; align-items: center; justify-content: center; height: 7vh; margin: 0; background: linear-gradient(to right, #808080, #FFFFFF);">
                                    <div style="display: flex; max-width: 400px; width: 100%; background-color: #fff; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); border-radius: 4px; overflow: hidden;">
                                    <input id="search" name="search" class="form-control" aria-label="Search" type="text" style="flex: 1; padding: 10px; border: none; outline: none; font-size: 16px;" placeholder="Search rider information...">
                                    <button type="submit"  onclick="performSearch()"  style="background: linear-gradient(to right, #ffeb3b, #ff9800); color: #000; border: none; padding: 10px; cursor: pointer;">Search</button>
                                </div>
                            </div>
                                </form>
                                <div id="searchResultsContainer"></div>
                            </div>
                            <!-- /Search Box -->

                            @if(isset($searchResults))
                                <h4 class="vendor-title">Search Results</h4>
                                <!-- Display your search results here -->
                                {{-- For example, you can loop through the results and display them in a table --}}
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Rider Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <!-- Add other columns as needed -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($searchResults as $rider)
                                            <tr>
                                                <td>{{ $rider->id }}</td>
                                                <td>{{ $rider->rider_name }}</td>
                                                <td>{{ $rider->email }}</td>
                                                <td>{{ $rider->phone }}</td>
                                                td>{{ $rider->address }}</td>
                                                <!-- Add other columns as needed -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                            
                            <!-- Vendor Food Orders row -->
                            <hr class="vendor-seperate">
                            <div class="row">
                                <h4 class="vendor-title">Rider Dashboard</h4>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('pending.pickup.delivery') }}" style="color: black">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i style="color:black;" class='vendor-icon bx bx-notepad'></i>
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Pending Pickup</span>
                                            <h3 class="card-title mb-2">{{$pending_pickups->count()}}</h3>

                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('pending.drop.delivery') }}" style="color: black">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">

                                                    <i style="color:black;" class='vendor-icon bx bx-cube-alt'></i>
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Pending Drops</span>
                                            <h3 class="card-title mb-2">{{$pending_drops->count()}}</h3>

                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('rider.pickup.delivery') }}" style="color: black">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                <i style="background-color: #f7b614;padding:12px 10px 12px 10px;font-size: 18px;border-radius: 100px;" class="fa-solid fa-truck-ramp-box"></i>
                                                </div>
                                            </div>
                                            <span>Completed Pickup </span>
                                            <h3 class="card-title text-nowrap mb-1">{{$total_pickups->count()}}</h3>

                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('rider.drop.delivery') }}" style="color: black">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                <i style="background-color: #f7b614;padding:12px 12px 12px 12px;font-size: 18px;border-radius: 100px;" class="fa-solid fa-dove"></i>
                                                </div>
                                            </div>
                                            <span>Completed Drop</span>
                                            <h3 class="card-title text-nowrap mb-1">{{$total_drops->count()}}</h3>
                                            <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div>
                            <hr class="vendor-seperate">
                            <!-- Pick & Drops row -->
                            {{-- <div class="row">
                                <h4 class="vendor-title">Rider Dashboard</h4>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('pending.pickup.delivery') }}" style="color: black">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='vendor-icon bx bx-notepad'></i>
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Total Pickups</span>
                                            <h3 class="card-title mb-2">{{$total_pickups->count()}}</h3>

                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('pending.drop.delivery') }}" style="color: black">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">

                                                    <i class='vendor-icon bx bx-cube-alt'></i>
                                                </div>
                                            </div>
                                            <span class="fw-semibold d-block mb-1">Total Drops</span>
                                            <h3 class="card-title mb-2">{{$total_drops->count()}}</h3>

                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('rider.pickup.delivery') }}" style="color: black">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='vendor-icon bx bx-check'></i>
                                                </div>
                                            </div>
                                            <span>Pending Pickup </span>
                                            <h3 class="card-title text-nowrap mb-1">{{$pending_pickups->count()}}</h3>

                                        </div>
                                    </div>
                                </a>
                                </div>
                                <div class="col-lg-3 col-md-6 col-6 mb-4">
                                    <a href="{{ route('rider.drop.delivery') }}" style="color: black">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-title d-flex align-items-start justify-content-between">
                                                <div class="avatar flex-shrink-0">
                                                    <i class='vendor-icon bx bx-check'></i>
                                                </div>
                                            </div>
                                            <span>Pending Drop</span>
                                            <h3 class="card-title text-nowrap mb-1">{{$total_pickdrops->count()}}</h3>
                                            <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.42%</small> -->
                                        </div>
                                    </div>
                                </a>
                                </div>
                            </div> --}}

                            <div class="content-backdrop fade"></div>
                        </div>
                        <!-- Content wrapper -->
                    </div>
                    <!-- / Layout page -->
                </div>

                <!-- Overlay -->
                <div class="layout-overlay layout-menu-toggle"></div>
            </div>
            <!-- / Layout wrapper -->
        </div>
    </div>
    <script>
        // AJAX request on form submission
        $('#searchForm').submit(function (e) {
            e.preventDefault(); // Prevent default form submission
            var formData = $(this).serialize();
    
            $.ajax({
                type: 'GET',
                url: '{{ route('rider.search') }}',
                data: formData,
                success: function (data) {
                    $('#searchResultsContainer').html(data); // Update the content with search results
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        });
    </script>
    <script>
// function performSearch() {
//     var searchTerm = document.getElementById('search').value;

//     // AJAX request
//     var xhr = new XMLHttpRequest();
//     xhr.open('GET', '<?php echo $_SERVER["PHP_SELF"]; ?>?search=' + searchTerm, true);

//     xhr.onreadystatechange = function() {
//         if (xhr.readyState == 4 && xhr.status == 200) {
//             // Update the content of the search results container
//             document.getElementById('searchResultsContainer').innerHTML = xhr.responseText;
//         }
//     };

//     xhr.send();
// }
</script>
    @endif
@endsection
