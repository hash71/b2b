@extends('publicview.master')

@section('title', 'Home')


@section('pagebody')

    <div class="row heroimage mrgB10">
        <img src="{{URL::asset($heroimage)}}" alt="">
        @include('publicview.homesearchbar')
    </div>

    <div class="row">
        @include('publicview.category')

        <div class="col-sm-9 padding-right">
            <div class="features_items" style="padding-bottom: 10px;"><!--features_items-->
                <div class="col-sm-9 single-element" style="width: 70%; margin-right: 15px;">
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-sm-6">
                            <div class="brands_products"><!--brands_products-->
                                <h2 style="text-align: left;">Buying Leads<a
                                            href="{{url('search/search-bar?search_type=Buyers&amp;name=')}}"
                                            class="pull-right">More <i
                                                class="fa fa-angle-right"></i></a></h2>

                                <div class="brands-name">
                                    <ul class="nav nav-pills nav-stacked">
                                        <?php $buys = \App\Buyproduct::where('approved',1)->orderBy('id', 'desc')->limit(7)->get();?>
                                        @foreach($buys as $buy)
                                            <?php $country = strtolower(array_search($buy->country, country_list()));?>
                                            <li><a href="{{url('single-buying-request',$buy->id)}}">
                                                    <span class="date pull-right">{{$buy->created_at->format('F j')}}</span>
                                                    <span class="{{"flag-icon flag-icon-".$country}}"></span> {{$buy->product_name}}
                                                </a>
                                            </li>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="brands_products"><!--brands_products-->
                                <h2 style="text-align: left;">Latest Products<a
                                            href="{{url('search/search-bar?search_type=Products&amp;name=')}}"
                                            class="pull-right">More <i
                                                class="fa fa-angle-right"></i></a></h2>
                                <div class="brands-name">
                                    <ul class="nav nav-pills nav-stacked">
                                        <?php $products = \App\Product::where('approved',1)->orderBy('id', 'desc')->limit(7)->get();?>
                                        @foreach($products as $product)
                                            <?php $country = strtolower(array_search(App\User::where('id', $product->user)->value('country'), country_list()));?>
                                            <li><a href="{{url('single-product',$product->id)}}">
                                                    <span class="date pull-right">{{$product->created_at->format('F j')}}</span>
                                                    <span class="{{"flag-icon flag-icon-".$country}}"></span> {{$product->name}}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="specialbtngroup">
                        <a href="{{url('auth/register')}}" class="btn btn-default btn-blue btn30">Create business
                            website free</a>
                        <a class="btn btn-default btn-blue btn20">Advertise</a>
                        <a href="{{url('auth/register')}}" class="btn btn-default btn-blue btn25">Premium membership</a>
                        <a href="{{url('sourcing-request')}}" class="btn btn-default btn-blue btn25">Sourcing
                            Request</a>
                    </div>

                </div>

                <div class="col-sm-3 single-element" style="width: 28%; border: 2px solid #ED8131;">
                    <a href="{{url('buying-request/new')}}" class="btn btn-default orangecolor get wid100"
                       style="margin: 0px; margin-bottom: 10px">Post Buying Request</a>

                    <div class="rightsidebartop">

                        <div class="rightsidebartophead mrgB10">
                            <h5 class="text-center">Welcome to Sourcing Key</h5>
                            <hr>
                            @if(!Auth::check())
                                <div class="signlink col-sm-12">
                                    <a href="{{url('auth/login')}}" class="col-sm-6"><i class="fa fa-sign-in"></i> Sign
                                        In</a>
                                    <a href="{{url('auth/register')}}" class="col-sm-6"><i class="fa fa-user"></i> Join
                                        Free</a>
                                </div>
                            @endif
                        </div>

                        <ul class="nav nav-tabs col-sm-12 mrgB10" style="padding-right: 0px; border-bottom: none;">
                            <li class="active col-sm-6"><a data-toggle="tab" href="#buyer">For Buyer</a></li>
                            <li class="col-sm-6"><a data-toggle="tab" href="#seller">For Seller</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="buyer" class="tab-pane fade in active">
                                <ul>
                                    <li><a href="{{url('buying-request/new')}}"><i class="fa fa-angle-right"></i> Post
                                            Buying Offers</a></li>
                                    <li><a href="{{url('search/search-bar?search_type=Products&amp;name=')}}"><i class="fa fa-angle-right"></i> Latest
                                            Products</a></li>
                                    <li></li>
                                </ul>
                            </div>
                            <div id="seller" class="tab-pane fade">
                                <ul>
                                    <li><a href="{{url('auth/register')}}"><i class="fa fa-angle-right"></i> Create
                                            Business Website Free</a></li>
                                    <li><a href="{{url('products/add')}}"><i class="fa fa-angle-right"></i> Post Your
                                            Products</a></li>
                                    <li><a href="{{url('search/search-bar?search_type=Buyers&amp;name=')}}"><i
                                                    class="fa fa-angle-right"></i> Latest
                                            Buying Offers</a></li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div id="socialcontact">
                            <p>Contact Us:
                                <a href="{{$facebook}}"><img src="images/social/facebook.png" width="15px" alt=""></a>
                                <a href="{{$twitter}}"><img src="images/social/twitter.png" width="15px" alt=""></a>
                                <a href="{{$linkedin}}"><img src="images/social/linkedin.png" width="15px" alt=""></a>
                                <a href="{{$googleplus}}"><img src="images/social/googleplus.png" width="15px"
                                                               alt=""></a>
                            </p>
                            <p><i class="fa fa-envelope"></i> Email: {{$email}}</p>
                        </div>
                    </div>

                    <div class="specialbtngroup">
                        <a href="{{url('buying-request/new')}}" class="btn btn-default orangecolor wid100">Get Quotation
                            Now</a>
                    </div>
                </div>
            </div><!--features_items-->

            <div class="features_items single-element">
                <div class="col-sm-9">
                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">Featured Categories</h2>
                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">
                                    <?php $i = 0; ?>
                                    @foreach($featured_categories as $feat)
                                        @if($i%2==0 && $i>0)
                                </div>
                                <div class="item">
                                    @endif

                                    <div class="col-sm-6 text-center">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <a href="{{url('search/category',['Products',$feat->id])}}">
                                                        <img src="{{URL::asset($feat->image)}}" alt=""/>
                                                    </a>
                                                </div>
                                                <p>
                                                    <a href="{{url('search/category',['Products',$feat->id])}}">{{$feat->name}}</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i++; ?>
                                    @endforeach
                                </div>
                            </div>
                            <a class="left recommended-item-control" href="#recommended-item-carousel"
                               data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a class="right recommended-item-control" href="#recommended-item-carousel"
                               data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div><!--/recommended_items-->
                </div>
                <div class="col-sm-3">
                    <div class="brands_products"><!--brands_products-->
                        <a href="{{url('post-list/success story')}}"><h2>Success Stories</h2></a>
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <?php $post = \App\Post::where('type', 'success story')->orderBy('id', 'desc')->first();
                                  $image = $post->featured_image;
                                  if($image==null)
                                    $image = "images/common-placeholder.jpg";
                                ?>
                                <div class="productinfo text-center">
                                    <img src="{{URL::asset($image)}}" style="width: 190px;" alt="">
                                </div>
                                <div class="text-center">
                                    <p>{!! ttruncat($post->post, 100) !!}</p>
                                </div>
                                <a href="{{url('post-show',$post->id)}}" target="_blank" style="font-size: 12px; padding-right: 5px;" class="pull-right">Read More</a>
                                <img src="images/home/new.png" class="new" alt="">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="recommended_items single-element"><!--recommended_items-->
                <h2 class="title text-center">Spotlight Products</h2>
                <div id="spotlight-item-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            <?php $i = 0; ?>
                            @foreach($featured_products as $feat)
                                @if($i%6==0 && $i>0)
                        </div>
                        <div class="item">
                            @endif
                            <div class="col-sm-2 text-center">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="{{url('single-product',$feat->id)}}">
                                                <img src="{{first_image($feat->images)}}" alt=""/>
                                            </a>
                                        </div>
                                        <p><a href="{{url('single-product',$feat->id)}}">{{$feat->name}}</a></p>
                                    </div>
                                </div>
                            </div>
                            <?php $i++; ?>
                            @endforeach

                        </div>

                    </div>
                    <a class="left recommended-item-control" href="#spotlight-item-carousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right recommended-item-control" href="#spotlight-item-carousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div><!--/recommended_items-->

        </div>
    </div>

    <div class="row">
        <img src="images/home/bannerad2.png" class="wid100" alt="">
    </div>

    <div class="row row-eq-height mrgT20">
         <div class="col-sm-3 single-element" style="margin-right: 10px; width: 24%;">
            <div class="brands_products"><!--brands_products-->
                <a href="{{url('post-list/industry article')}}"><h2>Industry Articles</h2></a>
                <div class="brands-name">
                    <ul class="nav nav-pills nav-stacked">
                        <?php $posts = \App\Post::where('type', 'industry article')->orderBy('id', 'desc')->limit(5)->get(); ?>
                        @foreach($posts as $post)
                            <li>
                                <?php $image = $post->featured_image;
                                      if($image == null)
                                        $image = "images/common-placeholder.jpg";
                                ?>
                                <a href="{{url('post-show',$post->id)}}">
                                    <img style="margin-right: 10px;" width="40px;" src="{{URL::asset($image)}}" alt="" />
                                    {{ucfirst($post->title)}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{url('post-list','industry article')}}" class="pull-right padR20">More Article <i
                                class="fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col-sm-3 single-element" style="margin-right: 10px; width: 24%;">
            <div class="brands_products"><!--brands_products-->
                <a href="{{url('post-list/news')}}"><h2>News</h2></a>
                <div class="brands-name">
                    <ul class="nav nav-pills nav-stacked news">
                        <?php $posts = \App\Post::where('type', 'news')->orderBy('id', 'desc')->limit(5)->get(); ?>
                        @foreach($posts as $post)
                            <li>
                                <a href="{{url('post-show',$post->id)}}">
                                    <i class="fa fa-newspaper-o" style="margin-right: 10px;"></i>
                                    {{ucfirst($post->title)}}
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{url('post-list','news')}}" class="pull-right padR20">More News <i
                                class="fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="col-sm-3 single-element" style="margin-right: 10px; width: 24%;">
            <div class="brands_products"><!--brands_products-->
                <a href="{{url('post-list/market intelligence')}}"><h2>Market Intelligence</h2></a>
                <div class="product-image-wrapper brands-name">
                    <div class="single-products">
                      <?php $post = \App\Post::where('type', 'market intelligence')->orderBy('id', 'desc')->first();
                        $image = $post->featured_image;
                        if($image==null)
                          $image = "images/common-placeholder.jpg";
                      ?>
                        <div class="productinfo text-center">
                          <a class="text-center" href="{{url('post-show',$post->id)}}">
                            <h5 class="orangetext">{{ucfirst($post->title)}}</h5>
                            <img src="{{URL::asset($image)}}" style="width: 140px;" alt="">
                          </a>
                        </div>
                        <div class="text-center">
                            <br>
                            <p>{!! ttruncat($post->post, 100) !!}</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <div class="col-sm-3 single-element">
            <div class="brands_products"><!--brands_products-->
                <a href="{{url('post-list/trade fair')}}"><h2>Trade Fairs</h2></a>
                <div class="brands-name">
                    <ul class="nav nav-pills nav-stacked">
                        <?php $posts = \App\Post::where('type', 'trade fair')->orderBy('id', 'desc')->limit(2)->get(); ?>
                        @foreach($posts as $post)
                            <li>
                                <?php $image = $post->featured_image;
                                      if($image == null)
                                        $image = "images/common-placeholder.jpg";
                                ?>
                                <a class="text-center" href="{{url('post-show',$post->id)}}">
                                    <p class="orangetext" style="font-size: 16px;">
                                      <strong>{{strtoupper($post->title)}}</strong>
                                    </p>
                                    <img style="margin-right: 10px;" width="120px;" src="{{URL::asset($image)}}" alt="" />

                                    <p>{!! ttruncat($post->post, 100) !!}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>

                    <a href="{{url('post-list','trade fair')}}" class="pull-right padR20">More Fairs <i
                                class="fa fa-angle-right"></i></a>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <img src="images/home/bannerad.png" class="wid100" alt="">
    </div>

    <div class="row mrgT20 single-element">
        <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">Verified Suppliers</h2>
            <div id="verified-company-carousel" class="carousel slide" data-ride="carousel"
                 style="margin-left: 20px; margin-right: 20px;">
                <div class="carousel-inner">
                    <div class="item active">
                        <?php $i = 0; ?>
                        @foreach($verified_supplier as $verified)
                            @if($i%6==0 && $i>0)
                    </div>
                    <div class="item">
                        @endif

                        <div class="col-sm-2 text-center">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <?php $image = first_image(\App\Product::where('user', $verified->id)->limit(1)->value('images')); ?>
                                        <a href="{{url('company-profile',$verified->id)}}" target="_blank"><img
                                                    src="{{$image}}" alt=""/></a>
                                    </div>
                                    <p><a href="{{url('company-profile',$verified->id)}}"
                                          target="_blank">{{$verified->company_name}}</a></p>
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                        @endforeach
                    </div>
                </div>
                <a class="left recommended-item-control" href="#verified-company-carousel" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" href="#verified-company-carousel" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div><!--/recommended_items-->
    </div>

    <div class="row single-element">
        <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">Latest Video</h2>
            <div id="spotlight-item-carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="item active">
                        @foreach($videos as $video)
                            <div class="col-sm-3 text-center">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <iframe src="{{$video->content_link}}" frameborder="0"
                                                    allowfullscreen></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div><!--/recommended_items-->
    </div>

    <div class="row mrgT20 single-element">
        <div class="recommended_items"><!--recommended_items-->
            <h2 class="title text-center">Gold Suppliers</h2>
            <div id="company-item-carousel" class="carousel slide" data-ride="carousel"
                 style="margin-left: 20px; margin-right: 20px;">
                <div class="carousel-inner">
                    <div class="item active">
                        <?php $i = 0; ?>
                        @foreach($gold_supplier as $gold)
                            @if($i%6==0 && $i>0)
                    </div>
                    <div class="item">
                        @endif
                        <div class="col-sm-2 text-center">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <?php $image = first_image($gold->logo); ?>
                                        <a href="{{url('company-profile',$gold->id)}}" target="_blank"><img
                                                    style="max-height: 100px;" src="{{$image}}" alt=""/></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php $i++; ?>
                        @endforeach
                    </div>
                </div>
                <a class="left recommended-item-control" style="top: 20%" href="#company-item-carousel"
                   data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="right recommended-item-control" style="top: 20%" href="#company-item-carousel"
                   data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div><!--/recommended_items-->
    </div>
@endsection
