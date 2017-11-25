	<!-- footer-section-starts-here -->
	<div class="footer">
		<div class="footer-top">
			<div class="wrap">
				<div class="col-md-3 col-xs-6 col-sm-4 footer-grid">
					<h4 class="footer-head">Tentang Kami</h4>
					<p>Penelitian Irsal Shabirin (2020151008) membahas tentang Pengelompokkan berita secara otomatis.</p>
					@if(isset($total_centroid))
						<p> Total Cluster saat ini : {{ $total_centroid }}</p>
					@endif

					@if(isset($total_dimensi))
						<p> Total Dimensi saat ini : {{ $total_dimensi }}</p>
					@endif

					@if(isset($total_article))
						<p> Total Berita saat ini : {{ $total_article }}</p>
					@endif


				</div>
				<!-- <div class="col-md-2 col-xs-6 col-sm-2 footer-grid">
					<h4 class="footer-head">Categories</h4>
					<ul class="cat">
						<li><a href="business.html">Business</a></li>
						<li><a href="technology.html">Technology</a></li>
						<li><a href="entertainment.html">Entertainment</a></li>
						<li><a href="sports.html">Sports</a></li>
						<li><a href="shortcodes.html">Health</a></li>
						<li><a href="fashion.html">Fashion</a></li>
					</ul>
				</div> -->
				<!-- <div class="col-md-4 col-xs-6 col-sm-6 footer-grid">
					<h4 class="footer-head">Flickr Feed</h4>
					<ul class="flickr">
						<li><a href="#"><img src="images/bus4.jpg"></a></li>
						<li><a href="#"><img src="images/bus2.jpg"></a></li>
						<li><a href="#"><img src="images/bus3.jpg"></a></li>
						<li><a href="#"><img src="images/tec4.jpg"></a></li>
						<li><a href="#"><img src="images/tec2.jpg"></a></li>
						<li><a href="#"><img src="images/tec3.jpg"></a></li>
						<li><a href="#"><img src="images/bus2.jpg"></a></li>
						<li><a href="#"><img src="images/bus3.jpg"></a></li>
						<div class="clearfix"></div>
					</ul>
				</div> -->
				<div class="col-md-3 col-xs-12 footer-grid">
					<h4 class="footer-head">Hubungi Kami</h4>
					<span class="hq">Lokasi Penelitian</span>
					<address>
						<ul class="location">
							<li><span class="glyphicon glyphicon-map-marker"></span></li>
							<li style="text-transform: uppercase;">Jl. Raya ITS - Kampus PENS Sukolilo, Surabaya 60111, INDONESIA</li>
							<div class="clearfix"></div>
						</ul>	
						<ul class="location">
							<li><span class="glyphicon glyphicon-earphone"></span></li>
							<li>+62 31 594 7280</li>
							<div class="clearfix"></div>
						</ul>	
						<!-- <ul class="location">
							<li><span class="glyphicon glyphicon-envelope"></span></li>
							<li><a href="mailto:info@example.com">mail@example.com</a></li>
							<div class="clearfix"></div>
						</ul> -->
					</address>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="wrap">
				<div class="copyrights col-md-6">
					<p> © 2017 Beritaku. All Rights Reserved | Design by  <a href="http://w3layouts.com/"> W3layouts</a></p>
				</div>
				<div class="footer-social-icons col-md-6">
					<ul>
						<li><a class="facebook" href="#"></a></li>
						<li><a class="twitter" href="#"></a></li>
						<li><a class="flickr" href="#"></a></li>
						<li><a class="googleplus" href="#"></a></li>
						<li><a class="dribbble" href="#"></a></li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- footer-section-ends-here -->
	<script type="text/javascript">

		function ImgError(source) {
			console.log("fldksjafs");
			source.src = "{!! URL::asset('assets/images/placeholder.jpg') !!}";
			// source.onerror = "{!! URL::asset('assets/images/logo-aplikasi3.jpg') !!}";
			// console.log(source.onerror);
			return true;
		}

		$(document).ready(function() {
					/*
					var defaults = {
					wrapID: 'toTop', // fading element id
					wrapHoverID: 'toTopHover', // fading element hover id
					scrollSpeed: 1200,
					easingType: 'linear' 
					};
					*/
			$().UItoTop({ easingType: 'easeOutQuart' });
		});
</script>