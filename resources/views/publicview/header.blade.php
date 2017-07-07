<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="{{url('/')}}">
                            <img src="{{URL::asset('images/logo.png')}}" alt=""
                                            style="max-width: 220px;"/></a>
                            </li>
                    </div>
                </div>
                <div class="col-sm-9 header_menu">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>

                    @if(!Auth::check())
                        <div class="contactinfo pull-left">
                            <ul class="nav nav-pills">
                                <li><a class="btn btn-default" href="{{url('auth/register')}}">Join Free</a></li>
                                <li><a href="{{url('auth/login')}}">Sign In</a></li>
                            </ul>
                        </div>
                    @endif

                    <div class="mainmenu pull-right">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li class="dropdown">
                                <a href="#">For Buyer<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="{{url('buying-request/new')}}">Post Buying Requests</a></li>
                                    <li><a href="{{url('search/search-bar?search_type=Products&amp;name=')}}">Latest Products</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#">For Supplier<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="{{url('auth/register')}}">Create Business website Free</a></li>
                                    <li><a href="{{url('products/add')}}">Post Your Products</a></li>
                                    <li><a href="{{url('search/search-bar?search_type=Buyers&amp;name=')}}">Latest Buying offers</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#">Info Center<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="{{url('post-list/news')}}">News</a></li>
                                    <li><a href="{{url('post-list/market intelligence')}}">Market Intelligence</a></li>
                                    <li><a href="{{url('post-list/industry article')}}">Articles</a></li>
                                    <li><a href="{{url('post-list/trade fair')}}">Trade Fairs</a></li>
                                    <li><a href="#">Directory</a></li>
                                    <li><a href="#">Magazine</a></li>
                                </ul>
                            </li>
                            @if(Auth::check())
                            <li class="dropdown">
                                <a style="color: #ED8131" href="">My SourcingKey<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="{{url('/dashboard')}}">User Dashboard</a></li>
                                    @if(Auth::user()->getAttributeValue('role')!='admin')
                                    <li><a href="{{url('showmyprofile')}}">Profile</a></li>
                                    @endif
                                    <li><a href="{{url('auth/logout')}}">Log Out</a></li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                        <div class="btn-group pull-right">
                            <div class="btn-group service-dropdown">
                                <button type="button" class="btn btn-default dropdown-toggle usa"
                                        data-toggle="dropdown">
                                    Our Services
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Premium membership</a></li>
                                    <li><a href="#">Advertisement Solutions</a></li>
                                    <li><a href="#">Market Watch Report</a></li>
                                    <li><a href="#">IT Solutions</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div><!--/header_top-->

</header><!--/header-->
