<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>C2 Mobile</title>
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* full viewport height */
        }

        .content {
            flex: 1;
            /* makes this area fill available space */
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            height: 100vh;
        }

        .header,
        .footer {
            display: flex;
            align-items: center;
            padding: 7px 15px;
        }

        .header {
            justify-content: space-between;
            background: linear-gradient(to right, #dff3fc, #0091ea);
        }

        .header-left img {
            height: 30px;
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
            border-top: 1px dotted black;
            background: linear-gradient(to right, #dff3fc, #0091ea);
            padding: 1% 2%;
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

        .comparisonTable {
            width: 97%;
            margin: 1% auto;
            background-color: white;
        }

        .phoneFinderContainer {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 95%;
            height: 100%;
            margin: 0 auto;
        }

        .phoneFinder {
            background-color: white;
            width: 20%;
            height: 80%;
        }

        .phoneFinderProducts {
            background-color: white;
            width: 79%;
            height: 80%;
        }

        .phoneFinderText {
            text-align: center;
            background-color: #003684;
            color: white;
            border-radius: 0 0 20px 20px;
            margin: 0;
            padding: 2% 0;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

</head>

<body>
    <div class="wrapper">

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
                style="display: flex; justify-content: space-between; width: 100%; flex-wrap: wrap; padding: 10px 15px; background-color: #222; color: white;">
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
    </div>

    <!-- Bootstrap 4.6.2 JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous">
    </script>

</body>

</html>