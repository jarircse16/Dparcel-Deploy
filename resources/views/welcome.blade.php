<!DOCTYPE html>

<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/"
  data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport"
    content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

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
  <!-- header start -->
  <header>
    <!-- preloader start here -->
  <div class="preloader">
    <div class="preloader-inner">
      <div class="preloader-icon">
        <img src="{{ asset('customer/img/preloader.gif') }}" loading = "lazy" alt="">
      </div>
    </div>
  </div>
  <!-- preloader ending here -->

    <div class="container">
      <!-- navbar -->
      <nav class="navbar navbar-expand-lg c_nav">
        <div class="container-fluid p-0">
          <!-- logo -->
          <a class="navbar-brand" href="#">
            <img class="img-fluid logo" src="{{ asset('customer/img/logo/logo.png') }}" loading = "lazy" alt="dman" />
          </a>
          <button class="navbar-toggler collapsed d-flex d-lg-none flex-column justify-content-around" type="button"
            data-bs-toggle="collapse" data-bs-target="#nav_custom" aria-controls="nav_custom" aria-expanded="false"
            aria-label="Toggle navigation">
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
                <a class="nav-link" aria-current="page" href="#about-us">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="#contact-us">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('pickdrop') }}">Pick / Drop for You</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('vendor_login_form') }}">D-Parcel</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('rider.login') }}">D-Rider</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('admin.login') }}">Admin Login</a>
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
  <section id="banner">
    <div class="container">
      <div class="row justify-content-center align-items-center banner">
        <div class="col-lg-6">
          <div class="banner-content" data-aos="zoom-in" data-aos-duration="3000">
            <h1>
              Express <br />
              <span>Home Delivery</span>
            </h1>
            <p>Solution of your Delivery Problem</p>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="row justify-content-center align-items-center">

            <!--Dfood
            <div class="col-lg-4 col-md-6">
              <a href="{{ route('vendor_login_form') }}">
                <div class="b-card" data-aos="zoom-in-up" data-aos-duration="3000">
                  <div>
                    <i class="fa-sharp fa-solid fa-burger"></i>
                    <p>
                      D-Food <br />
                      Mart
                    </p>
                  </div>
                </div>
              </a>
            </div> -->



            <div class="col-lg-4 col-md-6">
              <a href="{{ route('vendor_login_form') }}">
                <div class="b-card d-parcel" data-aos="zoom-in-down" data-aos-duration="2000">
                  <div>
                    <i class="fa-solid fa-person"></i>
                    <p>D-Parcel</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-lg-4 col-md-6">
              <a href="{{ route('vendor_login_form') }}">
                <div class="b-card pick-drop" data-aos="zoom-in-up" data-aos-duration="3000">
                  <div>
                    <i class="fa-solid fa-location"></i>
                    <p>
                      Pick / Drop <br />
                      for You
                    </p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- banner end -->

  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 ">
          <div class="footer-content">
            <div class="footer-logo">
              <img class="img-fluid" src="{{ asset('customer/img/logo/Logo.png') }}"  loading = "lazy" alt="dman" />
            </div>
            <p id="about-us">
              DMan is a delivery service that allows Vendor to provide their product door to door with safety. We have
              the Fastest and most Reliable Dman’s, they take more than reasonable care to vendor products and provide
              their service in exact time. You will be pleased to be with DMan❤️
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 ">
          <div class="footer-content p-lg-4">
            <h3>Policy</h3>
            <ul>
              <li><i class="fa-solid fa-arrow-right"></i>24 Hours Payment</li>
              <li><i class="fa-solid fa-arrow-right"></i>0% Return Charge</li>
              <li><i class="fa-solid fa-arrow-right"></i>1% Cash on Delivery Charge</li>
              <li><i class="fa-solid fa-arrow-right"></i>100% Product Liability</li>
              <li><i class="fa-solid fa-arrow-right"></i>Delivery Charge Inside city 50taka Outside city 100taka (up to
                2kg)</li>
            </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-6" id="contact-us">
          <div class="footer-content p-lg-4" >
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
          <div class="col-lg-4 align-items-center">
            <p class="text-center">
             <a href="#">Go to Top</a>
            </p></div>
          <div class="col-lg-4">
            <p class="text-center">
              Developed by <span><a href="https://www.facebook.com/jarir.in.ruet.cse/">3C Studio</a></span>
            </p>
          </div>
        </div>
      </div>
    </div>

  </footer>

  <script>
    window.addEventListener("load", function () {
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
