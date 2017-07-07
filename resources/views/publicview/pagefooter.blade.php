	<footer id="footer"><!--Footer-->

		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="single-widget">
							<h2 class="text-center" style="color: #1C74B4; font-size: 24px;">Send Inquiry Get Updated Information</h2>
							<form id="inquiryform" method="post" class="form-horizontal" data-toggle="validator">

								<div class="form-group">
										 <label class="col-md-2 control-label" style="padding-left: 0px;">Looking For </label>
										<div class="col-md-10 radio-group">
												<label class="radio-inline col-md-3"><input type="radio" checked="checked" name="interest"  value="products">Products</label>
												<label class="radio-inline col-md-3"><input type="radio" name="interest" value="buyers">Buyers</label>
												<label class="radio-inline col-md-3"><input type="radio" name="interest" value="suppliers">Suppliers</label>
												<div class="help-block with-errors"></div>
										</div>
								</div>
								<div class="form-group">
										<input type="email" required name="email" class="form-control" placeholder="Your Email* " />
								</div>
								<div class="form-group">
									<input type="text" required name="country" class="form-control" placeholder="Country* " />
								</div>
								<div class="form-group">
									<input type="text" required name="product_name" class="form-control" placeholder="Mention Your Products Name* " />
								</div>
								<div class="form-group text-right">
									<button type="submit" class="btn btn-default btn-blue">Subscribe</button>
								</div>
							</form>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="single-widget text-center">
						 	<div class="row"> <a href="{{url('auth/register')}}"> <img style="padding:5px" src="{{URL::asset('images/join-free.png')}}" alt="" /> </a> </div>
							<div class="row"> <a href=""> <img style="padding:5px" src="{{URL::asset('images/about-us.png')}}" alt="" /> </a> </div>
							<div class="row"> <a href=""> <img style="padding:5px"src="{{URL::asset('images/contact-us.png')}}" alt="" /> </a> </div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="single-widget">
							<a href="{{url('buying-request/new')}}" class="btn btn-default orangecolor get wid100"
								 style="margin: 0px; margin-bottom: 10px">Post Buying Request</a>

							<h2 class="text-center">Our Services</h2>

							<a href="" class="btn btn-default btn-blue wid100" style="margin: 0px; margin-bottom: 10px">Premium Membership</a>
							<a href="" class="btn btn-default btn-blue wid100" style="margin: 0px; margin-bottom: 10px">Advertisement Solution</a>
							<a href="" class="btn btn-default btn-blue wid100" style="margin: 0px; margin-bottom: 10px">Market Intelligence</a>
							<a href="" class="btn btn-default btn-blue wid100" style="margin: 0px; margin-bottom: 10px">IT Solutions</a>
							<a href="" class="btn btn-default btn-blue wid100" style="margin: 0px; margin-bottom: 10px">Journal</a>


						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © 2015. All rights reserved.</p>
					<p class="pull-right">Designed and Developed by <span><a target="_blank" href="http://www.balancika.com/">Balancika Outsourcing</a></span></p>
				</div>
			</div>
		</div>

	</footer><!--/Footer-->
