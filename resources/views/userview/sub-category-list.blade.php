@extends('userview.master')

@section('title', 'Sub-Category List')

@section('custommetahead')
<style>
    .simple-label{
        font-weight: 400;
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
                <h2> Product Sub-Categories <small>Update or Delete Sub-Categories from here</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
              @if($categories->total()>0)
                <table class="table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                        <tr class="headings">
                            <th class="column-title">S/L </th>
                            <th class="column-title">Sub-Category Name </th>
                            <th class="column-title">Category Name </th>
                            <th class="column-title text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($categories as $category)
                        <form class="deleteform" action="{{ URL::to('category/delete-sub') }}" method="POST">
                            <tr class="even pointer single-cat">
                                <input type="hidden" class="cat_id" value="{{$category->id}}" name="cat_id">
                                <input type="hidden" class="parent_id" value="{{$category->parent}}" name="parent_id">
                                <td class=" ">{{$i++}}</td>
                                <td class="cat_name">{{$category->name}} </td>
                                <td class="cat_parent_name">{{$category->parent_name}} </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <button type="button" data-toggle="modal" data-target="#editModal" class="btn btn-sm btn-success editbutton" data-placement="top" title="Edit">  <i class="fa fa-pencil"></i>
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
                  <h1>No Sub-Category Available</h1>
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
                <form action="{{ URL::to('category/update-sub') }}" class="form-horizontal" role="form" data-toggle="validator" id="editForm" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="content">
                            <input type="hidden" value="" id="edit_category_id" name="id">

                            <div class="form-group">
                                <label for="edit_category_name" class="col-md-4 col-sm-4 col-xs-12 control-label">Sub-Category Name</label>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control" id="edit_category_name" placeholder="Category Name *" name="cat_name" required >
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="edit_category_name" class="col-md-4 col-sm-4 col-xs-12 control-label">Category Name</label>
                                <div class="col-sm-7">
                                    <select class="form-control" name="parent_cat" id="parent_cat">
                                        @foreach($main_categories as $cat)
                                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                                        @endforeach
                                    </select>
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

    </div>
</div>


@endsection

@section('customfooterscript')
<script src="{{ URL::asset('js/bootbox.min.js') }}"></script>

<script>
    jQuery(document).ready(function($) {


        $(document).on('click','.editbutton',function(){
            $elem = $(this).closest('.single-cat');

            $id = $elem.find('.cat_id').val();

            $name = $elem.find('.cat_name').text();

            $parent = $elem.find('.parent_id').val();

            $('#edit_category_name').val($name);
            $('#edit_category_id').val($id);
            $('#parent_cat').val($parent);

        });

        //Category Delete form submit handler
        $('.deleteform').submit(function(e) {
            var currentForm = this;
            e.preventDefault();

            bootbox.dialog({
              message: "<h4>Do you really want to Delete this Sub-Category?</h4>",
              title: "Delete Sub-Category",
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

@endsection
