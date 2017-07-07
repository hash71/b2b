<div class="col-sm-3 single-element sidebarmenu">
    <div class="left-sidebar" style="margin-top: 10px;">
        <h2>Category</h2>
        <div class="sidebar">
            <ul class="dropdown-menu" style="display: block; position: static;">
                <?php $categories = \App\Category::where('parent', 0)->get()?>
                @foreach( $categories as $category)
                    <li class="dropdown-submenu"><a
                                href="{{url('search/category',['Products',$category->id])}}">{{$category->name}}</a>
                        <?php $subcategories = \App\Category::where('parent', $category->id)->get()?>

                        @if(sizeof($subcategories))
                            <ul class="dropdown-menu">
                                {{--<h3>{{$category->name}} <a href="{{url('search/category',[$category->id])}}" class="pull-right">View All</a></h3>--}}
                                @foreach($subcategories as $subcategory)
                                    <li>
                                        <a href="{{url('search/category',['Products',$subcategory->id])}}">{{$subcategory->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
