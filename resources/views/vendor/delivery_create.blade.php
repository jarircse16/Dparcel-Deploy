@extends('vendor.app')
@section('title', $title)


@section('content')

    <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard / </span>Add New Delivery</h4>

            <!-- Basic Layout & Basic with Icons -->
            <div class="row">
                <!-- Basic Layout -->
                <div class="col-xxl">
                    <div class="card mb-4">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <!-- <h5 style="margin-left-3px" class="mb-0">Add New Delivery</h5> -->
                            <strong style="margin:auto; font-size:20px;">Delivery Information</strong>
                            <!-- <small class="text-muted float-end">Default label</small> -->
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('delivery.store') }}" enctype="multipart/form-data">
                                @csrf
                                <!-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Item Name :</label>
                                    <div class="col-sm-10">
                                        <input required type="text" name="item_name" class="form-control"
                                            id="basic-default-name" placeholder="Item Name" />
                                    </div>
                                </div> -->


                                <input type="hidden" name="item_name" value="ITEM"/>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Weight :</label>
                                    <div class="col-sm-10">
                                        <input required type="number" name="qty" class="form-control"
                                            id="basic-default-company" placeholder="qty" />
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Item Price :</label>
                                    <div class="col-sm-10">
                                        <input required type="number" name="item_price" id="item_price"
                                            class="form-control phone-mask" placeholder="Enter Price" aria-label="658 799 8941"
                                            aria-describedby="basic-default-phone" />
                                    </div>
                                </div>

                                {{-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-email">Destination :</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <select id="delivery_des" name="delivery_des" class="form-control">
                                                <option disabled selected="selected">Select</option>
                                                <option value="inside_city">Inside City</option>
                                                <option value="outside_city">Outside City</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> --}}

                                <option type="hidden" value="inside_city"></option>

                                {{-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-email">Delivery Type :</label>
                                    <div class="col-sm-10">
                                        <div class="input-group input-group-merge">
                                            <select id="delivery_type" name="delivery_type" class="form-control">
                                                <option disabled selected="selected">Select</option>
                                                <option value="cash_on">Cash on Delivery</option>
                                                <option value="online_payment">Online Payment</option>
                                            </select>
                                        </div>

                                    </div>
                                </div> --}}

                                <option type="hidden" value="Online Payment"></option>

                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label" for="basic-default-phone">Delivery Charge :</label>
                                        <div class="col-sm-10">
                                            <input required type="number" name="delivery_charge" id="delivery_charge"
                                                class="form-control phone-mask" placeholder="0" aria-label="658 799 8941"
                                                aria-describedby="basic-default-phone" />
                                        </div>
                                    </div>

                                <!-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Total Price :</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="total_price" id="total_price"
                                            class="form-control phone-mask" placeholder="0" aria-label="658 799 8941"
                                            aria-describedby="basic-default-phone" />
                                    </div>
                                </div> -->

                                <input type="hidden" name="total_price" value="10"/>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-address">Recipient Name :</label>
                                    <div class="col-sm-10">
                                        <input required name="recipient_name" type="text" class="form-control"
                                            id="basic-default-address" placeholder="Recipient Name" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-address">Recipient Number :</label>
                                    <div class="col-sm-10">
                                        <input required name="recipient_number" type="number" class="form-control"
                                            id="basic-default-address" placeholder="Recipient Number" maxlength="14" />
                                    </div>
                                </div>

                                <!-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-address">Flat/House no
                                        :</label>
                                    <div class="col-sm-10">
                                        <input name="flat_no" type="text" class="form-control"
                                            id="basic-default-address" placeholder="Flat no" />
                                    </div>
                                </div> -->
                                <input type="hidden" name="flat_no" value="10">
                                <!-- <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-address">Road no :</label>
                                    <div class="col-sm-10">
                                        <input name="road_no" type="text" class="form-control"
                                            id="basic-default-address" placeholder="Road No" />
                                    </div>
                                </div> -->
                                <input type="hidden" name="road_no" value="10">

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-address">Recipient Address
                                        :</label>
                                    <div class="col-sm-10">
                                        <input required name="recipient_address" type="text" class="form-control"
                                            id="basic-default-address" placeholder="Recipiet Address" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-address">Comment :</label>
                                    <div class="col-sm-10">
                                        <input name="road_no" type="text" class="form-control"
                                            id="basic-default-address" placeholder="Enter your message" />
                                    </div>
                                </div>

                                <div class="row d-flex justify-content-center align-items-center">
                                    <div
                                        class="col-lg-12 d-flex justify-content-center align-items-center gap-4 form-button">
                                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                                        <button type="button" class="btn rounded-pill btn-outline-warning"><a href="/vendor/delivery">DISCARD</a></button>
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
