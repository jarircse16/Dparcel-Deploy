@extends('vendor.app')

@section('content')

<script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
<div>
<div id="printSections" style="text-align: center; display:none;">
    <img src="{{ asset('customer/img/logo/logo.png') }}" height="20%" width="20%">
    <h4 style="text-align: center;">Delivery Report</h4>
    <h6>Delivery ID: {{$delivery->id}}</h6>
</div>

<div id="printSection"  style="display: none; text-align:center;">
    <img src="{{ asset('customer/img/logo/logo.png') }}" height="20%" width="20%">
    <h4 style="text-align: center;">Delivery Report</h4>

    <h6>Weight: {{ $delivery->qty }}</h6>
    <h6>Price: {{ $delivery->item_price }}</h6>
    <h6>Delivery Charge: {{ $delivery->delivery_charge }}</h6>
    <h6>Delivery Time: {{ $delivery->delivery_time }}</h6>
    <h6>Recepient Name: {{ $delivery->recipient_name }}</h6>
    <h6>Recepient Number: {{ $delivery->recipient_number }}</h6>
    <h6>Recepient Address: {{ $delivery->recipient_address }}</h6>

</div>   
    <br><hr>
    <h6 style="text-align: center;">Scan the QR Code below to get Delivery Report.</h6>
    <br><hr>
    <div id="imgbox" style="text-align: center;">
        <img src="" id="qrimg">
    </div>
    <hr>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            // Call generate() when the page loads
            generate();
        });

        function generate() {
            let imagebox = document.getElementById("imgbox");
            let qrimage = document.getElementById("qrimg");
            let qrtext = document.getElementById("printSection").innerText; // Use innerText to get the text content

            // Generate QR code using the provided API
            qrimage.src = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" + encodeURIComponent(qrtext);
        }
    </script>

</div>
@endsection
