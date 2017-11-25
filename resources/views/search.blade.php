<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Search</title>

        <!-- Bootstrap -->
        <link href="{{ URL::asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ URL::asset('bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="{{ URL::asset('assets/css/custom.css') }}" rel="stylesheet">
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <!-- page content -->
                <div class="col-md-12">
                    <div class="col-middle">
                        <div class="text-center">
                            <h1 class="error-number">Beritaku</h1>
                            <!--                            <h2>Internal Server Error</h2>
                                                        <p>We track these errors automatically, but if the problem persists feel free to contact us. In the meantime, try refreshing. <a href="#">Report this?</a>
                                                        </p>-->
                            <div class="mid_center_search">
                                <!--<h3>Search</h3>-->
                                <form action="{{ URL::asset('search/result') }}" method="get">
                                    <div class="col-lg-12 form-group pull-right top_search">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="q" placeholder="Search for...">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">Go!</button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            Stemming - Sastrawi - <a href="https://github.com/sastrawi/sastrawi">https://github.com/sastrawi/sastrawi</a>
                        </div>

                    </div>
                </div>
                <!-- /page content -->
            </div>
        </div>

        <!-- jQuery -->
        <script src="{{ URL::asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
        <!-- Bootstrap -->
        <script src="{{ URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
        <!-- FastClick -->
        <script src="{{ URL::asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
        <!-- NProgress -->
        <script src="{{ URL::asset('bower_components/nprogress/nprogress.js') }}"></script>

        <!-- Custom Theme Scripts -->
        <script src="{{ URL::asset('assets/js/custom.js') }}"></script>
    </body>
</html>