@extends('Fontend.layout.main')
@section('content')

	<aside id="fh5co-hero" class="js-fullheight">
		<div class="flexslider js-fullheight">
			<ul class="slides">
				{{-- <li style="background-image:  url('https://img.ws.mms.shopee.vn/9a07bada68627bd8dd1fc33c91cf6554');"> --}}
				{{-- <li style="background-image:  url('https://minhduy.vn/porogum/2023/05/Shopee-tui-1.jpg.webp');"> --}}
				{{-- <li style="background-image:  url('https://unica.vn/media/imagesck/1601544606_t%E1%BA%A1o-banner-online-1-min.jpg?v=1601544606');"> --}}
				<li style="background-image: url('https://vtcc.vn/wp-content/uploads/2023/04/abf1a497-a70b-48f9-8a8c-cc2667529e3a_hero-etsy-banner.jpg');">

					<div class="overlay-gradient"></div>
					<div class="container">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
							<div class="slider-text-inner">
								<div class="desc">
									<span class="price"></span>
									<h2>Alato Cabinet</h2>
									<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.</p>
									<p><a href="single.html" class="btn btn-primary btn-outline btn-lg">Purchase Now</a></p>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li style="background-image: url('https://cf.shopee.vn/file/2ae310db9c4ff4f4ed6f59be938b6d7d');">
					<div class="container">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
							<div class="slider-text-inner">
								<div class="desc">
									<span class="price">$530</span>
									<h2>The Haluz Rocking Chair</h2>
									<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.</p>
									<p><a href="single.html" class="btn btn-primary btn-outline btn-lg">Purchase Now</a></p>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li style="background-image: url('https://unica.vn/media/imagesck/1601544606_t%E1%BA%A1o-banner-online-1-min.jpg?v=1601544606');">
					<div class="container">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
							<div class="slider-text-inner">
								<div class="desc">
									<span class="price">$750</span>
									<h2>Alato Cabinet</h2>
									<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.</p>
									<p><a href="single.html" class="btn btn-primary btn-outline btn-lg">Purchase Now</a></p>
								</div>
							</div>
						</div>
					</div>
				</li>
				<li style="background-image: url('https://img.ws.mms.shopee.vn/9a07bada68627bd8dd1fc33c91cf6554');">
					<div class="container">
						<div class="col-md-6 col-md-offset-3 col-md-pull-3 js-fullheight slider-text">
							<div class="slider-text-inner">
								<div class="desc">
									<span class="price">$540</span>
									<h2>The WW Chair</h2>
									<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. Separated they live in Bookmarksgrove.</p>
									<p><a href="single.html" class="btn btn-primary btn-outline btn-lg">Purchase Now</a></p>
								</div>
							</div>
						</div>
					</div>
				</li>
				</ul>
			</div>
	</aside>
	
	<div id="fh5co-product">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<span>Cool Stuff</span>
					<h2>Products.</h2>
					<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
				</div>
			</div>
			<div class="row">
				@foreach ($products as $item)
					<div class="col-md-4 text-center animate-box">
						<div class="product">
							<div class="product-grid" style="background-image:url('{{ $item->avatar }}');">
								<div class="inner">
									<p>
										<a href="single.html" class="icon"><i class="icon-shopping-cart"></i></a>
										<a href="{{ route('client.product_detail', $item->id) }}" class="icon"><i class="icon-eye"></i></a>
									</p>
								</div>
							</div>
							<div class="desc">
								<h3><a href="{{ route('client.product_detail', $item->id) }}">{{ $item->name }}</a></h3>
								<span class="price">$350</span>
							</div>
						</div>
					</div>	
				@endforeach
			</div>
		</div>
	</div>

	<div id="fh5co-started">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>Newsletter</h2>
					<p>Just stay tune for our latest Product. Now you can subscribe</p>
				</div>
			</div>
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2">
					<form class="form-inline">
						<div class="col-md-6 col-sm-6">
							<div class="form-group">
								<label for="email" class="sr-only">Email</label>
								<input type="email" class="form-control" id="email" placeholder="Email">
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<button type="submit" class="btn btn-default btn-block">Subscribe</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<footer id="fh5co-footer" role="contentinfo">
		<div class="container">
			<div class="row row-pb-md">
				<div class="col-md-4 fh5co-widget">
					<h3>Shop.</h3>
					<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1">
					<ul class="fh5co-footer-links">
						<li><a href="#">About</a></li>
						<li><a href="#">Help</a></li>
						<li><a href="#">Contact</a></li>
						<li><a href="#">Terms</a></li>
						<li><a href="#">Meetups</a></li>
					</ul>
				</div>

				<div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1">
					<ul class="fh5co-footer-links">
						<li><a href="#">Shop</a></li>
						<li><a href="#">Privacy</a></li>
						<li><a href="#">Testimonials</a></li>
						<li><a href="#">Handbook</a></li>
						<li><a href="#">Held Desk</a></li>
					</ul>
				</div>

				<div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1">
					<ul class="fh5co-footer-links">
						<li><a href="#">Find Designers</a></li>
						<li><a href="#">Find Developers</a></li>
						<li><a href="#">Teams</a></li>
						<li><a href="#">Advertise</a></li>
						<li><a href="#">API</a></li>
					</ul>
				</div>
			</div>

			<div class="row copyright">
				<div class="col-md-12 text-center">
					<p>
						<small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small> 
						<small class="block">Designed by <a href="http://freehtml5.co/" target="_blank">FreeHTML5.co</a> Demo Images: <a href="http://blog.gessato.com/" target="_blank">Gessato</a> &amp; <a href="http://unsplash.co/" target="_blank">Unsplash</a></small>
					</p>
					<p>
						<ul class="fh5co-social-icons">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>
				</div>
			</div>

		</div>
	</footer>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>

@endsection