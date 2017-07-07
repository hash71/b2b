<!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li style="margin-right: 20px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="{{URL::asset('images/user.png')}}" alt="">{{Auth::user()->getAttributeValue('company_name')}}
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="{{url('/')}}">  Go to Front Page</a>
                                    </li>
                                    @if(Auth::user()->getAttributeValue('role')!='admin')
                                    <li><a href="{{url('showmyprofile')}}">  Profile</a></li>
                                    @endif
                                    <li><a href="{{url('profile/reset-password')}}">Reset Password</a></li>
                                    <li><a href="{{url('auth/logout')}}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->
