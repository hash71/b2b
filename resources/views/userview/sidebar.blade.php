<div class="col-md-3 left_col">
    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="{{url('/dashboard')}}" class="site_title">Dashboard</span></a>
        </div>
        <div class="clearfix"></div>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

            <div class="menu_section">
                <ul class="nav side-menu">

                    @if(Auth::user()->getAttributeValue('role')!='admin')
                        <li><a><i class="fa fa-user"></i> User Profile <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                                <li><a href="{{url('profile/basicinfo-change')}}">Change Basic Info</a>
                                </li>
                                @if(Auth::user()->getAttributeValue('role') != 'buyer')
                                <li><a href="{{url('profile/contactinfo-change')}}">Change Contact Info</a>
                                </li>
                                @endif
                            </ul>
                        </li>
                        <?php $messagecount = \App\Message::where('to',Auth::user()->getAttributeValue('id'))->where('approved',1)->where('new',1)->count(); ?>
                        <li><a><i class="fa fa-envelope"></i> Messages @if($messagecount>0) <span class="badge notification bg-red">{{$messagecount}}</span> @endif <span class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" style="display: none">
                              <li><a href="{{url('message/view')}}">Inbox @if($messagecount>0) <span class="badge notification bg-red">{{$messagecount}}</span> @endif </a>
                              </li>
                              <li><a href="{{url('message/sent')}}">Sent </a>
                              </li>
                          </ul>

                        </li>
                    @endif

                    @if(Auth::user()->getAttributeValue('role')=='supplier' || Auth::user()->getAttributeValue('role')=='both')
                    <li><a href="{{url('profile/brochure')}}"><i class="fa fa-book"></i> Company Brochure</a>
                    </li>
                    @endif

                    @if(Auth::user()->getAttributeValue('role')!='buyer' )
                    <li><a><i class="fa fa-shopping-bag"></i> Products <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            @if(Auth::user()->getAttributeValue('role')!='admin')
                                <li><a href="{{url('products/add')}}">Add New Product</a>
                                </li>
                            @endif
                            <li><a href="{{url('products/list')}}">Product List</a>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if(Auth::user()->getAttributeValue('role')!='supplier' )
                    <li><a><i class="fa fa-shopping-cart"></i> Buying Requests <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none">
                            @if(Auth::user()->getAttributeValue('role')!='admin' )
                                <li><a href="{{url('buying-request/new')}}">Add Buying Request</a>
                                </li>
                            @endif
                            @if(Auth::user()->getAttributeValue('role')!='supplier' )
                                <li><a href="{{url('buying-request/list')}}">Buying Offers List</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    @endif

                    @if(Auth::user()->getAttributeValue('role')=='admin')
                        <?php
                          $reg_approve = \App\User::where('approved',0)->count();
                          $inq_approve = \App\ReqToSupplier::where('approved',0)->count();
                          $prod_approve = \App\Product::where('approved',0)->count();
                          $buy_approve = \App\Buyproduct::where('approved',0)->count();
                          $message_approve = \App\Message::where('approved',0)->count();

                          if($reg_approve>0 || $inq_approve>0 || $prod_approve>0 || $buy_approve>0 || $message_approve>0)
                            $need_approval = true;
                          else
                            $need_approval = false;
                        ?>

                        <li><a class="@if($need_approval){{'btn-danger'}}@endif"><i class="fa fa-user"></i> Pending Approvals <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">

                                <li>
                                  <a href="{{url('approve/registration-approve')}}">
                                    Registration Approval
                                  @if($reg_approve>0)<span class="badge notification bg-red">{{$reg_approve}}</span> @endif
                                  </a>
                                </li>

                                <li>
                                  <a href="{{url('approve/inquiry-approve')}}">
                                  Inquiry Approval
                                  @if($inq_approve>0) <span class="badge notification bg-red">{{$inq_approve}}</span> @endif
                                  </a>
                                </li>

                                <li>
                                  <a href="{{url('approve/products-approve')}}">
                                    Products Approval
                                    @if($prod_approve>0) <span class="badge notification bg-red">{{$prod_approve}}</span>@endif
                                  </a>
                                </li>

                                <li>
                                  <a href="{{url('approve/buying-offer-approve')}}">
                                    Buying Offer Approval
                                    @if($buy_approve>0)<span class="badge notification bg-red">{{$buy_approve}}</span>@endif
                                  </a>
                                </li>

                                <li>
                                  <a href="{{url('approve/message-approve')}}">
                                    Message Approval
                                    @if($message_approve>0)<span class="badge notification bg-red">{{$message_approve}}</span>@endif
                                  </a>
                                </li>
                            </ul>
                        </li>


                        <li><a><i class="fa fa-users"></i> Members<span
                                        class="fa fa-chevron-down"></span></a>
                          <ul class="nav child_menu" style="display: none">
                              <li><a href="{{url('member/member-list')}}">Member List</a>
                              </li>
                              <li><a href="{{url('member/expiration-info')}}">Member Expiration Info</a>
                              </li>
                              <li><a href="{{url('member/free-members-list')}}">Free Members</a>
                              </li>
                              <li><a href="{{url('member/gold-members-list')}}">Gold Members</a>
                              </li>
                              <li><a href="{{url('member/gold-premium-members-list')}}">Gold Premium Members</a>
                              </li>
                              <li><a href="{{url('member/buyers-list')}}">Buyers List</a>
                              </li>

                          </ul>
                        </li>
                        <li><a href="{{url('feedback/list')}}"><i class="fa fa-envelope"></i> Sourcing Requests</a>
                        </li>


                        <li><a><i class="fa fa-shopping-basket"></i> Product Category <span
                                        class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                                <li><a href="{{url('category/create')}}">Create Category</a>
                                </li>
                                <li><a href="{{url('category/list')}}">Category</a>
                                </li>
                                <li><a href="{{url('category/sub-category')}}">Sub-Category</a>
                                </li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-newspaper-o"></i> Posts <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                                <li><a href="{{url('post/create')}}">Add Post</a>
                                </li>
                                <li><a href="{{url('post/list',"news")}}">News List</a>
                                </li>
                                <li><a href="{{url('post/list',"industry article")}}">Industry Article List</a>
                                </li>
                                <li><a href="{{url('post/list',"success story")}}">Success Story List</a>
                                </li>
                                <li><a href="{{url('post/list',"trade fair")}}">Trade Fair List</a>
                                </li>
                                <li><a href="{{url('post/list',"market intelligence")}}">Market Intelligence List</a>
                                </li>
                            </ul>
                        </li>

                        <li><a><i class="fa fa-cog"></i> Settings <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu" style="display: none">
                                <li><a href="{{url('settings/heroimage')}}">Change Brand Image</a>
                                </li>
                                <li><a href="{{url('settings/videos')}}">Change Latest Videos</a>
                                </li>
                                <li><a href="{{url('settings/social')}}">Change Social Links</a>
                                </li>
                                <li><a href="{{url('settings/advertisement')}}">Change Ad Widgets</a>
                                </li>
                            </ul>
                        </li>
                    @endif

                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>
