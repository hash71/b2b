@extends('userview.master')

@section('title', 'Product List')

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
                    <h2> Product List
                        <small>View, Update or Delete products from here</small>
                    </h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    @if($products->total()>0)
                        <table class="table table-striped responsive-utilities jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">S/L</th>
                                <th class="column-title">Product Image</th>
                                <th class="column-title">Product Name</th>
                                <th class="column-title">User Name</th>
                                <th class="column-title">Product Category</th>
                                @if(Auth::user()->getAttributeValue('role')=='admin')
                                    <th class="column-title">Featured</th>
                                @endif
                                <th class="column-title text-right">Action</th>

                            </tr>
                            </thead>

                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($products as $product)
                                <form class="deleteform" action="{{ URL::to('products/delete') }}" method="POST">
                                    <tr class="even pointer single-product">
                                        <input type="hidden" class="prod_id" value="{{$product->id}}" name="prod_id">

                                        <td class=" ">{{$i++}}</td>
                                        <td class="image"><img alt="Avatar" src="{{ first_image($product->images) }}"
                                                               height="50px" width="50px"></td>
                                        <td class="cat_name">{{$product->name}} </td>
                                        <td class="user_name">{{\App\User::where('id',$product->user)->value('company_name')}} </td>
                                        <td class="cat_name">{{$product->category}} </td>
                                        @if(Auth::user()->getAttributeValue('role')=='admin' )
                                            <td><input type="checkbox"
                                                       @if($product->featured == 1){{"checked='checked'"}}@endif class="js-switch">
                                            </td>
                                        @endif
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
                            <h1>No Products Available</h1>
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
                            <h4 class="modal-title">Edit Product</h4>
                        </div>
                        <form action="{{ URL::to('products/update') }}" class="form-horizontal" role="form"
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
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Model No.</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" id="edit_model"
                                                   placeholder="Model Number" name="model_number">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Group</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" id="edit_group" placeholder="Group"
                                                   name="group">
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
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Brand Name</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" id="edit_brand_name"
                                                   placeholder="Brand Name" name="brand_name">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Supply Period</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" id="edit_supply_period"
                                                   placeholder="Supply Period" name="supply_period">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Period of
                                            Validity</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" id="edit_period_validity"
                                                   placeholder="Period Validity" name="period_validity">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Minimum Order</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" id="edit_minimum_order"
                                                   placeholder="Minimum Order" name="minimum_order_quantity">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">FOB Price</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" id="edit_fob_price"
                                                   placeholder="FOB Price" name="fob_price">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Supplying
                                            Ability</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" id="edit_supply_ability"
                                                   placeholder="Supply Ability" name="supplying_ability">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Payment Type</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" class="form-control" id="edit_payment_type"
                                                   placeholder="Payment Type" name="payment_type">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Product
                                            Description</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <textarea class="form-control" name="" id="edit_product_description"
                                                      placeholder="Product Description" name="product_description"
                                                      cols="10" rows="5"></textarea>
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

                var url = "product-data/" + $id;
                $.get(url, function (data) {
                    var product = data.result;

                    $('#edit_product_id').val(product.id);
                    $('#edit_product_title').val(product.name);
                    $('#edit_category').val(product.category);
                    $('#edit_sub_category').val(product.sub_category);
                    $('#edit_model').val(product.model_number);
                    $('#edit_group').val(product.group);
                    $('#edit_specification').val(product.specification);
                    $('#edit_brand_name').val(product.brand_name);
                    $('#edit_supply_period').val(product.supply_period);
                    $('#edit_period_validity').val(product.period_validity);
                    $('#edit_minimum_order').val(product.minimum_order_quantity);
                    $('#edit_fob_price').val(product.fob_price);
                    $('#edit_supply_ability').val(product.supplying_ability);
                    $('#edit_payment_type').val(product.payment_type);
                    $('#edit_product_description').text(product.product_description);

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

                var url = "product-data/" + $id;
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
