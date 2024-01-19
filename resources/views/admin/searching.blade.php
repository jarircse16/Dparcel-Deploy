@extends('admin.app')
@section('content')
@if(session('message'))
    {{-- <div class="alert alert-success"> --}}
        {{-- {{ session('message') }} --}}
    {{-- </div> --}}
@endif
<style>
	/* Your regular styles go here */

	/* Styles for print */
	@media print {
		body * {
			visibility: hidden;
		}

		#printSection, #printSection * {
			visibility: visible;
		}

		#printSection {
			position: absolute;
			left: 0;
			top: 0;
		}

		/* Additional print-specific styling as needed */
	}
</style>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
 <!-- Content -->

 <div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="fw-bold py-3 mb-4">
	  <a href="{{ URL::previous() }}" class="text-muted fw-light">Dashboard /</a>
	  <a href="#" class="text-muted fw-light">My Orders /</a> Tracking
	</h4>

	<!-- Hoverable Table rows -->
	<div class="card">
	  <!-- <h5 class="card-header">Tracking Detail</h5> -->
	  <div class="container py-5">
		<article class="tracking">
		  <!-- <header class="card-header"> My Orders / Tracking </header> -->
		  <div class="track-detail">
			<button id="toggleReportButton" class="btn btn-primary text-uppercase">View Report</button>
			<button onclick="printReport()" class="btn btn-primary text-uppercase">Print Report</button>
			<button id="toggleQRButton" class="btn btn-primary text-uppercase" onclick="generate()">Generate QR Code</button>
			
		<div id="printSection" align:center style="display: none;">
				@if($latestDelivery)
					<img src="{{ asset('customer/img/logo/logo.png') }}" height="20%" width="20%">
					<h4 text-align:center>Delivery Report</h4>
					<h6>Weight: {{ $latestDelivery->qty }}</h6>
					<h6>Price: {{ $latestDelivery->item_price }}</h6>
					<h6>Delivery Charge: {{ $latestDelivery->delivery_charge }}</h6>
					<h6>Delivery Time: {{ $latestDelivery->delivery_time }}</h6>
					<h6>Recepient Name: {{ $latestDelivery->recipient_name }}</h6>
					<h6>Recepient Number: {{ $latestDelivery->recipient_number }}</h6>
					<h6>Recepient Address: {{ $latestDelivery->recipient_address }}</h6>
					<div id="orderID" style="display: none;">Order ID: {{ $latestDelivery->id }}</div>
					<div id="qrcode"></div>
				@else
					<p>No delivery information available.</p>
				@endif
			</div>
		</div>
		
		<br><hr style="text-align: center; display:none;">
		<h6 style="text-align: center; display:none;">Scan the QR Code below to get Delivery Report.</h6>
		<br><hr style="text-align: center; display:none;">
		<div id="imgbox" style="text-align: center;">
			<img src="" id="qrimg">
		</div>
		<hr style="text-align: center; display:none;">
		
		<script src="https://cdn.rawgit.com/neocotic/qrious/4.0.2/dist/qrious.min.js"></script>
		<script type="text/javascript">
	
			function generate() {
				let imagebox = document.getElementById("imgbox");
				let qrimage = document.getElementById("qrimg");
				let qrtext = document.getElementById("printSection").innerText; // Use innerText to get the text content
	
				// Generate QR code using the provided API
				qrimage.src = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" + encodeURIComponent(qrtext);
			}
		</script>
		
		<script>
			// Function to handle printing
			function printReport() {
        	$('#printSection').show(); // Show the hidden section
        	window.print(); // Trigger print dialog
        	$('#printSection').hide(); // Hide the section again
    	}
		</script>
		<script>
			$(document).ready(function () {
				// Toggle visibility and change button text
				$('#toggleReportButton').on('click', function () {
					$('#printSection').toggle();
					var buttonText = $('#printSection').is(':visible') ? 'Hide Report' : 'View Report';
					$('#toggleReportButton').text(buttonText);
				});
			});
		</script>
			<div class="track">
			  <div class="step active">
				<span class="icon">
				  <i class="fa fa-check"></i>
				</span>
				<span class="text">Order Placed</span>
			  </div>
			  <div class="step @if ($latestDelivery->is_pick == 1) active @endif">
				<span class="icon"> <i class="fa fa-user"></i> </span>
				<span class="text"> Picked by Rider</span>
			  </div>
			  @if($latestDelivery->location)
			  <div class="step @if ($latestDelivery->location) active @endif">
				<span class="icon"> <i class="fa fa-location"></i> </span>
				<span class="text"> Location </span>
			  </div>
			  @endif
			  <div class="step @if ($latestDelivery->is_drop == 1) active @endif">
				<span class="icon">
				  <i class="fa fa-truck"></i>
				</span>
				<span class="text"> On the way </span>
			  </div>
			  <div class="step @if ($latestDelivery->status == 'Completed') active @endif">
				<span class="icon">
				  <i class="fa fa-check"></i>
				</span>
				<span class="text">Delivered</span>
			  </div>
			</div>
			<!-- <hr> -->
			<div class="mt-4">
			  <article class="card py-5">
				<div class="track-detail row">
				  <div class="col-md-2 mt-4">
					<strong>Status:</strong> <br />
					@if ($latestDelivery->status == 'Pending')
					<span class="text">Pending</span>
					@elseif ($latestDelivery->status == 'Pending_Pickup')
						<span class="text">Pending Pickup</span>
					@elseif ($latestDelivery->status == 'Processing')
						<span class="text">Processing</span>
					@elseif ($latestDelivery->status == 'Completed')
						<span class="text">Completed</span>
					@endif
				  </div>
				  @if ($latestDelivery->pickRider)
				  <div class="col-md-3 mt-4">
					@if ($latestDelivery->is_pick == 1)
					<strong>Pick Rider:</strong> <br />{{ $latestDelivery->pickRider->rider_name }}
					<br />
					<i class="fa fa-phone"></i> {{ $latestDelivery->pickRider->mobile }}
					@endif
				  </div>
				  @endif

				  @if ($latestDelivery->location)
				  <div class="col-md-2 mt-4">
					@if ($latestDelivery->location)
					<strong>Location Now :</strong> <br />{{ $latestDelivery->location}}
					<br />
					
					@endif
				  </div>
				  @endif

				  @if ($latestDelivery->dropRider)
				  <div class="col-md-3 mt-4">
					@if ($latestDelivery->is_drop == 1)
					<strong>Drop Rider:</strong><br />{{ $latestDelivery->dropRider->rider_name }}
					<br />
					<i class="fa fa-phone"></i> {{ $latestDelivery->dropRider->mobile }}
					@endif
				  </div>
				  @endif
				  
				  <div class="col-md-2 mt-4">
					@if ($latestDelivery->status == 'Completed')
					<strong>Completed</strong> <br />
					@endif
				  </div>
				</div>
			  </article>
			</div>

			<div class="row d-flex justify-content-center align-items-center">
			  <div
				class="col-lg-12 d-flex flex-wrap justify-content-center align-items-center gap-2 form-button">
			
				<a href="{{ URL::previous() }}">
					
				<button type="submit" class="btn btn-primary text-uppercase">
					<i class="fa fa-chevron-left"></i> Back to orders
				  </button>
				</a>
			  </div>
			</div>
		  </div>
		</article>
	  </div>
	</div>
	<!--/ Hoverable Table rows -->

	<hr class="my-5" />
  </div>
  <!-- / Content -->

@endsection

@section('scripts')

<script src="https://kit.fontawesome.com/8d65650676.js" crossorigin="anonymous"></script>

<footer class="content-footer footer bg-footer-theme">
	<div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
		<div class="mb-2 mb-md-0">
			Copyright
			<script>
				document.write(new Date().getFullYear());
			</script>
			© DmanBD.com | All rights reserved. 

		</div>
		<div>
			Developed by C3 Studio
		</div>
	</div>
</footer>
@endsection