<!DOCTYPE html>

<html data-bs-theme="light" lang="en" style="background: black;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Pulsetracker</title>
    <link rel="icon" type="image/jpeg" sizes="720x720" href="{{ url('assets/img/Circle%20Brand%20Identity.jpeg') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@5.3.3/dist/darkly/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alatsi&amp;display=swap">
    
    <link rel="stylesheet" href="/assets/css/bs-theme-overrides.css">
    <link rel="stylesheet" href="/assets/css/Banner-Heading-Image-images.css">
    <link rel="stylesheet" href="/assets/css/Navbar-Centered-Brand-Dark-icons.css">
    <style>
        .selected {
            color: rgba(var(--bs-link-color-rgb), var(--bs-link-opacity, 1)) !important;
        }
    </style>
    
</head>

<body style="--bs-body-bg: black;background: black;">
    <!-- Start: sideNav-1 -->
    @if (!auth()->user()->email_verified_at)
        <div class="alert alert-warning text-center" style="border-radius: 0px;" role="alert">
            Please activate your email, verify your inbox or <a href="{{ url('dashboard/send-now-verification') }}">send
                now</a> (1 mail per 10min)
        </div>
    @endif
    <div class="container-fluid" style="background: black;">


        <!-- Start: Row -->
        <div class="row row flex-nowrap" style="background: black;">
            <!-- Start: Column -->
            <div class="col-xl-2 col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark"
                style="background: black !important;border-style: none;border-right: 1px solid var(--bs-dark-text-emphasis);">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100"
                    style="background: black;margin: 5%;"><a href="/"
                        class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none"><span
                            class="fs-5 d-none d-sm-inline">PulseTracker&nbsp;<img
                                src="{{url('assets/img/Circle%20Brand%20Identity.jpeg')}}"
                                style="width: 50px;height: 50px;"></span></a><!-- Start: UL -->
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                        id="menu" style="margin-top: 10%;">
                        <li class="nav-item"><a href="{{ url('dashboard') }}"
                                class="@if(Request::is('dashboard')) selected @endif nav-link align-middle px-0"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="16" fill="currentColor" class="bi bi-lightning-charge"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09zM4.157 8.5H7a.5.5 0 0 1 .478.647L6.11 13.59l5.732-6.09H9a.5.5 0 0 1-.478-.647L9.89 2.41z" />
                                </svg><span class="ms-1 d-none d-sm-inline">Dashboard</span></a></li>
                        <li class="nav-item"><a href="{{ url('dashboard/apps') }}"
                                class="@if(Request::is('dashboard/apps*')) selected @endif nav-link align-middle px-0"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16"
                                    class="bi bi-database fs-4 bi-house">
                                    <path
                                        d="M4.318 2.687C5.234 2.271 6.536 2 8 2s2.766.27 3.682.687C12.644 3.125 13 3.627 13 4c0 .374-.356.875-1.318 1.313C10.766 5.729 9.464 6 8 6s-2.766-.27-3.682-.687C3.356 4.875 3 4.373 3 4c0-.374.356-.875 1.318-1.313ZM13 5.698V7c0 .374-.356.875-1.318 1.313C10.766 8.729 9.464 9 8 9s-2.766-.27-3.682-.687C3.356 7.875 3 7.373 3 7V5.698c.271.202.58.378.904.525C4.978 6.711 6.427 7 8 7s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 5.698M14 4c0-1.007-.875-1.755-1.904-2.223C11.022 1.289 9.573 1 8 1s-3.022.289-4.096.777C2.875 2.245 2 2.993 2 4v9c0 1.007.875 1.755 1.904 2.223C4.978 15.71 6.427 16 8 16s3.022-.289 4.096-.777C13.125 14.755 14 14.007 14 13zm-1 4.698V10c0 .374-.356.875-1.318 1.313C10.766 11.729 9.464 12 8 12s-2.766-.27-3.682-.687C3.356 10.875 3 10.373 3 10V8.698c.271.202.58.378.904.525C4.978 9.71 6.427 10 8 10s3.022-.289 4.096-.777A4.92 4.92 0 0 0 13 8.698m0 3V13c0 .374-.356.875-1.318 1.313C10.766 14.729 9.464 15 8 15s-2.766-.27-3.682-.687C3.356 13.875 3 13.373 3 13v-1.302c.271.202.58.378.904.525C4.978 12.71 6.427 13 8 13s3.022-.289 4.096-.777c.324-.147.633-.323.904-.525">
                                    </path>
                                </svg><span class="ms-1 d-none d-sm-inline">Apps</span></a></li>
                        <li style="margin-top: 10%;"><a href="{{ url('dashboard/devices') }}"
                                class="@if(Request::is('dashboard/devices*')) selected @endif nav-link px-0 align-middle"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16"
                                    class="bi bi-globe-americas fs-4 bi-table">
                                    <path
                                        d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0M2.04 4.326c.325 1.329 2.532 2.54 3.717 3.19.48.263.793.434.743.484-.08.08-.162.158-.242.234-.416.396-.787.749-.758 1.266.035.634.618.824 1.214 1.017.577.188 1.168.38 1.286.983.082.417-.075.988-.22 1.52-.215.782-.406 1.48.22 1.48 1.5-.5 3.798-3.186 4-5 .138-1.243-2-2-3.5-2.5-.478-.16-.755.081-.99.284-.172.15-.322.279-.51.216-.445-.148-2.5-2-1.5-2.5.78-.39.952-.171 1.227.182.078.099.163.208.273.318.609.304.662-.132.723-.633.039-.322.081-.671.277-.867.434-.434 1.265-.791 2.028-1.12.712-.306 1.365-.587 1.579-.88A7 7 0 1 1 2.04 4.327Z">
                                    </path>
                                </svg><span class="ms-1 d-none d-sm-inline">Devices</span></a></li>
                        <li style="margin-top: 10%;"><a href="{{ url('dashboard/map') }}"
                                class="@if(Request::is('dashboard/map*')) selected @endif nav-link px-0 align-middle"><span class="ms-1 d-none d-sm-inline"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-map fs-4 bi-bootstrap">
                                        <path fill-rule="evenodd"
                                            d="M15.817.113A.5.5 0 0 1 16 .5v14a.5.5 0 0 1-.402.49l-5 1a.502.502 0 0 1-.196 0L5.5 15.01l-4.902.98A.5.5 0 0 1 0 15.5v-14a.5.5 0 0 1 .402-.49l5-1a.5.5 0 0 1 .196 0L10.5.99l4.902-.98a.5.5 0 0 1 .415.103M10 1.91l-4-.8v12.98l4 .8V1.91zm1 12.98 4-.8V1.11l-4 .8zm-6-.8V1.11l-4 .8v12.98z">
                                        </path>
                                    </svg> Map</span></a></li>
                        <li style="margin-top: 10%;"><a href="{{ url('dashboard/settings') }}"
                                class="@if(Request::is('dashboard/settings*')) selected @endif nav-link px-0 align-middle"><span class="ms-1 d-none d-sm-inline"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        fill="currentColor" viewBox="0 0 16 16" class="bi bi-person fs-4 bi-grid">
                                        <path
                                            d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664z">
                                        </path>
                                    </svg> Settings</span></a></li>
                    </ul><!-- End: UL -->
                </div>
            </div><!-- End: Column -->
            <!-- Start: Paragraph -->
            @yield('content')
        </div><!-- End: Row -->
    </div><!-- End: sideNav-1 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
