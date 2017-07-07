@extends('publicview.master')

@section('title', 'Buyer Search')


@section('pagebody')

    @include('publicview.commonsearchbar')

    <div class="row">
        @include('publicview.category')

        <div class="col-md-9 single-element listview">

            <div class="searchbuttontabs">
                <form action="{{url('search/search-bar')}}" method="get">
                    <input type="hidden" name="search_type" value="Products">
                    <input type="hidden" name="name" value="{{$data['name']}}">
                    <button class="btn btn-blue col-md-4" type="submit">Products({{$productcount}})</button>
                </form>

                <form action="{{url('search/search-bar')}}" method="get">
                    <input type="hidden" name="search_type" value="Suppliers">
                    <input type="hidden" name="name" value="{{$data['name']}}">
                    <button class="btn btn-blue col-md-4" type="submit">Suppliers({{$suppliercount}})</button>
                </form>

                <button class="btn orangecolor col-md-4">Buyers({{$buyercount}})</button>
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
                                <td class="cart_product"  width="20%">
                                    <a href="{{url('single-buying-request',[$product->id])}}"><img width="150px"
                                                    src="{{first_image($product->images)}}"
                                                    alt=""></a>
                                </td>
                                <td class="cart_description"  width="70%">
                                    <h4 style="margin-bottom: 10px; margin-top: 0px;"><a href="{{url('single-buying-request',[$product->id])}}">{{$product->product_name}}</a>
                                    </h4>
                                    <div class="product-description">
                                        <p><label>Quantity Required: </label> {{$product->order_quantity}}</p>
                                        <p>{{\App\Http\Controllers\SettingsController::getExcerpt($product->specification,0,300)}}</p>
                                    </div>

                                </td>
                                <td class="cart_total text-center"  width="10%">
                                    <p style="font-size: 12px;">
                                      {{date('F j, Y', strtotime($product->created_at))}}
                                    </p>

                                    <?php $user = \App\User::where('id', $product->user)->first(); ?>
                                    <div style="margin-bottom:10px;">
                                        <?php $country = strtolower(array_search($user->country, country_list()));?>
                                        <p>
                                            <span class="{{"flag-icon flag-icon-".$country}}"></span> {{$user->country}}
                                        </p>

                                    </div>
                                    <a href="{{url('reqs/supplier-to-buyer',[$product->user,$product->id])}}">
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
