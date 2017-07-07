@extends('userview.master')

@section('title', 'Category List')

@section('custommetahead')
<style>
    .simple-label{
        font-weight: 400;
    }
    #reorderModal .modal-header{
        background-color: #4aa3df;
        color: #fff;
        border-bottom: 3px solid #2F6F9A !important;
    }
    #editModal .modal-header{
        background-color: #7761a7;
        color: #fff;
        border-bottom: 3px solid #634d93 !important;
    }
    .bootbox .modal-header{
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
                <h2> Product Categories <small>Update, Delete or Re-order Categories from here</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
              @if($categories->total()>0)
                <table class="table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                        <tr class="headings">
                            <th class="column-title">S/L </th>
                            <th class="column-title">Category Image </th>
                            <th class="column-title">Category Name </th>
                            <th class="column-title">Featured</th>
                            <th class="column-title text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($categories as $category)
                        <form class="deleteform" action="{{ URL::to('category/delete') }}" method="POST">
                            <tr class="even pointer single-cat">
                                <input type="hidden" class="cat_id" value="{{$category->id}}" name="cat_id">
                                <input type="hidden" class="cat_order" value="{{$category->order}}" name="cat_order">
                                <td class=" ">{{$i++}}</td>
                                <td class="image"><img alt="Avatar" src="{{ URL::asset($category->image) }}" height="50px" width="50px"></td>
                                <td class="cat_name">{{$category->name}} </td>
                                <td><input type="checkbox" @if($category->featured == 1){{"checked='checked'"}}@endif class="js-switch"></td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <button type="button" data-toggle="modal" data-target="#editModal" class="btn btn-sm btn-success editbutton" data-placement="top" title="Edit">  <i class="fa fa-pencil"></i>
                                        </button>

                                       <button type="button" data-toggle="modal" data-target="#reorderModal" class="btn btn-sm btn-blue orderbutton" data-placement="top" title="Re-order">
                                            <i class="fa fa-reorder"></i>
                                        </button>

                                        <button type="submit" data-placement="top" title="Delete" class="btn btn-sm btn-danger">
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
                    <?php echo $categories->render(); ?>
                </div>
                @else
                <div class="notavailable">
                  <h1>No Category Available</h1>
                </div>
                @endif

            </div>
        </div>

        <!-- Category Edit Modal starts -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Category</h4>
                </div>
                <form action="{{ URL::to('category/update') }}" class="form-horizontal" role="form" data-toggle="validator" id="editForm" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="content">
                            <input type="hidden" value="" id="edit_category_id" name="id">

                            <div class="form-group">
                                <label for="edit_category_name" class="col-md-3 col-sm-3 col-xs-12 control-label">Category Name</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="edit_category_name" placeholder="Category Name *" name="cat_name" required >
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Category Image</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" name="cat_image" id="file" class="form-control float-left" onchange="readURL(this);">

                                    <img src="{{ URL::asset('images/common-placeholder.jpg') }}" style="margin-left: 30%; padding: 10px; width: 50%" id="edit_image" alt="Image">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save Category</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>

            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- Category Reorder Modal starts -->
        <div class="modal fade" id="reorderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Re-order Category</h4>
                </div>
                <form action="{{ URL::to('category/reorder') }}" class="form-horizontal" role="form" data-toggle="validator" id="reorderForm" method="post">
                    <div class="modal-body">
                        <div class="content">
                            <input type="hidden" value="" id="reorder_category_id" name="id">

                            <div class="form-group">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Category Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <label style="padding-top: 8px;" id="reorder_category_name">Name</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="edit_category_name" class="col-md-3 col-sm-3 col-xs-12 control-label">Category Name</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="order" id="category_order" class="form-control col-md-5 col-xs-12">
                                    @foreach($categories as $category)
                                        <option value="{{$category->order}}">{{$category->order}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Updat Category Order</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
    jQuery(document).ready(function($) {

        $(document).on('change','.js-switch',function(){

            //alert(this.checked);
            $status = this.checked;
            $c_id = $(this).closest('.single-cat').find('.cat_id').val();

            $.post( "{{url('category/makefeatured')}}", { cat_id: $c_id, status: $status })
              .done(function( data ) {
                // alert( "Data Loaded: " + data );
            });
        });


        $(document).on('click','.editbutton',function(){
            $elem = $(this).closest('.single-cat');

            $id = $elem.find('.cat_id').val();

            $name = $elem.find('.cat_name').text();

            $image = $elem.find('.image img').attr('src');

            $('#edit_category_name').val($name);
            $('#edit_category_id').val($id);
            $('#edit_image').attr('src',$image);
            $('#file').val('');
        });


        $(document).on('click','.orderbutton',function(){
            $elem = $(this).closest('.single-cat');

            $id = $elem.find('.cat_id').val();

            $name = $elem.find('.cat_name').text();

            $order = $elem.find('.cat_order').val();

            $('#reorder_category_name').text($name);
            $('#reorder_category_id').val($id);
            $('#category_order').val($order);
        });


        //Category Delete form submit handler
        $('.deleteform').submit(function(e) {
            var currentForm = this;
            e.preventDefault();

            bootbox.dialog({
              message: "<h4>Do you really want to Delete this Category?</h4><h5>Deleting this category will also remove the sub-categories of this category.</h5>",
              title: "Delete Category",
              buttons: {
                cancel: {
                  label: "cancel",
                  className: "btn-default"
                },
                confirm: {
                  label: "Delete",
                  className: "btn-danger",
                  callback: function() {
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
                $('#edit_image')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection
