<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path=""
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <title>
        @yield('title')
    </title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('customer/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('customer/vendor/fonts/boxicons.css') }}" />

    <link rel="stylesheet"  type='text/css' href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('customer/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('customer/vendor/css/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('customer/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('customer/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    @yield('css')
    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('customer/vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('customer/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('customer/js/config.js') }}"></script>
</head>

<body>

        <!-- preloader start here -->
  <div class="preloader">
    <div class="preloader-inner">
      <div class="preloader-icon">
        <img src="{{ asset('customer/img/preloader.gif') }}" alt="">
      </div>
    </div>
  </div>
  <!-- preloader ending here -->
    <!-- Content -->

    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="{{route('admin.dashboard')}}" class="app-brand-link">
                        <img class="app-brand-logo demo" src="{{ asset('customer/img/logo/logo.png') }}" alt="dman">
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item active">
                        <a href="{{route('admin.dashboard')}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>

                    <!-- Layouts -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <!-- <i class="menu-icon tf-icons bx bx-layout"></i> -->
                            <!-- <i class='menu-icon tf-icons bx bxs-user'></i> -->
                            <!-- <i class='menu-icon tf-icons bx bx-user'></i> -->
                            <i class='menu-icon tf-icons bx bx-group'></i>
                            <div data-i18n="Layouts">Vendors</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('vendor.create') }}" class="menu-link">
                                    <div data-i18n="Without menu">Add Vendor</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('vendor.index') }}" class="menu-link">
                                    <div data-i18n="Without navbar">Vendor List</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('inactive.vendor.list') }}" class="menu-link">
                                    <div data-i18n="Without navbar">Pending Vendor List</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Vendors Delivery -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <!-- <i class="menu-icon tf-icons bx bx-dock-top"></i> -->
                            <i class='menu-icon tf-icons bx bx-run'></i>
                            <div data-i18n="Account Settings">Vendor Delivery</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('vendor.pending.delivery') }}" class="menu-link">
                                    <div data-i18n="Account">Pending Delivery</div>
                                </a>
                            </li>
                            {{-- active class with route  --}}

                            <li class="menu-item"> 
                                <a href="{{ route('vendor.pending.pickup') }}" class="menu-link ">
                                    <div data-i18n="Account">Pending Pickup</div>
                                </a>
                            </li>
                            <li class="menu-item"> 
                                <a href="{{ route('complete.pickup') }}" class="menu-link ">
                                    <div data-i18n="Account">Complete Pickup</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('vendor.processing.delivery') }}" class="menu-link">
                                    <div data-i18n="Notifications">Processing Delivery</div>
                                </a>
                            </li>
                            <li class="menu-item"> 
                                <a href="{{ route('vendor.complete.delivery') }}" class="menu-link">
                                    <div data-i18n="Connections">Completed Delivery</div>
                                </a>
                            </li> 
                            <li class="menu-item">
                                <a href="{{ route('return.list') }}" class="menu-link">
                                    <div data-i18n="Connections">Return Delivery</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('hold.list') }}" class="menu-link">
                                    <div data-i18n="Connections">Hold Delivery</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <!-- <i class="menu-icon tf-icons bx bx-cube-alt"></i> -->
                            <i class='menu-icon tf-icons bx bx-been-here'></i>
                            <div data-i18n="Misc">PickDrops</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('pickdrop.list') }}" class="menu-link">
                                    <div data-i18n="Error">Pending List</div>
                                </a>
                            </li> 
                            <li class="menu-item">
                                <a href="{{ route('processing.pickup') }}" class="menu-link">
                                    <div data-i18n="Under Maintenance">Pending Pickup List</div>
                                </a> 
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('completed.pickup') }}" class="menu-link">
                                    <div data-i18n="Under Maintenance">Completed Pickup List</div>
                                </a>
                            </li> 

                            <li class="menu-item">
                                <a href="{{ route('processing_pickupDrop') }}" class="menu-link">
                                    <div data-i18n="Under Maintenance">Proceesing List</div>
                                </a>
                            </li> 
                            <li class="menu-item">
                                <a href="{{ route('complete.drop') }}" class="menu-link">
                                    <div data-i18n="Under Maintenance">Complete Drop List</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('cancel.pickdrop') }}" class="menu-link">
                                    <div data-i18n="Under Maintenance">Cancel List</div>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <!-- Pick/Drops Delivery -->
                    <!-- Riders -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <!-- <i class="menu-icon tf-icons bx bx-cube-alt"></i> -->
                            <i class='menu-icon tf-icons bx bx-been-here'></i>
                            <div data-i18n="Misc">Riders</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{ route('rider.create') }}" class="menu-link">
                                    <div data-i18n="Error">Add Rider</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ route('rider.index') }}" class="menu-link">
                                    <div data-i18n="Under Maintenance">Riders List</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Reports -->
                    <li class="menu-item">
                        <a href="{{ route('delivery.by.date') }}" class="menu-link">
                            <!-- <i class="menu-icon tf-icons bx bx-home-circle"></i> -->
                            <i class='menu-icon tf-icons bx bx-clipboard'></i>
                            <div data-i18n="Analytics">Reports</div>
                        </a>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('date2date.create') }}" class="menu-link">
                            <!-- <i class="menu-icon tf-icons bx bx-home-circle"></i> -->
                            <i class='menu-icon tf-icons bx bx-clipboard'></i>
                            <div data-i18n="Analytics">D2D Reports</div>
                        </a>
                    </li>
                    <!-- Layouts -->
                     <!-- Places / Locations -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <!-- <i class="menu-icon tf-icons bx bx-dock-top"></i> -->
                            <!-- <i class='menu-icon tf-icons bx bx-book-reader'></i> -->
                            <i class='menu-icon tf-icons bx bx-map-alt'></i>
                            <div data-i18n="Account Settings">Places / Locations</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="{{route('area.index')}}" class="menu-link">
                                    <div data-i18n="Account">Area List</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="{{route('area.create')}}" class="menu-link">
                                    <div data-i18n="Notifications">Area Add</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-item">
                        <a href="{{ route('bulk.delivery.list') }}" class="menu-link">
                            <!-- <i class="menu-icon tf-icons bx bx-home-circle"></i> -->
                            <i class='menu-icon tf-icons bx bx-clipboard'></i>
                            <div data-i18n="Analytics">BulkDeliveries</div>
                        </a>
                    </li>

                    
                    <!-- Log Out -->
                    <li class="menu-item">
                        <a href="{{ route('admin.logout') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Log Out</div>
                        </a>
                    </li>

                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            <!-- Place this tag where you want the button to render. -->
                            <!-- <li class="nav-item lh-1 me-3">
     <a
      class="github-button"
      href="https://github.com/themeselection/sneat-html-admin-template-free"
      data-icon="octicon-star"
      data-size="large"
      data-show-count="true"
      aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
      >Star</a
     >
     </li> -->

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{asset('customer/img/avator.png')}}" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{asset('customer/img/avator.png')}}" alt
                                                            class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    {{-- user admin is logged in --}}
                                                    @if (Auth::guard('admin')->check() )
                                                    <span class="fw-semibold d-block">{{ Auth::guard('admin')->user()->name }}</span>
                                                    <small class="text-muted">{{ Auth::guard('admin')->user()->email }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                   
                                    
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                            <i class="bx bx-cog me-2"></i>
                                            <span class="align-middle">Logout</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
    
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>
                <!-- / Navbar -->
                @yield('content')
                <!-- Footer -->
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
                            Hand crafted & made with ❤️

                        </div>
                    </div>
                </footer>
                <!-- / Footer -->
            </div>
            <!-- / Layout page -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Content -->
    <!-- Core JS -->
    <script>
        window.addEventListener("load", function () {
          const loader = document.querySelector(".preloader");
          loader.className += " hidden"; // class "loader hidden"
        })
      </script>
      
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('customer/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('customer/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('customer/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('customer/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('customer/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->


    <!-- Main JS -->
    <script src="{{ asset('customer/js/main.js') }}"></script>

    <!-- Page JS -->
    @yield('script')

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
