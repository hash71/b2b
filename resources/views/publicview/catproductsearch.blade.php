@extends('publicview.master')

@section('title', 'Product Search')


@section('pagebody')

    @include('publicview.commonsearchbar')

    <div class="row">
        @include('publicview.category')

        <div class="col-md-9 single-element listview">

            <div class="searchbuttontabs">
                <button class="btn orangecolor col-md-4">Products({{$productcount}})</button>

                <a href="{{url('search/category',['Suppliers',$data['id']])}}">
                    <button class="btn btn-blue col-md-4" type="submit">Suppliers({{$suppliercount}})</button>
                </a>

                <a href="{{url('search/category',['Buyers',$data['id']])}}">
                    <button class="btn btn-blue col-md-4" type="submit">Buyers({{$buyercount}})</button>
                </a>
            </div>


            <section id="cart_items">
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                          <tr class="cart_menu">
                              <td colspan="3" class="text-center"><h5 style="margin: 0px;">{{$pagetitle}}</h5></td>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td class="cart_product" width="20%">
                                    <a href="{{url('single-product',[$product->id])}}"><img width="150px"
                                                    src="{{first_image($product->images)}}"
                                                    alt=""></a>
                                </td>
                                <td class="cart_description" width="70%">
                                    <h4 style="margin-bottom: 10px; margin-top: 0px;"><a href="{{url('single-product',[$product->id])}}">{{$product->name}}</a>
                                    </h4>
                                    <div class="product-description">
                                        <p><label for="">Min. Order:</label> {{$product->minimum_order_quantity}}
                                        </p>
                                        <p><label for="">FOB Price:</label> {{$product->fob_price}}</p>
                                        <p><label for="">Supplying Ability:</label> {{$product->supplying_ability}}
                                        </p>
                                        <p><label for="">Payment Type:</label> {{$product->payment_type}}</p>
                                    </div>
                                </td>
                                <td class="cart_total text-center" width="10%">
                                    <p style="font-size: 12px;">
                                      {{date('F j, Y', strtotime($product->created_at))}}
                                    </p>

                                    <?php $user = \App\User::where('id', $product->user)->first(); ?>
                                    <div style="margin-bottom:10px;">
                                        <?php $country = strtolower(array_search($user->country, country_list()));?>
                                        <p>
                                          <span class="{{"flag-icon flag-icon-".$country}}"></span> {{$user->country}}
                                        </p>
                                        <a  style="font-size: 16px;" href="{{url('company-profile',[$user->id])}}"><strong>{{$user->company_name}}</strong></a>
                                    </div>

                                    <a href="{{url('reqs/buyer-to-supplier',[\App\Product::where('id',$product->id)->value('user')])}}">
                                        <button class="btn orangecolor">Contact Now</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div style="text-align: right">
                        {!! $products->appends(\Request::all())->render() !!}
                    </div>
                </div>
            </section>

        </div>
    </div>

@endsection
