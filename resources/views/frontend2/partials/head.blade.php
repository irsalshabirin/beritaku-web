<head>
	<title>Beritaku - @yield('header_title', '')</title>

	<!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
	<link href="{{ URL::asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<!-- <script src="js/jquery.min.js"></script> -->
	<script src="{{ URL::asset('bower_components/jquery/dist/jquery.min.js') }}"></script>

	<!-- Custom Theme files -->
	<!-- <link href="css/style.css" rel="stylesheet" type="text/css" media="all" /> -->
	<link href="{{ URL::asset('assets/css/frontend2.css') }}" rel="stylesheet" type="text/css" media="all" />

	<!-- Custom Theme files -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Berita, News" />
	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

	<!-- for bootstrap working -->
		<!-- <script type="text/javascript" src="js/bootstrap.js"></script> -->
        <script src="{{ URL::asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
	<!-- //for bootstrap working -->

	<!-- web-fonts -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>

	<script src="{{ URL::asset('assets/js/frontend2/responsiveslides.min.js') }}"></script>
	<script>
		$(function () {
		  $("#slider").responsiveSlides({
			auto: true,
			nav: true,
			speed: 500,
			namespace: "callbacks",
			pager: true,
		  });
		});
	</script>

	<!-- <script type="text/javascript" src="js/move-top.js"></script> -->
	<script type="text/javascript" src="{{ URL::asset('assets/js/frontend2/move-top.js') }}"></script>

	<!-- <script type="text/javascript" src="js/easing.js"></script> -->
	<script type="text/javascript" src="{{ URL::asset('assets/js/frontend2/easing.js') }}"></script>

	<!--script-->
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event){		
				event.preventDefault();
				$('html,body').animate({scrollTop:$(this.hash).offset().top},900);
			});
		});
	</script>

	@yield('extend-header')

</head>


