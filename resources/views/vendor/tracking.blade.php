@extends('vendor.app')

@section('content')
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

			<div id="printSection" align:center style="display: none;">
			<img src= {{ asset('customer/img/logo/logo.png') }} height="20%" width="20%">
			<h4 text-align:center>Delivery Report</h4>
			<h6>Weight: {{$delivery->qty}}</h6>
			<h6>Price: {{$delivery->item_price}}</h6>
			<h6>Delivery Charge: {{$delivery->delivery_charge}}</h6>
			<h6>Delivery Time: {{$delivery->delivery_time}}</h6>
			<h6>Recepient Name: {{$delivery->recipient_name}}</h6>
			<h6>Recepient Number: {{$delivery->recipient_number}}</h6>
			<h6>Recepient Address: {{$delivery->recipient_address}}</h6>
			<div id="orderID" style="display: none;">Order ID:{{$delivery->id}}</div>
		</div>
		<button onclick="printReport()" class="btn btn-primary text-uppercase">Print Report</button>
		<button id="toggleQRButton" class="btn btn-primary text-uppercase" onclick="generate()">Generate QR Code</button>
		<br><br><br>
		<div id="imgbox" style="text-align: center;">
			<img src="" id="qrimg">
		</div>
		<script src="https://cdn.rawgit.com/neocotic/qrious/4.0.2/dist/qrious.min.js"></script>
		<script>
        function generate() {
            let imagebox = document.getElementById("imgbox");
            let qrimage = document.getElementById("qrimg");
            let qrtext = document.getElementById("printSection").innerText; // Use innerText to get the text content

            // Generate QR code using the provided API
            qrimage.src = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" + encodeURIComponent(qrtext);
        }
	
			function closePopup() {
				document.getElementById("popupContainer").style.display = "none";
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
			  <div class="step @if ($delivery->is_pick == 1) active @endif">
				<span class="icon"> <i class="fa fa-user"></i> </span>
				<span class="text"> Picked by Rider</span>
			  </div>
			  @if($delivery->location)
			  <div class="step @if ($delivery->location) active @endif">
				<span class="icon"> <i class="fa fa-location"></i> </span>
				<span class="text"> Location </span>
			  </div>
			  @endif
			  <div class="step @if ($delivery->is_drop == 1) active @endif">
				<span class="icon">
				  <i class="fa fa-truck"></i>
				</span>
				<span class="text"> On the way </span>
			  </div>
			  <div class="step @if ($delivery->status == 'Completed') active @endif">
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
					@if ($delivery->status == 'Pending')
					<span class="text">Pending</span>
					@elseif ($delivery->status == 'Pending_Pickup')
						<span class="text">Pending Pickup</span>
					@elseif ($delivery->status == 'Processing')
						<span class="text">Processing</span>
					@elseif ($delivery->status == 'Completed')
						<span class="text">Completed</span>
					@endif
				  </div>
				  @if ($delivery->pickRider)
				  <div class="col-md-3 mt-4">
					@if ($delivery->is_pick == 1)
					<strong>Pick Rider:</strong> <br />{{ $delivery->pickRider->rider_name }}
					<br />
					<i class="fa fa-phone"></i> {{ $delivery->pickRider->mobile }}
					@endif
				  </div>
				  @endif

				  @if ($delivery->location)
				  <div class="col-md-2 mt-4">
					@if ($delivery->location)
					<strong>Location Now :</strong> <br />{{ $delivery->location}}
					<br />
					
					@endif
				  </div>
				  @endif

				  @if ($delivery->dropRider)
				  <div class="col-md-3 mt-4">
					@if ($delivery->is_drop == 1)
					<strong>Drop Rider:</strong><br />{{ $delivery->dropRider->rider_name }}
					<br />
					<i class="fa fa-phone"></i> {{ $delivery->dropRider->mobile }}
					@endif
				  </div>
				  @endif
				  
				  <div class="col-md-2 mt-4">
					@if ($delivery->status == 'Completed')
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


@endsection