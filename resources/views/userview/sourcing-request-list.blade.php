@extends('userview.master')

@section('title', 'Sourcing Request List')

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
                    <h2> Sourcing Request List
                        <small>View or Delete Sourcing Requests from here</small>
                    </h2>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                  @if($feedbacks->total()>0)
                    <table class="table table-striped responsive-utilities jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th class="column-title">S/L</th>
                            <th class="column-title">Inquiry</th>
                            <th class="column-title">Country</th>
                            <th class="column-title">Company Name</th>
                            <th class="column-title text-right">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($feedbacks as $feedback)
                            <form class="deleteform" action="{{ URL::to('feedback/delete') }}" method="POST">
                                <tr class="even pointer single-product">
                                    <input type="hidden" class="feedback_id" value="{{$feedback->id}}" name="id">

                                    <td class=" ">{{$i++}}</td>
                                    <td class="cat_name">{{$feedback->inquiry}} </td>
                                    <td class="cat_name">{{$feedback->country}} </td>
                                    <td class="cat_name">{{$feedback->company_name}} </td>
                                     <td class="text-right">
                                        <div class="btn-group">

                                            <button type="button" data-toggle="modal" data-target="#showModal"
                                                    class="btn btn-sm btn-success showbutton" data-placement="top"
                                                    title="Full View">
                                                <i class="fa fa-file"></i>
                                            </button>

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
                        <?php echo $feedbacks->render(); ?>
                    </div>
                    @else

                    <div class="notavailable">
                      <h1>No Sourcing Request Available</h1>
                    </div>
                    @endif
                </div>

            </div>

            <!-- Inquiry show Modal starts -->
            <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Sourcing Information</h4>
                        </div>
                        <form class="form-horizontal" role="form" data-toggle="validator" id="showForm" method="post">
                            <div class="modal-body">
                                <div class="content">

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Inquiry</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_inquiry"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Country</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_country"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Company Name</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_company_name"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Sender Name</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_sender_name"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Telephone</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_telephone"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Email</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_email"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">User Type</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_user_type"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Mobile</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_mobile"></label>
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

                $id = $elem.find('.feedback_id').val();

                var url = "data/" + $id;
                $.get(url, function (data) {
                    var feedback = data.result;

                    $('#show_inquiry').text(feedback.inquiry);
                    $('#show_country').text(feedback.country);
                    $('#show_company_name').text(feedback.company_name);
                    $('#show_sender_name').text(feedback.sender_name);
                    $('#show_email').text(feedback.email);
                    $('#show_telephone').text(feedback.telephone);
                    $('#show_user_type').text(feedback.user_type);
                    $('#show_mobile').text(feedback.mobile);
                });
            });


            //Category Delete form submit handler
            $('.deleteform').submit(function (e) {
                var currentForm = this;
                e.preventDefault();

                bootbox.dialog({
                    message: "<h4>Do you really want to Delete this Sourcing Request?</h4>",
                    title: "Delete Sourcing Request",
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
