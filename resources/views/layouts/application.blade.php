<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>TechBit</title>
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

        /* body {
            background-color: gray !important
        } */

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
            height: 100% !important;
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

    /* Override Toastr success background and text color */
    #toast-container > .toast-success {
        background-color:rgb(4, 138, 35) !important;  /* Light green */
    }

    /* Optional: close button color */
    #toast-container > .toast-success .toast-close-button {
        color: #0b4e2f !important;
    }

    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<!-- In <head> section -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body class="bg-light">
    <div class="wrapper">

        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <a href="{{ route('welcome') }}" style="text-decoration: none; color: inherit;">
                    <h3>TechBit</h3>
                </a>
            </div>
            <div class="header-right">
                <a href="{{ route('compare.index') }}">Compare</a>
                <a href="{{ route('reviews') }}">Reviews</a>
                <a href="{{ route('news.index') }}">News</a>
                <a href="{{ route('feedback.index') }}">Feedback</a>
                <a href="{{ route('savedlist') }}">
                    Saved
                    @if(Auth::check() && isset(Auth::user()->savedDevices))
                    <sup style="font-size: 12px; color: #003684;">
                        {{ count(Auth::user()->savedDevices) }}
                    </sup>
                    @endif
                </a>
            </div>
            <form action="{{ route('search.all') }}" method="GET" class="d-flex align-items-center" id="searchForm">
                <input type="text" name="query" class="form-control" placeholder="Search devices or brands..." required id="searchInput">
                <button type="submit" class="btn btn-primary ms-2 ml-1">Search</button>
                <button type="button" class="btn btn-secondary ms-2 ml-1" id="cancelSearch">Cancel</button>
            </form>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const searchInput = document.getElementById('searchInput');
                    const cancelBtn = document.getElementById('cancelSearch');
                    searchInput.addEventListener('input', function() {
                        cancelBtn.style.display = this.value ? 'inline-block' : 'inline-block';
                    });
                    cancelBtn.addEventListener('click', function() {
                        searchInput.value = '';
                        searchInput.focus();
                    });
                });
            </script>

            @if(Auth::check())
            <div style="margin-left: 20px; font-weight: bold; display: flex; align-items: center;">
                {{ Auth::user()->name }}
                @if(isset(Auth::user()->role))
                <span style=" margin-left: 5px;">({{ Auth::user()->role }})</span>
                @endif
                <form action="{{ route('logout') }}" method="POST" style="display: inline; margin-left: 15px;">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                </form>
            </div>
            @else
            <a href="{{ route('login') }}" class="btn btn-primary" style="margin-left: 20px;background-color:#003684">Login</a>
            @endif
        </div>

        <div class="content">
            @yield('content')
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

        <footer class="footer">
            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%; flex-wrap: wrap; padding: 10px 15px; background-color: #222; color: white;">
                <div style="flex: 1; min-width: 200px; text-align: left;">
                    <div style="font-weight: bold; font-size: 18px;">
                        <a href="{{ route('welcome') }}" style="text-decoration: none; color: inherit;" class="m-0 p-0">
                            TechBit
                        </a>
                    </div>
                    <div style="font-size: 14px; color: #ccc;">Technical support</div>
                </div>

                <div style="flex: 2; min-width: 250px; display: flex; flex-direction: column; align-items: flex-end;">
                    <div style="color: #aaa; font-size: 13px;" class="mt-2">
                        copyright © 2025 -
                        <a href="#" style="color: #aaa; text-decoration: underline;">websitelink.com</a>
                    </div>
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

    <!-- Before </body> tag -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


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