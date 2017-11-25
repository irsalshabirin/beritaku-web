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

                            <div class="mid_center_search">
                                <!--<h3>Search</h3>-->
                                <form action="" method="get">
                                    <div class="col-lg-12 form-group pull-right top_search">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="q" placeholder="Search for..." value="{{ $q }}">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">Go!</button>
                                            </span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="x_panel">
                        <div class="x_content">
                            <div style="width: 50%;margin: 0 auto;">
                                Waktu yang dibutuhkan : {{ $time }} detik
                                <!-- start result search -->
                                <ul class="messages">
                                    @foreach($results as $result)
                                    <li>
                                        <div class="message_date">
                                            <!--<h3 class="date text-info">{{ $result->word }}</h3>-->
                                            <!--<p class="month">{{ $result->val }}</p>-->
                                            <!--<p class="year">2015</p>-->
                                        </div>
                                        <div>
                                            <h4 class="heading"><a href="{{ $result->link }}" target="_blank">{{ $result->title }}</a></h4>
                                            <blockquote class="message">
                                                {{ date('d, F Y', strtotime($result->publish_date)) }}<br>
                                                {{ substr(strip_tags($result->content), 0, 255) }}... - {{$result->feed_title}}<br>
                                            </blockquote>
                                            <p class="url">
                                                <span class="fs1 text-info" aria-hidden="true">tag : {{ $result->word }}, nilai : [{{ $result->val }}]</span>
                                                <!--<a href="#"><i class="fa fa-paperclip"></i> User Acceptance Test.doc </a>-->
                                            </p>
                                        </div>
                                    </li>
                                    @endforeach

                                </ul>
                                <!-- end result search -->
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                    <ul class="pagination pagination-split">
                                        @if(1 != $page)
                                            <li><a href="{{ URL::asset('search/result/1?q=' . $q) }}">&laquo;</a></li>
                                        @endif

                                        @for($i = $page - 4; $i < $page + 4; $i++)
                                        @if($i > 0 && $i < $total_pages)
                                        @if($i == $page)
                                        <li><a >{{ $i }}</a></li>
                                        @else
                                        <li><a href="{{ URL::asset('search/result/' . $i . '?q='  . $q) }}">{{ $i }}</a></li>
                                        @endif
                                        @endif
                                        @endfor

                                        @if($total_pages != $page)
                                        <li><a href="{{ URL::asset('search/result/' . $total_pages . '?q=' . $q) }}">&raquo;</a></li>
                                        @endif
                                    </ul>
                                </div>
                                
                                Stemming - Sastrawi - <a href="https://github.com/sastrawi/sastrawi">https://github.com/sastrawi/sastrawi</a>
                            </div>
                            
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