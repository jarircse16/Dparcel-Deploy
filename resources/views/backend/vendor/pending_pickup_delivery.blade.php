@extends('backend.app')
@section('title', $title)


@section('content')
<!-- In your Blade view file or main layout file -->
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
<script src="{{ asset('js/select2.min.js') }}"></script>

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / </span>Pending Delivery</h4>

            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="mb-0">Pending Delivery</h5>
                            <!-- <small class="text-muted float-end">Default label</small> -->
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('pending.delivery.store', $delivery->id) }}" enctype="multipart/form-data">
                                @csrf
								@method('PUT')
								<div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Vendor Name :</label>
                                    <div class="col-sm-10">
                                        @if($delivery->vendor)
                                        <input  type="text" class="form-control" readonly
                                            id="basic-default-name" value="{{ $delivery->vendor->vendor_name }}" />
                                        <input type="hidden" name="vendor_id" class="form-control"
                                            id="basic-default-name" value="{{ $delivery->vendor_id }}" />
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Item Name :</label>
                                    <div class="col-sm-10">
                                        <input  type="text" readonly name="item_name" class="form-control"
                                            id="basic-default-name" value="{{$delivery->item_name}}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Qty :</label>
                                    <div class="col-sm-10">
                                        <input  type="number" name="qty" readonly class="form-control"
                                            id="basic-default-company" value="{{$delivery->qty}}" />
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Item Price :</label>
                                    <div class="col-sm-10">
                                        <input  type="number" name="item_price" id="item_price" readonly
                                            class="form-control phone-mask" value="{{$delivery->item_price}}" aria-label="658 799 8941"
                                            aria-describedby="basic-default-phone" />
                                    </div>
                                </div>

                                {{-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-email">Destination :</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <select id="delivery_des" name="delivery_des" class="form-control">
                                                <option disabled selected="selected">{{$delivery->delivery_des}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}

                                {{-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-email">Delivery Type :</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <select id="delivery_type" name="delivery_type" class="form-control">
                                                <option disabled selected="selected">{{$delivery->delivery_type}}</option>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                --}}

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Delivery Charge
                                        :</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="delivery_charge" id="delivery_charge"
                                            class="form-control phone-mask" value="{{$delivery->delivery_charge}}" aria-label="658 799 8941"
                                            aria-describedby="basic-default-phone" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Total Price :</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="total_price" id="total_price" readonly
                                            class="form-control phone-mask" value="{{$delivery->total_price}}" aria-label="658 799 8941"
                                            aria-describedby="basic-default-phone" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-address">Delivery Time
                                        :</label>
                                    <div class="col-sm-10">
                                        <input  name="delivery_time" type="datetime-local" class="form-control"
                                            id="basic-default-address" value="{{$delivery->delivery_time}}" />
                                    </div>
                                </div>
                                <h1>Recipiet Info</h1>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-address">Recipiet Name
                                        :</label>
                                    <div class="col-sm-10">
                                        <input  name="recipient_name" readonly type="text" class="form-control"
                                            id="basic-default-address" value="{{$delivery->recipient_name}}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-address">Recipiet Number
                                        :</label>
                                    <div class="col-sm-10">
                                        <input  name="recipient_number" readonly type="number" class="form-control"
                                            id="basic-default-address" value="{{$delivery->recipient_number}}" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-address">Recipiet Address
                                        :</label>
                                    <div class="col-sm-10">
                                        <input  name="recipient_address" readonly type="text" class="form-control"
                                            id="basic-default-address" value=" {{$delivery->recipient_address}}" />
                                    </div>
                                </div>

								{{-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-email">Pick Rider :</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <select id="pick_rider" name="pick_rider" class="form-control" required>
                                                <option disabled selected="selected">Choose</option>
												@foreach($riders as $rider)
												<option value="{{$rider->id}}">{{$rider->rider_name}}</option>
												@endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-email">Pick Rider :</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <select id="pick_rider" name="pick_rider" class="form-control" required>
                                                <option disabled selected="selected">Choose</option>
                                                @foreach($riders as $rider)
                                                    <option value="{{$rider->id}}">{{$rider->rider_name}}</option>
                                                @endforeach
                                            </select><div><div>
                                            <input type="text" id="manual_pick_rider" name="manual_pick_rider" class="form-control" placeholder="Type or select a rider">
                                        </div></div>
                                    </div>
                                    </div>
                                </div>
                                
                                <script>
                                    $(document).ready(function() {
                                        $('#pick_rider').select2({
                                            theme: 'bootstrap4', // Optional: Use a Bootstrap 4 theme
                                            placeholder: 'Search for a rider',
                                            allowClear: true, // Allow clearing the selected option
                                            minimumInputLength: 1, // Minimum characters before a search is performed
                                            ajax: {
                                                url: '/search-riders', // Replace with your backend route for searching riders
                                                dataType: 'json',
                                                delay: 250, // Delay in milliseconds before a search is performed
                                                processResults: function(data) {
                                                    return {
                                                        results: data
                                                    };
                                                },
                                                cache: true
                                            }
                                        });
                                
                                        // Enable manual entry
                                        $('#manual_pick_rider').on('input', function() {
                                            var inputValue = $(this).val();
                                            $('#pick_rider').val(null).trigger('change');
                                            $('#pick_rider').append('<option value="' + inputValue + '" selected>' + inputValue + '</option>').trigger('change');
                                        });
                                    });
                                </script>
                                

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Reason :</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="status_description"
                                            class="form-control phone-mask" value="{{$delivery->status_description}}" aria-label="658 799 8941"
                                            aria-describedby="basic-default-phone" />
                                    </div>
                                </div>



                                <div class="row d-flex justify-content-center align-items-center">
                                    <div
                                        class="col-lg-12 d-flex justify-content-center align-items-center gap-4 form-button">
                                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                                        <a href="{{ URL::previous() }}">
                                            <button type="button"
                                            class="btn rounded-pill btn-outline-warning">DISCARD</button>
                                        </a>
                                        
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
        <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->



@endsection



@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<script>
    
    $(document).ready(function () {
        $('select[name="delivery_des"]').on('change', function () {
            var delivery_des = $(this).val();
            var delivery_type = $('select[name="delivery_type"]').val();
            var item_price = $('#item_price').val();
           
            
            // if inside city then delivery_charge = item_price * 50
            if (delivery_des == 'inside_city') {
                var delivery_charge = 50;
                $('#delivery_charge').val(delivery_charge);
                var total_price = parseInt(item_price) + parseInt(delivery_charge);
                $('#total_price').val(total_price);
            }
            // if outside city then delivery_charge = item_price * 100
            else if (delivery_des == 'outside_city' && delivery_type == 'cash_on') {
                var delivery_charge = 100;
                $('#delivery_charge').val(delivery_charge);
                var total_price = parseInt(item_price) + parseInt(delivery_charge);
                $('#total_price').val(total_price);
            }
            else if (delivery_des == 'outside_city' && delivery_type == 'online_payment') {
                var delivery_charge = 100;
                $('#delivery_charge').val(delivery_charge);
                var total_price = parseInt(item_price) + parseInt(delivery_charge);
                $('#total_price').val(total_price);
            }
            else {
                $('#delivery_charge').val('');
                $('#total_price').val('');
            }
        });
    });

</script>


<script>
    $(document).ready(function () {
    // Function to calculate total amount
    function calculateTotalAmount() {
        var itemPrice = parseFloat($('#item_price').val()) || 0;
        var deliveryCharge = parseFloat($('#delivery_charge').val()) || 0;

        var totalAmount = itemPrice + deliveryCharge;

        // Update the total price field
        $('#total_price').val(totalAmount.toFixed(2));
    }

    // Event handler for item price change
    $('#item_price').on('input', function () {
        calculateTotalAmount();
    });

    // Event handler for delivery charge change
    $('#delivery_charge').on('input', function () {
        calculateTotalAmount();
    });

    // Event handler for delivery destination change
    $('select[name="delivery_des"]').on('change', function () {
        // Assuming this event should trigger the calculation
        calculateTotalAmount();
    });

    // Set the total price field as readonly
    $('#total_price').attr('readonly', true);
});
</script>
@endsection
