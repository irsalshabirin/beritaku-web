<!-- header-section-starts-here -->
<div class="header">
	<div class="header-top">
		<div class="wrap">
			<div class="top-menu">
				<ul>
					<li><a href="{{ url('/2') }}">Home</a></li>
					<li><a href="{{ url('/2/about') }}">About Us</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Contact Us</a></li>
				</ul>
			</div>
			<div class="num">
				<p> Call us : +62 31 594 7280</p>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<div class="header-bottom">
		<div class="logo text-center">
			<a href="{{ url('/2') }}"><img src="{{ URL::asset('assets/images/logo-aplikasi3.jpg') }}" alt="" /></a>
		</div>
		<div class="navigation">
			<nav class="navbar navbar-default" role="navigation">
	   			<div class="wrap">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<!--/.navbar-header-->
	
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li class="active"><a href="{{ url('/2') }}">Home</a></li>
							<li><a href="{{ url('/2/popular') }}">Terpopuler</a></li>
							<li><a href="{{ url('/2/news') }}">Terbaru</a></li>
							<!-- <li><a href="sports.html">Sports</a></li>
							    <li class="dropdown">
							    	<a href="#" class="dropdown-toggle" data-toggle="dropdown">Entertainment<b class="caret"></b></a>
							    	<ul class="dropdown-menu">
							    		<li><a href="entertainment.html">Movies</a></li>
							    		<li class="divider"></li>
										<li><a href="entertainment.html">Another action</a></li>
										<li class="divider"></li>
										<li><a href="entertainment.html">Articles</a></li>
										<li class="divider"></li>
										<li><a href="entertainment.html">celebrity</a></li>
										<li class="divider"></li>
										<li><a href="entertainment.html">One more separated link</a></li>
									</ul>
								</li>
							<li><a href="shortcodes.html">Health</a></li>
							<li><a href="fashion.html">Fashion</a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Business<b class="caret"></b></a>
								<ul class="dropdown-menu multi-column columns-2">
									<div class="row">
										<div class="col-sm-6">
											<ul class="multi-column-dropdown">
												<li><a href="business.html">Action</a></li>
												<li class="divider"></li>
												<li><a href="business.html">bulls</a></li>
												<li class="divider"></li>
												<li><a href="business.html">markets</a></li>
												<li class="divider"></li>
												<li><a href="business.html">Reviews</a></li>
												<li class="divider"></li>
												<li><a href="shortcodes.html">Short codes</a></li>
											</ul>
										</div>
										<div class="col-sm-6">
											<ul class="multi-column-dropdown">
											   <li><a href="#">features</a></li>	
												<li class="divider"></li>
												<li><a href="#">Movies</a></li>
											    <li class="divider"></li>
												<li><a href="#">sports</a></li>
												<li class="divider"></li>
												<li><a href="#">Reviews</a></li>
												<li class="divider"></li>
												<li><a href="#">Stock</a></li>
											</ul>
										</div>
									</div>
								</ul>
							</li>
							<li><a href="#">Technology</a></li> -->
							<div class="clearfix"></div>
						</ul>
						<div class="search">
							<!-- start search-->
						    <div class="search-box">
							    <div id="sb-search" class="sb-search">
									<form action="{{ url('2/search') }}" method="get">
										<input class="sb-search-input" placeholder="Cari..." type="search" name="search" id="search">
										<input class="sb-search-submit" type="submit" value="">
										<span class="sb-icon-search"> </span>
									</form>
								</div>
						    </div>
							<!-- search-scripts -->
							<script src="{{ URL::asset('assets/js/frontend2/classie.js') }}"></script>

							<!-- <script src="js/uisearch.js"></script> -->
							<script src="{{ URL::asset('assets/js/frontend2/uisearch.js') }}"></script>
								<script>
									new UISearch( document.getElementById( 'sb-search' ) );
								</script>
							<!-- //search-scripts -->
						</div>
						<div class="clearfix"></div>
					</div>
				</div>
			<!--/.navbar-collapse-->

 			<!--/.navbar-->
			<!-- </div> -->
			</nav>
		</div>
	</div>
<!-- header-section-ends-here -->

	@if(isset($headline_news))
	<div class="wrap">
		<div class="move-text">

			<div class="breaking_news">
				<h2>Breaking News</h2>
			</div>

			<div class="marquee">

				@foreach($headline_news as $headline)
					<div class="marquee1">
						<a class="breaking" href="{{ url('2/article/' . $headline->id) }}">{{ $headline->title }}</a>
					</div>
				@endforeach

				<div class="clearfix"></div>

			</div>

			<div class="clearfix"></div>

			<script type="text/javascript" src="{{ URL::asset('assets/js/frontend2/jquery.marquee.min.js') }}"></script>
			<script>
			  $('.marquee').marquee({ pauseOnHover: true });
			  //@ sourceURL=pen.js
			</script>
		</div>
	</div>
	@endif