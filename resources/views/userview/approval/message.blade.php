@extends('userview.master')

@section('title', 'Message Approval')

@section('custommetahead')
    <style>
        .simple-label {
            font-weight: 400;
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
                    <h2> Message Approval
                        <small>Approve or Delete following messages</small>
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <table class="table table-striped responsive-utilities jambo_table bulk_action">
                        <thead>
                        <tr class="headings">
                            <th class="column-title">S/L</th>
                            <th class="column-title">Sender Name</th>
                            <th class="column-title">Reciever Name</th>
                            <th class="column-title text-right">Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php $i = 1; ?>

                        {{--<form class="deleteform" action="{{ URL::to('approve/registration-approve') }}" method="POST">--}}
                        @foreach($messages as $message)
                            <tr class="even pointer single-cat">
                                <input type="hidden" class="id" value="" name="id">

                                <td class=" ">{{$i++}}</td>
                                <td class="cat_name">
                                  {{\App\User::where('id',$message->from)->value('company_name')}}
                                  @if(\App\User::where('id',$message->from)->value('premium_gold_supplier') == 1)
                                  <img width="40px" src="{{URL::asset('images/gold.jpg')}}" class="" alt="" />
                                  @elseif(\App\User::where('id',$message->from)->value('gold_supplier') == 1)
                                  <img width="40px" src="{{URL::asset('images/premiumgold.jpg')}}" class="" alt="" />
                                  @endif
                                </td>
                                <td class="cat_name">
                                  {{\App\User::where('id',$message->to)->value('company_name')}}
                                  @if(\App\User::where('id',$message->to)->value('premium_gold_supplier') == 1)
                                  <img width="40px" src="{{URL::asset('images/gold.jpg')}}" class="" alt="" />
                                  @elseif(\App\User::where('id',$message->to)->value('gold_supplier') == 1)
                                  <img width="40px" src="{{URL::asset('images/premiumgold.jpg')}}" class="" alt="" />
                                  @endif
                                </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                      <a href="{{url('message/single-view',$message->id)}}" target="_blank">
                                          <button type="button" class="btn btn-sm btn-default"
                                                  data-placement="top" title="Full View"><i class="fa fa-file"></i>
                                          </button>
                                      </a>
                                        <a href="{{url('approve/message-accept',$message->id)}}">
                                            <button type="button" class="btn btn-sm btn-success editbutton"
                                                    data-placement="top" title="Approve"><i class="fa fa-check"></i>
                                            </button>
                                        </a>
                                        <a href="{{url('approve/message-reject',$message->id)}}">
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
                    </div>

                </div>
            </div>
        </div>
    </div>


    @endsection

    @section('customfooterscript')
    <script src="{{ URL::asset('js/bootbox.min.js') }}"></script>

    <script>
        jQuery(document).ready(function ($) {

            //Category Delete form submit handler
            $('.deleteform').submit(function (e) {
                var currentForm = this;
                e.preventDefault();

                bootbox.dialog({
                    message: "<h4>Do you really want to Delete this Message?</h4>",
                    title: "Message Product",
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
