<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | MoblileArena Admin</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    @stack('style')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">
        @include('layouts.nav')
        @include('layouts.aside')
        <div class="content-wrapper py-1">
            @yield('content')
        </div>
        @include('layouts.footer')
    </div>

    @if (session()->has('success'))
    <script type="module">
        $(document).ready(function() {
            //toastr.options.closeButton = true;
            //toastr.options.closeHtml = '<button class="position-static"><i class="fas fa-times"></i></button>';
            //toastr.options.timeOut = 100000;
            toastr.success('{{session('success')}}')
        });
    </script>
    @endif

    @if (session()->has('error'))
    <script type="module">
        $(document).ready(function() {
            toastr.options.closeButton = true;
            toastr.options.closeHtml = '<button class="position-static"><i class="fas fa-times"></i></button>';
            toastr.options.timeOut = 100000;
            toastr.error('{{session('error')}}');
        });
    </script>
    @endif

    @if (session()->has('swalSuccess'))
    <script type="module">
        Swal.fire({
            title: "Good job!",
            text: "{{session('swalSuccess')}}",
            icon: "success",
            iconColor: "#6868AC",
            confirmButtonColor: "#6868AC",
        });
    </script>
    @endif
    @stack('scripts')

</body>

<script type="module">
    document.addEventListener('DOMContentLoaded', function() {
        window.addEventListener('show-toast', event => {
            const type = event.detail.type;
            const message = event.detail.message;
            if (type === 'success') {
                toastr.success(message);
            } else if (type === 'error') {
                toastr.error(message);
            }
        });
    });
</script>

</html>