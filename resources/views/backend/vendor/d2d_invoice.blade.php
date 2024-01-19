@extends('backend.app')


@section('css')
    <link rel="stylesheet" href="{{ asset('customer/css/jquery.dataTables.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer/vendor/css/invoice.css') }}" />
@endsection

@section('content')


<!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="fw-bold py-3 mb-4">
	  <a href="#" class="text-muted fw-light">Dashboard /</a>
	  <a href="#" class="text-muted fw-light">My Orders /</a> Invoice
	</h4>

	<!-- Hoverable Table rows -->
	<div class="card">
	  <!-- <h5 class="card-header">Tracking Detail</h5> -->
	  <div class="container py-5">
		<div class="tm_container">
		  <div class="tm_invoice_wrap">
			<div class="tm_invoice tm_style1" id="tm_download_section">
			  <div class="tm_invoice_in">
				<div class="tm_invoice_head tm_mb20 tm_align_center">
				  <div class="tm_invoice_left">
					<div class="tm_logo">
					  <img src="{{ asset('customer/img/logo/dmanLogoDark.png') }}" alt="Logo" width="200px" />
					</div>
				  </div>
				  <div class="tm_invoice_right tm_text_right">
					<div class="tm_primary_color tm_f30 tm_medium">
					  Invoice
					</div>
				  </div>
				</div>
				<div class="tm_invoice_info tm_mb30">
				  <div class="tm_invoice_seperator tm_gray_bg"></div>
				  <div class="tm_invoice_info_list">
					<p class="tm_invoice_number tm_m0">
					  Invoice No:
					  <b class="tm_primary_color">#{{$delivery->id}}</b>
					</p>
					<p class="tm_invoice_date tm_m0">
					  Date:
					  <b class="tm_primary_color">{{ $delivery->created_at }}</b>
					</p>
				  </div>
				</div>
				<div class="tm_table tm_style1 tm_mb30">
				  <div class="tm_round_border">
					<div class="tm_table_responsive">
					  <table>
						<thead>
						  <tr>
							<th class="tm_gray_bg tm_primary_color tm_border_left">
							  Vendor Information
							</th>
							<th class="tm_gray_bg tm_primary_color tm_border_left">
							  Customer Information
							</th>
							<th class="tm_gray_bg tm_primary_color tm_border_left">
							  Rider Information
							</th>
						  </tr>
						</thead>
						<tbody>
						  <tr>
							<td>
							  <b class="tm_primary_color">Vendor Name:</b>
							  {{ $delivery->vendor->vendor_name }}
							  <br>
							  <b class="tm_primary_color">Owner Name:</b>
							  {{ $delivery->vendor->owner_name }}
							</td>
							<td class="tm_border_left">
							  <b class="tm_primary_color">Name:</b>
							  {{ $delivery->recipient_name }}
							  <br>
							  <b class="tm_primary_color">Address:</b>
							  {{ $delivery->recipient_address }}
							</td>
							<td class="tm_border_left">
							  <b class="tm_primary_color">Pick Rider:</b>
							  @if ($delivery->pickRider == null)
							  {{ __('No Rider') }}
							  @else
							  {{ $delivery->pickRider->rider_name }}
							  @endif
								<br>
							  <b class="tm_primary_color">Rider Number:</b>
							  @if ($delivery->pickRider == null)
							  {{ __('No Rider') }}
							  @else
							  {{ $delivery->pickRider->mobile }}
							  @endif
		
							</td>
						  </tr>
						  <tr>
							<td>
							  <b class="tm_primary_color">Number:</b>
							  {{ $delivery->vendor->mobile }}
							</td>
							<td class="tm_border_left">
							  <b class="tm_primary_color">Number:</b>
							  {{ $delivery->recipient_number }}
							</td>
							<td class="tm_border_left">
								<b class="tm_primary_color">Drop Rider:</b>
								@if ($delivery->dropRider == null)
									{{ __('No Rider') }}
								@else
									{{ $delivery->dropRider->rider_name }}
								@endif
							
								  <br>
								<b class="tm_primary_color">Rider Number:</b>
								@if ($delivery->dropRider == null)
									{{ __('No Rider') }}
								@else
									{{ $delivery->dropRider->mobile }}
								@endif
								
							</td>
						  </tr>
						</tbody>
					  </table>
					</div>
				  </div>
				</div>

				<div class="tm_table tm_style1 tm_mb30">
				  <div class="tm_round_border">
					<div class="tm_table_responsive">
					  <table>
						<thead>
						  <tr>
							<th class="tm_width_6 tm_semi_bold tm_primary_color tm_gray_bg" colspan="5">
							  Payment Information
							</th>
						  </tr>
						  <tr class="tm_border_top">
							<th class="tm_width_5 tm_semi_bold tm_primary_color">
							  Item
							</th>
							<th class="tm_width_2 tm_semi_bold tm_primary_color">
							  Item Price
							</th>
							<th class="tm_width_1 tm_semi_bold tm_primary_color">
								Delivery Charge
							</th>
							<th class="tm_width_2 tm_text_right tm_semi_bold tm_primary_color">
							  Total
							</th>
						  </tr>
						</thead>
						<tbody>
						@foreach ($deliveries as $delivery)
						  <tr>
							<td class="tm_width_5">
							  {{$delivery->item_name}}
							  <br />
							  Date: {{ $delivery->created_at->format('d M Y') }}
							</td>
							<td class="tm_width_2">
								৳{{$delivery->item_price}}
							</td>
							<td class="tm_width_2">
								৳{{$delivery->delivery_charge}}
							</td>
							<td class="tm_width_2 tm_text_right">
								@if ($delivery->delivery_type == 'cash on delivery' && $delivery->delivery_des == 'outside city')
									@php
										$item_price = $delivery->item_price * 0.01;
										$vendor_price = $delivery->total_price - $item_price;

									@endphp
									৳{{ $vendor_price }} 
									<br>
									(after 1%)
								@else
									৳{{ $delivery->total_price }}
								@endif
							  
							</td>
						  </tr>
						  @endforeach
						</tbody>
					  </table>
					</div>
				  </div>
				  <div class="tm_invoice_footer">
					<div class="tm_left_footer"></div>
					<div class="tm_right_footer">
					  <table>
						<tbody>
						  <tr>
							<td class="tm_width_3 tm_primary_color tm_border_none">
							  Subtoal
							</td>
							<td class="tm_width_3 tm_primary_color tm_text_right tm_border_none">
								
								{{-- save the total price of all deliveries --}}
								@php
									$total_price = 0;
								@endphp
								@foreach ($deliveries as $delivery)
								
									@if($delivery->delivery_type == 'cash on delivery' && $delivery->delivery_des == 'outside city')
										@php
											$item_price = $delivery->item_price * 0.01;
											$vendor_price = $delivery->total_price - $item_price;
											$total_price += $vendor_price;
										@endphp

									@else
										@php
											$total_price += $delivery->total_price;
										@endphp
									@endif
								@endforeach
								৳{{ $total_price }}
							
							</td>
						  </tr>
						</tbody>
					  </table>
					</div>
				  </div>
				</div>
				<p class="tm_m0 tm_text_center tm_primary_color">
				  Thank you for choosing Dman as your delivary partner
				  🙂
				</p>
			  </div>
			</div>
			<div class="tm_invoice_btns tm_hide_print">
			  <a href="#" onclick="printDiv('tm_download_section')" class="tm_invoice_btn tm_color1">
				<span class="tm_btn_icon">
				  <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
					<path
					  d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24"
					  fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
					<rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none"
					  stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
					<path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none"
					  stroke="currentColor" stroke-linejoin="round" stroke-width="32" />
					<circle cx="392" cy="184" r="24" fill="currentColor" />
				  </svg>
				</span>
				<span class="tm_btn_text">Print</span>
			  </a>
			  <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
				<span class="tm_btn_icon">
				  <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
					<path
					  d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03"
					  fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
					  stroke-width="32" />
				  </svg>
				</span>
				<span class="tm_btn_text">Download</span>
			  </button>
			</div>
		  </div>
		</div>
	  </div>
	</div>
	<!--/ Hoverable Table rows -->

	<hr class="my-5" />
  </div>
  <!-- / Content -->

@endsection

@section('script')
    <script src="https://kit.fontawesome.com/8d65650676.js" crossorigin="anonymous"></script>
    <script src="{{ asset('customer/vendor/js/table.js') }}"></script>
    <script src="{{ asset('customer/vendor/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('customer/vendor/js/jspdf.min.js') }}"></script>
    <script src="{{ asset('customer/vendor/js/html2canvas.min.js') }}"></script>

	<script>
		function printDiv(tm_download_section) {
		  var printContents =
			document.getElementById(tm_download_section).innerHTML;
		  var originalContents = document.body.innerHTML;
	
		  document.body.innerHTML = printContents;
	
		  window.print();
	
		  document.body.innerHTML = originalContents;
		}
	</script>
	
@endsection
