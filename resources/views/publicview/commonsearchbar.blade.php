              <div class="row commonsearchbar">
                <div class="col-sm-10" style="padding-left: 0px; padding-right: 0px;">
                    <form action="{{url('search/search-bar')}}" method="get">
                        <div class="input-group searchbox">
                                <div class="input-group-btn search-panel">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span id="search_concept">Products</span> <span class="caret"></span>
                                    </button>
                                    <ul id="" class="dropdown-menu" role="menu">
                                      <li><a href="">Products</a></li>
                                      <li><a href="">Suppliers</a></li>
                                      <li><a href="">Buyers</a></li>
                                    </ul>
                                </div>
                                <input type="hidden" name="search_type" value="Products" id="search_param">
                                <input type="text" class="form-control" name="name" placeholder="What are you looking for...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default searchbutton" type="submit"><i class="fa fa-search"></i> Search</button>
                                </span>

                        </div>
                    </form>
                </div>

                <div class="col-sm-2">
                  <a href="{{url('buying-request')}}" class="btn btn-default btn-blue get wid100"
                     style="margin: 0px; margin-bottom: 10px">Post Buying Request</a>
                </div>

            </div>
