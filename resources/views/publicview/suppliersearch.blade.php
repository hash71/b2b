@extends('publicview.master')

@section('title', 'Supplier Search')


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


                <button class="btn orangecolor col-md-4">Suppliers({{$suppliercount}})</button>
                <form action="{{url('search/search-bar')}}" method="get">
                    <input type="hidden" name="search_type" value="Buyers">
                    <input type="hidden" name="name" value="{{$data['name']}}">
                    <button class="btn btn-blue col-md-4" type="submit">Buyers({{$buyercount}})</button>
                </form>

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
                        @foreach($suppliers as $supplier)
                            <tr>
                                <td class="cart_description">
                                  <?php $country = strtolower(array_search($supplier->country, country_list()));?>
                                  <h4 style="margin-bottom: 20px; margin-top: 0px;">
                                    <a style="color: #2265A8;" href="{{url('company-profile',[$supplier->id])}}">{{$supplier->company_name}}</a>
                                    <div style="font-size: 10px; display: inline;">
                                      <span class="{{"flag-icon flag-icon-".$country}}"></span> {{$supplier->country}}
                                    </div>
                                  </h4>
                                  <div class="product-description">
                                      <p>{{\App\Http\Controllers\SettingsController::getExcerpt($supplier->about_us,0,300)}}</p>
                                  </div>

                                </td>
                                <td class="cart_total text-right">
                                    <a href="{{url('reqs/buyer-to-supplier',[$supplier->id])}}">
                                        <button class="btn orangecolor">Contact Now</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <div style="text-align: right">
                        {!! $suppliers->appends(\Request::all())->render() !!}
                    </div>
                </div>

            </section> <!--/#cart_items-->

        </div>
    </div>

@endsection
