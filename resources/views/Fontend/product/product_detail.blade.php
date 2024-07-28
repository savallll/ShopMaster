@extends('Fontend.layout.main')
@section('content')
    {{-- <header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url('{{ optional($product->category)->first() ? $product->category->first()->avatar : '' }} ');"> --}}
    <header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner"
        style="background-image:url('{{ optional($product->category)->avatar }}');">

        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeIn">
                            <h1>{{ optional($product->category)->name }}</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="fh5co-product">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 animate-box">
                    @if (!optional($product->images->first())->path)
                        <div class="container pb-4 ">
                            <div class="d-flex justify-content-center">
                                <img src="{{ $product->avatar }}" alt="productImage">
                            </div>
                        </div>
                    @else
                        <div class="owl-carousel owl-carousel-fullwidth product-carousel">
                            <div class="item">
                                <div class="active text-center">
                                    <figure>
                                        <img src="{{ $product->avatar }}" alt="productImage">
                                    </figure>
                                </div>
                            </div>
                            @foreach ($product->images as $item)
                                <div class="item">
                                    <div class="active text-center">
                                        <figure>
                                            <img src="{{ $item->path }}" alt="productImage">
                                        </figure>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endif

                    <div class="row animate-box">
                        <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                            <h2>{{ $product->name }}</h2>
                            <div class="d-flex justify-content-center align-items-center">
                                <p>Số lượng: </p>
                                <form action="{{ route('client.cart.store', $product->id) }}" method="post"
                                    id="quantityForm" >
                                    @csrf
                                    <input type="number" min="0" max="{{ $product->number }}" name="quantity" class="form-control"
                                        style="max-width: 50px; max-height: 40px">
                                </form>
                                <p class="ps-4">có sẵn: {{ $product->number }} </p>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <button id="submitForm" class="btn btn-primary btn-outline btn-lg ">Add to Car</button>
                                <script>
                                    document.getElementById('submitForm').addEventListener('click', function() {
                                        document.getElementById('quantityForm').submit();
                                    });
                                </script>
                                <a href="#" class="btn btn-primary btn-outline btn-lg">Compare</a>
                                <a class="btn btn-primary btn-outline btn-lg" id="contactBtn">Contact</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="fh5co-tabs animate-box">
                        <ul class="fh5co-tab-nav">
                            <li class="active"><a href="#" data-tab="1"><span class="icon visible-xs"><i
                                            class="icon-file"></i></span><span class="hidden-xs">Product Details</span></a>
                            </li>
                            <li><a href="#" data-tab="2"><span class="icon visible-xs"><i
                                            class="icon-bar-graph"></i></span><span
                                        class="hidden-xs">Specification</span></a></li>
                            <li><a href="#" data-tab="3"><span class="icon visible-xs"><i
                                            class="icon-star"></i></span><span class="hidden-xs">Feedback &amp;
                                        Ratings</span></a></li>
                        </ul>

                        <!-- Tabs -->
                        <div class="fh5co-tab-content-wrap">

                            <div class="fh5co-tab-content tab-content active" data-tab-content="1">
                                <div class="col-md-10 col-md-offset-1">
                                    <span class="price">{{ number_format($product->price, 0, ',', '.') }} đ</span>
                                    <h2>{{ $product->name }}</h2>
                                    <p>Paragraph placeat quis fugiat provident veritatis quia iure a debitis adipisci
                                        dignissimos consectetur magni quas eius nobis reprehenderit soluta eligendi quo
                                        reiciendis fugit? Veritatis tenetur odio delectus quibusdam officiis est.</p>

                                    <p>Ullam dolorum iure dolore dicta fuga ipsa velit veritatis molestias totam fugiat
                                        soluta accusantium omnis quod similique placeat at. Dolorum ducimus libero fuga
                                        molestiae asperiores obcaecati corporis sint illo facilis.</p>
                                    <p>{{ $product->description }}</p>
                                    <div class="row mt-5">
                                        <div class="col-md-6">
                                            <h2 class="uppercase">Người bán</h2>
                                            <a href="/"
                                                class="text-decoration-none">{{ $product->user->name ?? '' }}</a>
                                        </div>
                                        <div class="col-md-6">
                                            <h2 class="uppercase">Địa chỉ</h2>
                                            <p>{{ $product->getAddressAttribute() ?? '' }}</p>
                                        </div>
                                    </div>
                                    <p>ngày đăng:</p>
                                    <p class="smail">{{ $product->created_at }}</p>

                                </div>
                            </div>

                            <div class="fh5co-tab-content tab-content" data-tab-content="2">
                                <div class="col-md-10 col-md-offset-1">

                                    <h3>Product Specification</h3>
                                    <ul>
                                        <li>Paragraph placeat quis fugiat provident veritatis quia iure a debitis adipisci
                                            dignissimos consectetur magni quas eius</li>
                                        <li>adipisci dignissimos consectetur magni quas eius nobis reprehenderit soluta
                                            eligendi</li>
                                        <li>Veritatis tenetur odio delectus quibusdam officiis est.</li>
                                        <li>Magni quas eius nobis reprehenderit soluta eligendi quo reiciendis fugit?
                                            Veritatis tenetur odio delectus quibusdam officiis est.</li>
                                    </ul>
                                    <ul>
                                        <li>Paragraph placeat quis fugiat provident veritatis quia iure a debitis adipisci
                                            dignissimos consectetur magni quas eius</li>
                                        <li>adipisci dignissimos consectetur magni quas eius nobis reprehenderit soluta
                                            eligendi</li>
                                        <li>Veritatis tenetur odio delectus quibusdam officiis est.</li>
                                        <li>Magni quas eius nobis reprehenderit soluta eligendi quo reiciendis fugit?
                                            Veritatis tenetur odio delectus quibusdam officiis est.</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="fh5co-tab-content tab-content" data-tab-content="3">
                                <div class="col-md-10 col-md-offset-1">
                                    <h3>Happy Buyers</h3>
                                    <div class="feed">
                                        <div>
                                            <blockquote>
                                                <p>Paragraph placeat quis fugiat provident veritatis quia iure a debitis
                                                    adipisci dignissimos consectetur magni quas eius nobis reprehenderit
                                                    soluta eligendi quo reiciendis fugit? Veritatis tenetur odio delectus
                                                    quibusdam officiis est.</p>
                                            </blockquote>
                                            <h3>&mdash; Louie Knight</h3>
                                            <span class="rate">
                                                <i class="icon-star2"></i>
                                                <i class="icon-star2"></i>
                                                <i class="icon-star2"></i>
                                                <i class="icon-star2"></i>
                                                <i class="icon-star2"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <blockquote>
                                                <p>Paragraph placeat quis fugiat provident veritatis quia iure a debitis
                                                    adipisci dignissimos consectetur magni quas eius nobis reprehenderit
                                                    soluta eligendi quo reiciendis fugit? Veritatis tenetur odio delectus
                                                    quibusdam officiis est.</p>
                                            </blockquote>
                                            <h3>&mdash; Joefrey Gwapo</h3>
                                            <span class="rate">
                                                <i class="icon-star2"></i>
                                                <i class="icon-star2"></i>
                                                <i class="icon-star2"></i>
                                                <i class="icon-star2"></i>
                                                <i class="icon-star2"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
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
                    <p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci
                        architecto culpa amet.</p>
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
                        <small class="block">Designed by <a href="http://freehtml5.co/" target="_blank">FreeHTML5.co</a>
                            Demo Images: <a href="http://blog.gessato.com/" target="_blank">Gessato</a> &amp; <a
                                href="http://unsplash.co/" target="_blank">Unsplash</a></small>
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
    </div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
    </div>
    {{-- <div class="">
		<a href="#" class="button"><i class="">contact</i></a>
	</div> --}}
    <script>
        // Lấy phần tử button và div chatbox
        const contactBtn = document.getElementById('contactBtn');
        const chatbox = document.getElementById('chatbox');

        // Thêm sự kiện click cho nút "Contact"
        contactBtn.addEventListener('click', function() {
            // Kiểm tra trạng thái hiện tại của div chatbox
            if (chatbox.style.display === 'none') {
                // Nếu đang ẩn, hiển thị div chatbox và thêm lớp 'show'
                chatbox.style.display = 'block';
                chatbox.classList.add('show');
            } else {
                // Nếu đang hiển thị, ẩn div chatbox và xóa lớp 'show'
                chatbox.style.display = 'none';
                chatbox.classList.remove('show');
            }
        });
    </script>



    {{-- chatbox --}}
    {{-- <div class="container chatbox" id="chatbox" style="display: none">
									<div class="" style="max-width: 500px; max-height: 200px;">
										<div class="inbox_msg border-0">
											<div class="mesgs w-100" style="height: 400px; background-color: white; overflow: scroll;">
											<div class="msg_history">
												<div class="incoming_msg">
												<div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
												<div class="received_msg">
													<div class="received_withd_msg">
													<p>Test which is a new approach to have all
														solutions</p>
													<span class="time_date"> 11:01 AM    |    June 9</span></div>
												</div>
												</div>
												<div class="outgoing_msg">
												<div class="sent_msg">
													<p>Test which is a new approach to have all
													solutions</p>
													<span class="time_date"> 11:01 AM    |    June 9</span> </div>
												</div>
												<div class="incoming_msg">
												<div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
												<div class="received_msg">
													<div class="received_withd_msg">
													<p>Test, which is a new approach to have</p>
													<span class="time_date"> 11:01 AM    |    Yesterday</span></div>
												</div>
												</div>
												<div class="outgoing_msg">
												<div class="sent_msg">
													<p>Apollo University, Delhi, India Test</p>
													<span class="time_date"> 11:01 AM    |    Today</span> </div>
												</div>
												<div class="incoming_msg">
												<div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
												<div class="received_msg">
													<div class="received_withd_msg">
													<p>We work directly with our designers and suppliers,
														and sell direct to you, which means quality, exclusive
														products, at a price anyone can afford.</p>
													<span class="time_date"> 11:01 AM    |    Today</span></div>
												</div>
												</div>
											</div>
											<div class="type_msg">
												<div class="input_msg_write">
												<input v-model="message" type="text" class="write_msg" onkeyup="" placeholder="Type a message">
												<button class="msg_send_btn" type="button" onclick="sendMessage()"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
												</div>
											</div>
											</div>
										</div>
										
									</div>
								</div> --}}
    {{-- //chatbox --}}
    {{-- <script>
		new Vue({
		el: "#chatbox",
		data() {
			return {
			id: {{ auth()->id() }},
			message: "",
			users: [],
			messages: [],
			}
		},
		methods: {
			sendMessage() {
			axios.post('/message', { message: this.message })
			this.message = ""
			}
		},
		mounted() {
			const echo = new Echo({
			broadcaster: "socket.io"
			})

			echo.join('chat')
			.here((users) => {
			this.users = users
			})
			.listen('MessageSent', (event) => {
			this.messages.push(event);
			});
		},
		})
	</script> --}}


@endsection
