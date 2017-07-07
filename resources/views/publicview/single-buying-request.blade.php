@extends('publicview.master')

@section('title', 'Buying Request')

@section('pagebody')

    @include('publicview.commonsearchbar')

    <div class="row">
        @include('publicview.category')

        <div class="col-md-9 single-element single-product-view">
            <div class="product-details"><!--product-details-->
                <div class="col-sm-5">
                    <div class="view-product">
                        <img src="{{first_image($product->images)}}" alt="" />
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="product-information"><!--/product-information-->
                        <div style="margin-bottom: 20px;">
                          <h2>{{$product->product_name}}</h2>
                          <?php $country = strtolower(array_search($product->country, country_list()));?>
                          <p><span style="margin-top: 0px;" class="{{"flag-icon flag-icon-".$country}}"></span> {{$product->country}}</p>
                        </div>




                        <p><b>Order Quantity:</b> {{$product->order_quantity}}</p>
                        <p><b>Quantity Unit:</b> {{$product->quantity_unit}}</p>
                        <p><b>Expiry Date:</b> {{$product->expire_date}}</p>
                        <p><b>Country:</b> {{$product->country}}</p>

                        <a style="margin-top: 20px;" class="btn btn-default btn-blue" href="{{url('reqs/supplier-to-buyer',[$product->user,$product->id])}}">Contact Now</a>
                    </div><!--/product-information-->

                </div>
            </div><!--/product-details-->

            <div class="category-tab shop-details-tab"><!--category-tab-->
                <div class="col-sm-12">
                    <h4><strong>Product Specification</strong></h4>
                            <p>{{$product->specification}}</p>

                        </div>
            </div><!--/category-tab-->

        </div>
    </div>

@endsection
