<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content />
    <meta name="author" content />
    <title>@yield('title')</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
    <script data-search-pseudo-elements defer
        src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="nav-fixed">
    <!-- Navbar -->
    @include('layouts.navbar')
    <!-- /.navbar -->


    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <!-- Sidenav -->
            @include('layouts.sidenav')
            <!-- /.sidenav -->
        </div>
        <div id="layoutSidenav_content">
            <main>
                @include('layouts.header')
                <div class="container-fluid mt-n10">
                    <div class="card">
                        <div class="card-header">@yield('informasi') :</div>
                        <div class="card-body">@yield('content')</div>
                    </div>
                </div>
            </main>
            <!-- Footer -->
            @include('layouts.footer')
            <!-- /.footer -->
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
    {{-- core select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    @yield('core-select2')
</body>

</html>