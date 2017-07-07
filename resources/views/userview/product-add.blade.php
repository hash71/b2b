@extends('userview.master')

@section('title', 'Add Product')


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
                <h2>Add New Product</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br />
                <form enctype="multipart/form-data" action="{{url('products/add')}}" method="POST" class="form-horizontal form-label-left">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Title <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group" id="main-category-list">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Category<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="maincategory" id="maincategory" class="form-control col-md-5 col-xs-12">
                                <option value="0" selected="true" disabled="true">--- Select a Category ---</option>
                                @foreach($category_obj_array as $category)
                                <option value="{{$category->parent}}">{{\App\Category::where('id',$category->parent)->value('name')}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <select name="category" id="sub_category" class="form-control col-md-5 col-xs-12">
                                <option value="0" selected="true" disabled="true">--- Select a Sub Category ---</option>
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Model No.
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="model_number" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Group
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="group" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Specification
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="specification" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Brand Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="brand_name" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Supply Period
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="supply_period" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Period of Validity
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="period_validity" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12"\>Minimum Order
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="minimum_order_quantity" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">FOB Price
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="fob_price" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Supplying Ability
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="supplying_ability" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Payment Type
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="payment_type" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Description
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea type="text" name="product_description" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Product Image</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="file" name="images[]" id="file" class="form-control float-left" onchange="readURL(this);" multiple>

                            <img src="{{ URL::asset('images/product-image.png') }}" style="margin-left: 30%; padding: 10px; width: 50%;" id="blah" alt="Image">
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-4 col-sm-4 col-xs-12 col-md-offset-5">
                            <button type="submit" class="btn btn-primary">Cancel</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('customfooterscript')

<script>
    jQuery(document).ready(function($) {
        var cat_sub_cat = {!!json_encode($category_obj_array)!!};

        $(document).on('change','#maincategory',function(){
            $elem = $(this).val();
            $('#sub_category').find('option:gt(0)').remove(); 

            for(var i = 0;i<cat_sub_cat.length;i++)
            {
                if(cat_sub_cat[i].parent==$elem)
                {
                    for(var key in cat_sub_cat[i].child)
                    {
                        var data = cat_sub_cat[i].child[key];
                        $('#sub_category').append('<option value="'+key+'">'+data+'</option>');
                    }
                }
            }
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