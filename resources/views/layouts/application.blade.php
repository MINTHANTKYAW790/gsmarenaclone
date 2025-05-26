<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>C2 Mobile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header,
        .footer {
            display: flex;
            align-items: center;
            padding: 15px 30px;
        }

        .header {
            justify-content: space-between;
            background: linear-gradient(to right, #dff3fc, #0091ea);
        }

        .header-left img {
            height: 50px;
        }

        .header-right a {
            margin-left: 20px;
            text-decoration: none;
            color: #000;
            font-weight: bold;
        }

        .footer {
            justify-content: space-between;
            background-color: #222;
            color: white;
            font-size: 14px;
            padding: 20px 30px;
        }

        .footer a {
            color: #aaa;
            text-decoration: none;
            margin: 0 10px;
        }

        .homeLeftDiv {
            background-color: #404a54;
            height: 10vw;
            width: 48%
        }

        .addDevice {
            margin-left: 29%;
            margin-top: 5%
        }

        .mainContainer {
            width: 98%;
            background-color: white;
            margin: 1% auto;
        }

        body {
            background-color: gray !important
        }

        .categoryName {
            color: #0091ea !important;
        }

        .specCategory {
            color: #003684 !important;
        }

        .tableContainer {
            background-color: green;
            padding: 2%;
        }

        .comparison-table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        .comparison-table th,
        .comparison-table td {
            padding: 8px 12px;
            text-align: left;
            vertical-align: top;
            border: none;
            /* optional, to clean default borders */
        }

        .comparison-table .category-separator td {
            border-bottom: 1px dotted #999;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<body>

    <!-- Header -->
    <div class="header">
        <div class="header-left">
            {{-- <img src="{{ asset('images/logo.png') }}" alt="C2 Mobile Logo"> --}}
            <h3>C2 Mobile</h3>
        </div>
        <div class="header-right">
            <a href="#">Home</a>
            <a href="#">News</a>
            <a href="#">Phone Finder</a>
            <a href="#">Reviews</a>
            <a href="#">About us</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        @yield('content')
    </div>

    <!-- Footer -->
    <!-- Footer -->
    <footer class="footer">
        <div
            style="display: flex; justify-content: space-between; width: 100%; flex-wrap: wrap; padding: 20px 30px; background-color: #222; color: white;">
            <!-- Left: Logo and Tagline -->
            <div style="flex: 1; min-width: 200px;">
                <div style="font-weight: bold;">C2 Mobile</div>
                <div style="font-size: 14px; color: #ccc;">Technical support</div>
            </div>

            <!-- Center: Navigation Links -->
            <div style="flex: 1; text-align: center; min-width: 200px;">
                <a href="#" style="color: #ccc; margin: 0 10px; text-decoration: none;">Home</a>
                <a href="#" style="color: #ccc; margin: 0 10px; text-decoration: none;">News</a>
                <a href="#" style="color: #ccc; margin: 0 10px; text-decoration: none;">Reviews</a>
                <a href="#" style="color: #ccc; margin: 0 10px; text-decoration: none;">Compare</a>
            </div>

            <!-- Right: Copyright and Legal -->
            <div style="flex: 1; text-align: right; min-width: 200px;">
                <div style="color: #ccc;">copyright © 2025 - <a href="#"
                        style="color: #ccc; text-decoration: none;">websitelink.com</a></div>
                <a href="#" style="color: #ccc; margin-right: 10px; text-decoration: none;">Privacy</a>
                <a href="#" style="color: #ccc; text-decoration: none;">Terms of use</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 4.6.2 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

</body>

</html>