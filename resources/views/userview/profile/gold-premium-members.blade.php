@extends('userview.master')

@section('title', 'Gold Premium Members List')

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
                    <h2>Gold Premium Members List</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    @if($members->total()>0)
                        <table class="table table-striped responsive-utilities jambo_table bulk_action">
                            <thead>
                            <tr class="headings">
                                <th class="column-title">S/L</th>
                                <th class="column-title">Company Name</th>
                                <th class="column-title">Category</th>
                                <th class="column-title">Role</th>
                                <th class="column-title text-right">Action</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $i = 1; ?>
                            @foreach($members as $member)

                                    <tr class="even pointer single-member">
                                        <input type="hidden" class="member_id" value="{{$member->id}}" name="id">
                                        <td class=" ">{{$i++}}</td>
                                        <td class="member-name"> {{$member->company_name}}</td>

                                        <td> {{\App\Category::where('id',$member->category)->value('name')}}</td>
                                        <td> {{$member->role}}</td>

                                        <td class="text-right">
                                            <div class="btn-group">
                                                <button type="button" data-toggle="modal" data-target="#showModal"
                                                        class="btn btn-sm btn-success showbutton" data-placement="top"
                                                        title="Full View">
                                                    <i class="fa fa-file"></i>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>

                            @endforeach
                            </tbody>

                        </table>

                        <div style="text-align: right">
                            {!! $members->render() !!}
                        </div>

                    @else
                        <div class="notavailable">
                            <h1>No Gold Premium Members Available</h1>
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
                            <h4 class="modal-title">Member Information</h4>
                        </div>
                        <form class="form-horizontal" role="form" data-toggle="validator" id="showForm" method="post">
                            <div class="modal-body">
                                <div class="content">

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Member Name: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_member_name"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Member Email: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_member_email"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Role: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_member_role"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Business Type: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_business_type"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Category: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_category"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Contact
                                            Person: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_contact_person"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Business
                                            Phone: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_business_phone"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Country: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_country"></label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Website: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label style="padding-top: 8px;" id="show_website"></label>
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
                $elem = $(this).closest('.single-member');

                $id = $elem.find('.member_id').val();

                var url = "member-data/" + $id;
                $.get(url, function (data) {
                    var member = data.result;

                    // console.log(member);

                    $('#show_member_name').text(member.company_name);
                    $('#show_member_email').text(member.email);
                    $('#show_member_role').text(member.role);
                    $('#show_business_type').text(member.business_type);
                    $('#show_category').text(member.category_name);
                    $('#show_contact_person').text(member.contact_person);
                    $('#show_business_phone').text(member.business_phone);
                    $('#show_country').text(member.country);
                    $('#show_website').text(member.website);


                });
            });

        });
    </script>

@endsection
