<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
</head>

<body style="margin-top: 20px;">

    <style>
        .steps .step {
            display: block;
            width: 100%;
            margin-bottom: 35px;
            text-align: center
        }

        .steps .step .step-icon-wrap {
            display: block;
            position: relative;
            width: 100%;
            height: 80px;
            text-align: center
        }

        .steps .step .step-icon-wrap::before,
        .steps .step .step-icon-wrap::after {
            display: block;
            position: absolute;
            top: 50%;
            width: 50%;
            height: 3px;
            margin-top: -1px;
            background-color: #e1e7ec;
            content: '';
            z-index: 1
        }

        .steps .step .step-icon-wrap::before {
            left: 0
        }

        .steps .step .step-icon-wrap::after {
            right: 0
        }

        .steps .step .step-icon {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
            border: 1px solid #e1e7ec;
            border-radius: 50%;
            background-color: #f5f5f5;
            color: #374250;
            font-size: 38px;
            line-height: 81px;
            z-index: 5
        }

        .steps .step .step-title {
            margin-top: 16px;
            margin-bottom: 0;
            color: #606975;
            font-size: 14px;
            font-weight: 500
        }

        .steps .step:first-child .step-icon-wrap::before {
            display: none
        }

        .steps .step:last-child .step-icon-wrap::after {
            display: none
        }

        .steps .step.completed .step-icon-wrap::before,
        .steps .step.completed .step-icon-wrap::after {
            background-color: #0da9ef
        }

        .steps .step.completed .step-icon {
            border-color: #0da9ef;
            background-color: #0da9ef;
            color: #fff
        }

        @media (max-width: 576px) {

            .flex-sm-nowrap .step .step-icon-wrap::before,
            .flex-sm-nowrap .step .step-icon-wrap::after {
                display: none
            }
        }

        @media (max-width: 768px) {

            .flex-md-nowrap .step .step-icon-wrap::before,
            .flex-md-nowrap .step .step-icon-wrap::after {
                display: none
            }
        }

        @media (max-width: 991px) {

            .flex-lg-nowrap .step .step-icon-wrap::before,
            .flex-lg-nowrap .step .step-icon-wrap::after {
                display: none
            }
        }

        @media (max-width: 1200px) {

            .flex-xl-nowrap .step .step-icon-wrap::before,
            .flex-xl-nowrap .step .step-icon-wrap::after {
                display: none
            }
        }

        .bg-faded,
        .bg-secondary {
            background-color: #f5f5f5 !important;
        }
    </style>


    <div class="container padding-bottom-3x mb-1">
        <div class="card mb-3">
			<div class="d-flex justify-content-between bg-dark rounded-top p-4 text-white text-lg">
				<img src="{{ asset('customer/img/logo/logo.png') }}" alt="" style="width: 100px;">
				<span class="text-medium">Tracking Order No - {{ $delivery->id }}</span>
			</div>
            <div class="card-body">
                <div
                    class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
                    <div class="step  @if ($delivery->is_pick == 1) completed @endif">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="pe-7s-check"></i></div>
                        </div>
                        <h4 class="step-title">
							Pick Status :
                            @if ($delivery->pick_status == 'Pending')
                                <span class="text">Pending</span>
                            @elseif ($delivery->pick_status == 'Pending_Pickup')
                                <span class="text">Pending Pickup</span>
                            @elseif ($delivery->pick_status == 'Processing')
                                <span class="text">Processing</span>
                            @elseif ($delivery->pick_status == 'Completed')
                                <span class="text">Completed</span>
                            @endif
                        </h4>
                    </div>
                    <div class="step completed">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="pe-7s-user"></i></div>
                        </div>
                        <div class="step-content">
                            <h4 class="step-title">
                                @if ($delivery->pickRider)
                                    <div class="row">
                                        <div class="col-md-6 mx-auto">
                                            <div class="text-center">
                                                <div>
                                                    <strong>Pick Rider:</strong><br>
                                                    {{ $delivery->pickRider->rider_name }}<br>
                                                </div>
                                                <i class="pe-7s-phone"></i> {{ $delivery->pickRider->mobile }}
                                            </div>
                                            <!-- Add more columns if needed -->
                                        </div>
                                    </div>
                                @endif
                            </h4>
                        </div>
                    </div>

					@if($delivery->location)
                    <div class="step @if ($delivery->location) completed @endif">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="pe-7s-location"></i></div>
                        </div>
						@if ($delivery->location)
                        <h4 class="step-title">{{ $delivery->location}}</h4>
						@endif

                    </div>
					@endif

					
                    <div class="step @if ($delivery->is_drop == 1) completed @endif">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="pe-7s-car"></i></div>
                        </div>
                        <h4 class="step-title">
							@if ($delivery->dropRider)
							<div class="row">
								<div class="col-md-6 mx-auto">
									<div class="text-center">
										<div>
											<strong>Drop Rider:</strong><br>
											{{ $delivery->dropRider->rider_name }}<br>
										</div>
										<i class="pe-7s-phone"></i> {{ $delivery->dropRider->mobile }}
									</div>
									<!-- Add more columns if needed -->
								</div>
							</div>
						@endif
						</h4>
                    </div>

                    <div class="step @if ($delivery->status == "Completed") completed @endif">
                        <div class="step-icon-wrap">
                            <div class="step-icon"><i class="pe-7s-check"></i></div>
                        </div>
                        <h4 class="step-title">
							@if ($delivery->status == 'Completed')
								<strong>Completed</strong> <br />
							@endif
						</h4>
                    </div>
                </div>
            </div>
        </div>
       
    </div>



</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</html>
