<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Back END</title>

        <!-- Bootstrap -->
        <link href="{{ URL::asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ URL::asset('bower_components/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
        <!-- iCheck -->
        <link href="{{ URL::asset('bower_components/iCheck/skins/flat/green.css') }}" rel="stylesheet">
        <!-- bootstrap-progressbar -->
        <link href="{{ URL::asset('bower_components/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
        <!-- jVectorMap -->
        <link href="{{ URL::asset('assets/css/maps/jquery-jvectormap-2.0.3.css') }}" rel="stylesheet"/>

        <!-- Additional Library -->
        @yield('header-library')

        <!-- Custom Theme Style -->
        <link href="{{ URL::asset('assets/css/custom.css') }}" rel="stylesheet">
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">

                <!-- menu -->
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="{{ URL::asset('/admin') }}" class="site_title"><i class="fa fa-paw"></i> <span>Beritaku</span></a>
                        </div>

                        <div class="clearfix"></div>

                        <!-- menu profile quick info -->
                        <div class="profile">
                            <div class="profile_pic">
                                <img src="{{ URL::asset('assets/images/img.jpg') }}" alt="..." class="img-circle profile_img">
                            </div>

                            <div class="profile_info">
                                <span>Welcome,</span>
                                <h2>Irsal Shabirin</h2>
                            </div>

                        </div>
                        <!-- /menu profile quick info -->

                        <br />

                        <!-- sidebar menu -->
                        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                            <div class="menu_section">
                                <h3>Master</h3>
                                <ul class="nav side-menu">
                                    <li><a href="{{ URL::asset('admin') }}"><i class="fa fa-home"></i> Home </a></li>
                                    <!--<li><a href="{{ URL::asset('admin/category') }}"><i class="fa fa-sticky-note-o"></i> Category </a></li>-->
                                    <li><a href="{{ URL::asset('admin/feed') }}"><i class="fa fa-rss"></i> Feed </a></li>
                                    <li><a href="{{ URL::asset('admin/article') }}"><i class="fa fa-file-text"></i> Article </a></li>
                                </ul>
                            </div>

                            <div class="menu_section">
                                <h3>Additional</h3>
                                <ul class="nav side-menu">
                                    <li><a href="{{ URL::asset('admin/word') }}"><i class="fa fa-font"></i> Word </a></li>
                                    <!--<li><a href="{{ URL::asset('admin/stopword') }}"><i class="fa fa-stop-circle-o"></i> Stop Word </a></li>-->
                                </ul>
                            </div>
                        </div>
                        <!-- /sidebar menu -->



                        <!-- /menu footer buttons -->
                        <div class="sidebar-footer hidden-small">
                            <a data-toggle="tooltip" data-placement="top" title="Settings">
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Lock">
                                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                            </a>
                            <a data-toggle="tooltip" data-placement="top" title="Logout">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                            </a>
                        </div>
                        <!-- /menu footer buttons -->
                    </div>
                </div>
                <!-- menu -->

                <!-- top navigation -->
                <div class="top_nav">

                    <div class="nav_menu">
                        <nav class="" role="navigation">
                            <div class="nav toggle">
                                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                            </div>

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <img src="{{ URL::asset('assets/images/img.jpg') }}" alt="">Irsal Shabirin
                                        <span class=" fa fa-angle-down"></span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                                        <li
                                            ><a href="javascript:;">  Profile</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">
                                                <span class="badge bg-red pull-right">50%</span>
                                                <span>Settings</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">Help</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('/logout')}}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();"><i class="fa fa-sign-out pull-right"></i> Log Out</a>

                                            <form action="{{ url('logout') }}" method="post" id="logout-form">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            </form>
                                        </li>
                                    </ul>
                                </li>

                                <li role="presentation" class="dropdown">
                                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-envelope-o"></i>
                                        <span class="badge bg-green">6</span>
                                    </a>
                                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                                        <li>
                                            <a>
                                                <span class="image">
                                                    <img src="{{ URL::asset('assets/images/img.jpg') }}" alt="Profile Image" />
                                                </span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image">
                                                    <img src="{{ URL::asset('assets/images/img.jpg') }}" alt="Profile Image" />
                                                </span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image">
                                                    <img src="{{ URL::asset('assets/images/img.jpg') }}" alt="Profile Image" />
                                                </span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a>
                                                <span class="image">
                                                    <img src="{{ URL::asset('assets/images/img.jpg') }}" alt="Profile Image" />
                                                </span>
                                                <span>
                                                    <span>John Smith</span>
                                                    <span class="time">3 mins ago</span>
                                                </span>
                                                <span class="message">
                                                    Film festivals used to be do-or-die moments for movie makers. They were where...
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <div class="text-center">
                                                <a href="inbox.html">
                                                    <strong>See All Alerts</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- /top navigation -->


                <!-- page content -->
                @yield('content-admin')
                <!-- /page content -->

                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
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
        <!-- Chart.js -->
        <script src="{{ URL::asset('bower_components/Chart.js/dist/Chart.min.js') }}"></script>
        <!-- gauge.js -->
        <script src="{{ URL::asset('bower_components/gauge.js/dist/gauge.min.js') }}"></script>
        <!-- bootstrap-progressbar -->
        <script src="{{ URL::asset('bower_components/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
        <!-- iCheck -->
        <script src="{{ URL::asset('bower_components/iCheck/icheck.min.js') }}"></script>
        <!-- Skycons -->
        <script src="{{ URL::asset('bower_components/skycons/skycons.js') }}"></script>
        <!-- Flot -->
        <script src="{{ URL::asset('bower_components/Flot/jquery.flot.js') }}"></script>
        <script src="{{ URL::asset('bower_components/Flot/jquery.flot.pie.js') }}"></script>
        <script src="{{ URL::asset('bower_components/Flot/jquery.flot.time.js') }}"></script>
        <script src="{{ URL::asset('bower_components/Flot/jquery.flot.stack.js') }}"></script>
        <script src="{{ URL::asset('bower_components/Flot/jquery.flot.resize.js') }}"></script>
        <!-- Flot plugins -->
        <script src="{{ URL::asset('assets/js/flot/jquery.flot.orderBars.js') }}"></script>
        <script src="{{ URL::asset('assets/js/flot/date.js') }}"></script>
        <script src="{{ URL::asset('assets/js/flot/jquery.flot.spline.js') }}"></script>
        <script src="{{ URL::asset('assets/js/flot/curvedLines.js') }}"></script>
        <!-- jVectorMap -->
        <script src="{{ URL::asset('assets/js/maps/jquery-jvectormap-2.0.3.min.js') }}"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="{{ URL::asset('assets/js/moment/moment.min.js') }}"></script>
        <script src="{{ URL::asset('assets/js/datepicker/daterangepicker.js') }}"></script>

        <!-- Custom Theme Scripts -->
        <script src="{{ URL::asset('assets/js/custom.js') }}"></script>

        <!-- jVectorMap -->
        <script src="{{ URL::asset('assets/js/maps/jquery-jvectormap-world-mill-en.js') }}"></script>
        <script src="{{ URL::asset('assets/js/maps/jquery-jvectormap-us-aea-en.js') }}"></script>
        <script src="{{ URL::asset('assets/js/maps/gdp-data.js') }}"></script>

        <!-- Script additional -->
        @yield('footer-library')

        <!-- footer script -->
        @stack('footer-script')
    </body>
</html>