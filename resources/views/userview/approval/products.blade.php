@extends('userview.master')

@section('title', 'Products Approval')

@section('custommetahead')
    <style>
        .simple-label {
            font-weight: 400;
        }

        #showModal .modal-header {
            background-color: #4aa3df;
            color: #fff;
            border-bottom: 3px solid #2F6F9A !important;
        }

        .bootbox .modal-header {
            background-color: #f16e3f;
            color: #fff;
            border-bottom: 3px solid #dd5a2b !important;
        }
    </style>
@endsection

@section('pagebody')

    @if(session('success'))
        <div class="alert alert-success" style="margin-top: 60px;">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="fa fa-check sign"></i><strong>Success!</strong> {{session('success')}}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2> Products Approval
                        <small>Approve or Delete following products</small>
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  @if($products->total()>0)
                    <table class="table table-striped responsive-utilities jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th class="column-title">S/L</th>
                            <th class="column-title">Product Name</th>
                            <th class="column-title">Product Category</th>
                            <th class="column-title">Supplier Name</th>
                            <th class="column-title text-right">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $i = 1; ?>

                        {{--<form class="deleteform" action="{{ URL::to('approve/registration-approve') }}" method="POST">--}}

                        @foreach($products as $product)
                            <tr class="even pointer single-product">
                                <input type="hidden" class="prod_id" value="{{$product->id}}" name="id">

                                <td class=" ">{{$i++}}</td>
                                <td class="">{{$product->name}}</td>
                                <td class="cat_name">{{\App\Category::where('id',$product->category)->value('name')}}</td>
                                <td>
                                  {{\App\User::where('id',$product->user)->value('company_name')}}
                                  @if(\App\User::where('id',$product->user)->value('premium_gold_supplier') == 1)
                                  <img width="40px" src="{{URL::asset('images/gold.jpg')}}" class="" alt="" />
                                  @elseif(\App\User::where('id',$product->user)->value('gold_supplier') == 1)
                                  <img width="40px" src="{{URL::asset('images/premiumgold.jpg')}}" class="" alt="" />
                                  @endif
                                </td>
                                <td class="text-right">
                                    <div class="">
                                      <button type="button" data-toggle="modal" data-target="#showModal"
                                              class="btn btn-sm btn-default showbutton" data-placement="top"
                                              title="Full View">
                                          <i class="fa fa-file"></i>
                                      </button>

                                        <a href="{{url('approve/products-accept',$product->id)}}">
                                            <button type="button" class="btn btn-sm btn-success editbutton"
                                                    data-placement="top" title="Approve"><i class="fa fa-check"></i>
                                            </button>
                                        </a>
                                        <a href="{{url('approve/products-reject',$product->id)}}">
                                            <button type="submit" data-placement="top" title="Delete"
                                                    class="btn btn-sm btn-danger">
                                                <i class='fa fa-times'></i>
                                            </button>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        {{--</form>    --}}


                        </tbody>

                    </table>


                    <div style="text-align: right">
                        <?php //echo $categories->render(); ?>
                        {!! $products->render() !!}
                    </div>

                    @else
                    <div class="notavailable">
                      <h1>No Products Approval is Pending</h1>
                    </div>
                    @endif

                </div>
            </div>

            <!-- Category show Modal starts -->
            <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Product Information</h4>
                        </div>
                        <form class="form-horizontal" role="form" data-toggle="validator" id="showForm" method="post">
                            <div class="modal-body">
                                <div class="content">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Image</label>
                                        <div class="col-sm-8">
                                            <img src="{{ URL::asset('images/placeholder.png') }}"
                                                 style="margin-left: 20%; padding: 10px; width: 150px; height: 200px;"
                                                 id="show_product_image" alt="Image">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Product Title</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_product_title"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Product
                                            Category</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_category"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Product
                                            Sub-Category</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_sub_category"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Model No.</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_model"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Group</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_group"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Specification</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_specification"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Brand Name</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_brand_name"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Supply Period</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_supply_period"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Period of
                                            Validity</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_period_validity"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Minimum Order</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_minimum_order"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">FOB Price</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_fob_price"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Supplying
                                            Ability</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_supply_ability"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Payment Type</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_payment_type"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Product
                                            Description</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_product_description"></label>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
                            </div>
                        </form>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->


        </div>
    </div>


    @endsection

    @section('customfooterscript')
    <script src="{{ URL::asset('js/bootbox.min.js') }}"></script>

    <script>
        jQuery(document).ready(function ($) {

          $(document).on('click', '.showbutton', function () {
              $elem = $(this).closest('.single-product');

              $id = $elem.find('.prod_id').val();

              var url = "{{url('/')}}/products/product-data/" + $id;
              $.get(url, function (data) {
                  var product = data.result;

                  $('#show_product_title').text(product.name);
                  $('#show_category').text(product.category);
                  $('#show_sub_category').text(product.sub_category);
                  $('#show_model').text(product.model_number);
                  $('#show_group').text(product.group);
                  $('#show_specification').text(product.specification);
                  $('#show_brand_name').text(product.brand_name);
                  $('#show_supply_period').text(product.supply_period);
                  $('#show_period_validity').text(product.period_validity);
                  $('#show_minimum_order').text(product.minimum_order_quantity);
                  $('#show_fob_price').text(product.fob_price);
                  $('#show_supply_ability').text(product.supplying_ability);
                  $('#show_payment_type').text(product.payment_type);
                  $('#show_product_description').text(product.product_description);

                  $('#show_product_image').attr('src', product.image);
              });
          });

            //Category Delete form submit handler
            $('.deleteform').submit(function (e) {
                var currentForm = this;
                e.preventDefault();

                bootbox.dialog({
                    message: "<h4>Do you really want to Delete this Product?</h4>",
                    title: "Delete Product",
                    buttons: {
                        cancel: {
                            label: "cancel",
                            className: "btn-default"
                        },
                        confirm: {
                            label: "Delete",
                            className: "btn-danger",
                            callback: function () {
                                currentForm.submit();
                            }
                        }
                    }
                });

                return false;
            });
        });
    </script>

    @endsection
