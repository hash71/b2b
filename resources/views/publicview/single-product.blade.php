@extends('publicview.master')

@section('title', 'Product')

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
                        <h2>{{$product->name}}</h2>
                        <a href="{{url('company-profile',[$product->user])}}"><strong> {{$product->company_name}}</strong></a>
                        <p></p>

                        <p><b>Model Number:</b> {{$product->model_number}}</p>
                        <p><b>Group:</b> {{$product->group}}</p>
                        <p><b>Specification:</b> {{$product->specification}}</p>
                        <p><b>Brand Name:</b> {{$product->brand_name}}</p>
                        <p><b>Supply Period:</b> {{$product->supply_period}}</p>
                        <p><b>Period Validity:</b> {{$product->period_validity}}</p>
                        <p><b>Minimum Order Quantity:</b> {{$product->minimum_order_quantity}}</p>
                        <p><b>FOB Price:</b> {{$product->fob_price}}</p>
                        <p><b>Supplying Ability:</b> {{$product->supplying_ability}}</p>
                        <p><b>Payment Type:</b> {{$product->payment_type}}</p>

                        <a class="btn btn-default btn-blue" href="{{url('reqs/buyer-to-supplier',[$product->user])}}">Contact Now</a>
                    </div><!--/product-information-->

                </div>
            </div><!--/product-details-->
            
            <div class="category-tab shop-details-tab"><!--category-tab-->
                <div class="col-sm-12">
                    <h4><strong>Product Description</strong></h4>
                            <p>{{$product->product_description}}</p>
                            
                        </div>
            </div><!--/category-tab-->
            
        </div>
    </div>

@endsection