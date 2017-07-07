@extends('userview.master')

@section('title', 'Buying Request List')

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

        #editModal .modal-header {
            background-color: #7761a7;
            color: #fff;
            border-bottom: 3px solid #634d93 !important;
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
                    <h2> Buying Offers List
                        <small>View, Update or Delete buying offers from here</small>
                    </h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                  @if($products->total()>0)
                    <table class="table table-striped responsive-utilities jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th class="column-title">S/L</th>
                            <th class="column-title">Image</th>
                            <th class="column-title">Product Name</th>
                            <th class="column-title">User Name</th>
                            <th class="column-title">Product Category</th>
                            <th class="column-title text-right">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($products as $product)
                            <form class="deleteform" action="{{ URL::to('buying-request/delete') }}" method="POST">
                                <tr class="even pointer single-product">
                                    <input type="hidden" class="prod_id" value="{{$product->id}}" name="id">

                                    <td class=" ">{{$i++}}</td>
                                    <td class="image"><img alt="image" src="{{ first_image($product->images) }}"
                                                           height="50px" width="50px"></td>
                                    <td class="cat_name">{{$product->product_name}} </td>
                                    <td class="user_name">{{\App\User::where('id',$product->user)->value('company_name')}} </td>
                                    <td class="cat_name">{{$product->category}} </td>
                                     <td class="text-right">
                                        <div class="btn-group">

                                            <button type="button" data-toggle="modal" data-target="#showModal"
                                                    class="btn btn-sm btn-success showbutton" data-placement="top"
                                                    title="Full View">
                                                <i class="fa fa-file"></i>
                                            </button>
                                            @if(\Auth::user()->getAttributeValue('role') != 'admin')
                                            <button type="button" data-toggle="modal" data-target="#editModal"
                                                    class="btn btn-sm btn-blue editbutton" data-placement="top"
                                                    title="Edit"><i class="fa fa-pencil"></i>
                                            </button>
                                            @endif

                                            <button type="submit" data-placement="top" title="Delete"
                                                    class="btn btn-sm btn-danger">
                                                <i class='fa fa-times'></i>
                                            </button>
                                        </div>
                                    </td>


                                </tr>
                            </form>
                        @endforeach
                        </tbody>

                    </table>

                    <div style="text-align: right">
                        <?php echo $products->render(); ?>
                    </div>
                    @else

                    <div class="notavailable">
                      <h1>No Buying Offers Available</h1>
                    </div>

                    @endif

                </div>

            </div>

            <!-- Category Edit Modal starts -->
            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Edit Buying Offer</h4>
                        </div>
                        <form action="{{ URL::to('buying-request/update') }}" class="form-horizontal" role="form"
                              data-toggle="validator" id="editForm" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="content">
                                    <input type="hidden" value="" id="edit_product_id" name="id">

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Product Title</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" id="edit_product_title"
                                                   placeholder="Product Title *" name="name" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Product
                                            Category</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select name="maincategory" id="maincategory"
                                                    class="form-control col-md-5 col-xs-12">
                                                <option value="0" selected="true" disabled="true">--- Select a Category
                                                    ---
                                                </option>
                                                @foreach($category_obj_array as $category)
                                                    <option value="{{$category->parent}}">{{\App\Category::where('id',$category->parent)->value('name')}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Product
                                            Sub-Category</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select name="category" id="sub_category"
                                                    class="form-control col-md-5 col-xs-12">
                                                <option value="0" selected="true" disabled="true">--- Select a Sub
                                                    Category ---
                                                </option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Specification</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" id="edit_specification"
                                                   placeholder="Specification" name="specification">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Product
                                            Image</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="file" name="image[]" id="file" class="form-control float-left"
                                                   onchange="readURL(this);" multiple>

                                            <img src="{{ URL::asset('images/product-image.png') }}"
                                                 style="margin-left: 30%; padding: 10px; width: 50%;" id="blah"
                                                 alt="Image">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Update Product</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>

                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

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

            var cat_sub_cat = {!!json_encode($category_obj_array)!!};

            $(document).on('change', '#maincategory', function () {
                $elem = $(this).val();
                $('#sub_category').find('option:gt(0)').remove();

                for (var i = 0; i < cat_sub_cat.length; i++) {
                    if (cat_sub_cat[i].parent == $elem) {
                        for (var key in cat_sub_cat[i].child) {
                            var data = cat_sub_cat[i].child[key];
                            $('#sub_category').append('<option value="' + key + '">' + data + '</option>');
                        }
                    }
                }
            });

            $(document).on('change', '.js-switch', function () {

                //alert(this.checked);
                $status = this.checked;
                $p_id = $(this).closest('.single-product').find('.prod_id').val();

                $.post("{{url('products/makefeatured')}}", {product_id: $p_id, status: $status})
                        .done(function (data) {
                            // alert( "Data Loaded: " + data );
                        });
            });

            $(document).on('click', '.editbutton', function () {
                $elem = $(this).closest('.single-product');

                $id = $elem.find('.prod_id').val();

                var url = "buying-data/" + $id;
                $.get(url, function (data) {
                    var product = data.result;

                    console.log(product);

                    $('#edit_product_id').val(product.id);
                    $('#edit_product_title').val(product.product_name);
                    $('#edit_category').val(product.category);
                    $('#edit_sub_category').val(product.sub_category);
                    $('#edit_specification').val(product.specification);

                    $('#blah').attr('src', product.image);
                    $('#file').val('');

                    //select category and sub-category
                    $('#maincategory').val(product.categoryid);
                    $('#maincategory').change();
                    $('#sub_category').val(product.sub_category_id);
                });
            });


            $(document).on('click', '.showbutton', function () {
                $elem = $(this).closest('.single-product');

                $id = $elem.find('.prod_id').val();

                var url = "buying-data/" + $id;
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
                    message: "<h4>Do you really want to Delete this Buying Offer?</h4>",
                    title: "Delete Buying Offer",
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

    <!-- image preview script-->
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                            .attr('src', e.target.result)
                            .width(150)
                            .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection
