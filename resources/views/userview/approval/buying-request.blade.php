@extends('userview.master')

@section('title', 'Buying Request Approval')

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
                    <h2> Buying Request Approval
                        <small>Approve or Delete following buyign requests</small>
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  @if($offers->total()>0)
                    <table class="table table-striped responsive-utilities jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th class="column-title">S/L</th>
                            <th class="column-title">Buying Request</th>
                            <th class="column-title">Buyer Name</th>
                            <th class="column-title text-right">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $i = 1; ?>

                        {{--<form class="deleteform" action="{{ URL::to('approve/registration-approve') }}" method="POST">--}}
                        @foreach($offers as $offer)
                            <tr class="even pointer single-product">
                                <input type="hidden" class="prod_id" value="{{$offer->id}}" name="id">

                                <td class=" ">{{$i++}}</td>
                                <td class="cat_name">{{$offer->product_name}}</td>
                                <td class="cat_name">{{\App\User::where('id',$offer->user)->value('company_name')}}</td>
                                <td class="text-right">
                                    <div class="">
                                      <button type="button" data-toggle="modal" data-target="#showModal"
                                              class="btn btn-sm btn-default showbutton" data-placement="top"
                                              title="Full View">
                                          <i class="fa fa-file"></i>
                                      </button>
                                        <a href="{{url('approve/buying-offer-accept',$offer->id)}}">
                                            <button type="button" class="btn btn-sm btn-success editbutton"
                                                    data-placement="top" title="Approve"><i class="fa fa-check"></i>
                                            </button>
                                        </a>
                                        <a href="{{url('approve/buying-offer-reject',$offer->id)}}">
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
                        {!! $offers->render() !!}
                    </div>
                    @else
                    <div class="notavailable">
                      <h1>No Buying Offers Approval is Pending</h1>
                    </div>
                    @endif

                </div>
            </div>
            !-- Category show Modal starts -->
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
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Order Quantity</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_order_quantity"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Quantity Unit</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_quantity_unit"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Expire Date</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_expire_date"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Company Name</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_company_name"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Contact Person</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_contact_person"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Country</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_country"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Email</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_email"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Telephone</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_telephone"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Mobile</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_mobile"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Other Social Contact</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_other_social_contact"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Specification</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_specification"></label>
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

              var url = "{{url('/')}}/buying-request/buying-data/" + $id;
              $.get(url, function (data) {
                  var product = data.result;

                  $('#show_product_title').text(product.product_name);
                  $('#show_category').text(product.category);
                  $('#show_sub_category').text(product.sub_category);
                  $('#show_order_quantity').text(product.order_quantity);
                  $('#show_quantity_unit').text(product.quantity_unit);
                  $('#show_expire_date').text(product.expire_date);
                  $('#show_company_name').text(product.company_name);
                  $('#show_contact_person').text(product.contact_person);
                  $('#show_country').text(product.country);
                  $('#show_email').text(product.email);
                  $('#show_telephone').text(product.telephone);
                  $('#show_mobile').text(product.mobile);
                  $('#show_other_social_contact').text(product.other_social_contact);

                  $('#show_specification').text(product.specification);

                  $('#show_product_image').attr('src', product.image);
              });
          });

            //Category Delete form submit handler
            $('.deleteform').submit(function (e) {
                var currentForm = this;
                e.preventDefault();

                bootbox.dialog({
                    message: "<h4>Do you really want to Delete this Buying Request?</h4>",
                    title: "Delete Buying Request",
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
