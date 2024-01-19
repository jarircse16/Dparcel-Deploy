
<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dman | Your Delivery Hand</title>
    @laravelPWA

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../customer/img/fav.jpeg" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;700&display=swap" rel="stylesheet" />
    <!-- bootstrap css -->
    <link rel="stylesheet" href="{{ asset('customer/css/bootstrap.min.css') }}" />
    <!-- animation -->
    <link rel="stylesheet" href="{{ asset('customer/css/aos.css') }}" />
    <!-- home CSS -->
    <link rel="stylesheet" href="{{ asset('customer/css/home.css') }}" />
    <link rel="stylesheet" href="{{ asset('customer/vendor/css/footer.css') }}" />
</head>



<body>


    <!-- preloader ending here -->

    <!-- header start -->
    <header>
        <div class="container">
            <!-- navbar -->
            <nav class="navbar navbar-expand-lg c_nav">
                <div class="container-fluid p-0">
                    <!-- logo -->
                    <a class="navbar-brand" href="#">
                        <img class="img-fluid logo" src="{{ asset('customer/img/logo/logo.png') }}"
                            alt="dman" />
                    </a>
                    <button class="navbar-toggler collapsed d-flex d-lg-none flex-column justify-content-around"
                        type="button" data-bs-toggle="collapse" data-bs-target="#nav_custom" aria-controls="nav_custom"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="toggler-icon top-bar"></span>
                        <span class="toggler-icon middle-bar"></span>
                        <span class="toggler-icon bottom-bar"></span>
                    </button>
                    <!-- menu -->
                    <div class="collapse navbar-collapse menu" id="nav_custom">
                        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="#">Contact</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('pickdrop') }}">Pick / Drop for
                                    You</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page"
                                    href="{{ route('vendor_login_form') }}">D-Parcel</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('rider.login') }}">D-Rider</a>
                            </li>
                        </ul>
                    </div>
                    <div class="call-action">
                        <p class="m-0">
                            <a href="tel:+4733378901">
                                <span><i class="fa-solid fa-phone"></i></span>+880 1986-253559</a>
                        </p>
                    </div>
                </div>
            </nav>
            <!-- navbar -->
        </div>
    </header>
    <!-- header end -->

    <!-- banner start -->
    <form action="{{ route('pickdrop.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <section id="banner">
            <div class="container">
                <div class="row justify-content-center align-items-center banner">

                    <!-- Basic Layout -->
                    <div class="col-lg-6" data-aos="zoom-out-up" data-aos-duration="1000">
                        <div class="card mb-4">
                            <div class="card-header ml-2 d-flex align-items-center justify-content-between">
                                <h5 class="mb-0 mx-auto font-bold">Product Info</h5>
                                <!-- <small class="text-muted float-end">Default label</small> -->
                            </div>
                            <div class="card-body">

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Item Name</label>
                                    <div class="col-sm-10">
                                        <input required type="text" name="item_name" class="form-control"
                                            id="basic-default-name" placeholder="Item Name" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-company">Qty</label>
                                    <div class="col-sm-10">
                                        <input required type="number" name="qty" class="form-control"
                                            id="basic-default-company" placeholder="qty" />
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Item
                                        Price</label>
                                    <div class="col-sm-10">
                                        <input required type="number" name="item_price" id="item_price"
                                            class="form-control phone-mask" placeholder="Enter Price"
                                            aria-label="658 799 8941" aria-describedby="basic-default-phone" />
                                    </div>
                                </div>
{{-- 
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label"
                                        for="basic-default-email">Destination</label>
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
{{-- 
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-email">Delivery
                                        Type</label>
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


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Delivery
                                        Charge</label>
                                    <div class="col-sm-10">
                                        <input required type="number" readonly name="delivery_charge"
                                            id="delivery_charge" class="form-control phone-mask" placeholder="0"
                                            aria-label="658 799 8941" aria-describedby="basic-default-phone" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-phone">Total
                                        Price</label>
                                    <div class="col-sm-10">
                                        <input type="number" readonly name="total_price" id="total_price"
                                            class="form-control phone-mask" placeholder="0" aria-label="658 799 8941"
                                            aria-describedby="basic-default-phone" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="basic-default-address">Pickup
                                        Time</label>
                                    <div class="col-sm-9">
                                        <input required name="delivery_time" type="datetime-local"
                                            class="form-control" id="basic-default-address" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="basic-default-address">
                                        Product Image</label>
                                    <div class="col-sm-9">
                                        <input name="product_image" type="file"
                                            class="form-control" id="basic-default-address" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label" for="basic-default-name">Notes</label>
                                    <div class="col-sm-10">
                                        <textarea required name="description" class="form-control"
                                            id="basic-default-name" placeholder="Item Description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="zoom-out-up" data-aos-duration="1000">
                        <div class="card mb-4">
                            <div class="card-header ml-2 d-flex align-items-center justify-content-between">
                                <h5 class="mb-0 mx-auto font-bold">Drop Info</h5>
                                <!-- <small class="text-muted float-end">Default label</small> -->
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="basic-default-address">Drop Receiver Name
                                        :</label>
                                    <div class="col-sm-9">
                                        <input required name="drop_name" type="text" class="form-control"
                                            id="basic-default-address" placeholder="Drop Receiver Name" />
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="basic-default-address">Drop Receiver Number
                                        :</label>
                                    <div class="col-sm-9">
                                        <input name="drop_number" type="text" class="form-control"
                                            id="basic-default-address" placeholder="Drop Receiver No" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="basic-default-address">Drop Receiver
                                        Address
                                        :</label>
                                    <div class="col-sm-9">
                                        <input required name="drop_address" type="text" class="form-control"
                                            id="basic-default-address" placeholder="Drop Receiver Address" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header ml-2 d-flex align-items-center justify-content-between">
                                <h5 class="mb-0 mx-auto font-bold">Pick Info</h5>
                                <!-- <small class="text-muted float-end">Default label</small> -->
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="basic-default-address">Pickup Receiver Name
                                        :</label>
                                    <div class="col-sm-9">
                                        <input required name="pick_name" type="text" class="form-control"
                                            id="basic-default-address" placeholder="Pickup Receiver Name" />
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="basic-default-address">Pickup Receiver Number
                                        :</label>
                                    <div class="col-sm-9">
                                        <input name="pick_number" type="text" class="form-control"
                                            id="basic-default-address" placeholder="Pickup Receiver No" />
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-3 col-form-label" for="basic-default-address">Pickup Receiver Address
                                        :</label>
                                    <div class="col-sm-9">
                                        <input required name="pick_address" type="text" class="form-control"
                                            id="basic-default-address" placeholder="Pickup Receiver Address" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </div>
        </section>
    </form>

    <!-- banner end -->

    <!-- Footer Start-->

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 ">
                    <div class="footer-content">
                        <div class="footer-logo">
                            <img class="img-fluid" src="{{ asset('customer/img/logo/logo.png') }}" alt="dman" />
                        </div>
                        <p>
                            DMan is a delivery service that allows Vendor to provide their product door to door with
                            safety. We have
                            the Fastest and most Reliable Dman’s, they take more than reasonable care to vendor products
                            and provide
                            their service in exact time. You will be pleased to be with DMan❤️
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 ">
                    <div class="footer-content p-lg-4">
                        <h3>Privacy Policy</h3>
                        <ul>
                            <li><i class="fa-solid fa-arrow-right"></i>24 Hours Payment</li>
                            <li><i class="fa-solid fa-arrow-right"></i>0% Return Charge</li>
                            <li><i class="fa-solid fa-arrow-right"></i>1% Cash on Delivery Charge</li>
                            <li><i class="fa-solid fa-arrow-right"></i>100% Product Liability</li>
                            <li><i class="fa-solid fa-arrow-right"></i>Delivery Charge Inside city 50taka Outside city
                                100taka (up
                                to
                                2kg)</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="footer-content p-lg-4">
                        <h3>Get In Touch</h3>
                        <ul>
                            <li>
                                <a href="tel:+4733378901">
                                    <span><i class="fa-solid fa-phone"></i></span> 09696253559</a>
                            </li>
                            <li>
                                <a href="mailto:info@dmanbd.com">
                                    <span><i class="fa-solid fa-envelope"></i>info@dmanbd.com</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <span><i class="fas fa-map-marker-alt"></i> 23 Jashore Road, Khulna 9100</span>
                                </a>
                            </li>
                        </ul>
                        <div class="social">
                            <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#"><i class="fa-brands fa-twitter"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="copy-right">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-lg-4 align-items-center">
                        <p class="text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script> <span><a href="#">DMan</a></span>. All Rights Reserved.
                        </p>
                    </div>
                    <div class="col-lg-4">
                        <p class="text-center">
                            Developed by <span><a href="https://www.envision-bd.com">Envision IT</a></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </footer>





    <!--Footer End-->

    <!-- Core JS -->

    <!-- show preloader while loading -->

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $('select[name="delivery_des"]').on('change', function() {
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
                } else if (delivery_des == 'outside_city' && delivery_type == 'online_payment') {
                    var delivery_charge = 100;
                    $('#delivery_charge').val(delivery_charge);
                    var total_price = parseInt(item_price) + parseInt(delivery_charge);
                    $('#total_price').val(total_price);
                } else {
                    $('#delivery_charge').val('');
                    $('#total_price').val('');
                }
            });
        });
    </script>

    <script>
        window.addEventListener("load", function() {
            const loader = document.querySelector(".preloader");
            loader.className += " hidden"; // class "loader hidden"
        })
    </script>
    <!-- Core JS -->
    <script src="{{ asset('customer/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('customer/js/aos.js') }}"></script>
    <script src="{{ asset('customer/js/fontawesome.js') }}"></script>

    <script>
        AOS.init();
    </script>
</body>

</html>

</html>