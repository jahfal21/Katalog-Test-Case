<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Logo --}}
    <link rel="icon" href="{{ asset('images/logo_atas.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    {{-- Google Font --}}
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" />

    {{-- My CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- SideBars CSS --}}
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    {{-- Jquery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>
        @yield('title')
    </title>

    <style>
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        .content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
        }

        .footer {
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="content-wrapper">
        {{-- Header --}}
        @include('homelayout.header')

        <div class="container-fluid main-content">
            <div class="row">
                {{-- Content --}}
                <main class="col-md-12">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="footer">
        @include('homelayout.footer')
    </div>

    {{-- Modal --}}
    @include('homepage_view.modal')

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    {{-- Style.js --}}
    <script src="{{ asset('js/style.js') }}"></script>

    {{-- Sweet Alert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @yield('scripts')
</body>

</html>
