@extends('userview.master')

@section('title', 'Single Message View')
@section('custommetahead')

    <style>
        .simple-label {
            font-weight: 400;
        }

        .message-header{
          padding: 5px;
          background-color: rgb(76, 96, 110);
          color: #fff;
          font-size: 16px;
          margin-left: -10px;
          margin-right: -10px;
          padding: 10px;
        }

        .message-main-body{
          border: 1px solid rgb(76,96,110);
          padding: 20px;
          font-size: 15px;
        }

        #replyModal .modal-header {
            background-color: #7761a7;
            color: #fff;
            border-bottom: 3px solid #634d93 !important;
        }
    </style>
@endsection
@section('pagebody')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">
                <div class="x_title">
                    <h2>Message</h2>
                    @if(\Auth::user()->getAttributeValue('role') != 'admin')
                    <div class="compose-btn pull-right col-md-2 text-right">
                        <button type="button" data-toggle="modal" data-target="#replyModal"
                                class="btn btn-sm btn-primary" data-placement="top"
                                title="Reply"><i class="fa fa-reply"></i> Reply
                        </button>
                        <a href="{{url('message/view')}}" class="btn btn-default pull-right"><i
                                    class="fa fa-arrow-left"></i> back to inbox</a>
                    </div>

                    @endif
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="dashboard-widget-content">
                        <div class="row">

                            <!-- CONTENT MAIL -->
                            <div class="col-sm-12 mail_view" style="border-left: none;">
                                <div class="inbox-body">
                                    <div class="sender-info">
                                        <div class="col-md-12">
                                                <div class="message-header" style="border-bottom: 1px solid #fff;">
                                                    <strong>From:</strong>
                                                    {{\App\User::where('id',$message->from)->value('company_name')}}

                                                    @if(\App\User::where('id',$message->from)->value('premium_gold_supplier') == 1)
                                                    <img width="70px" src="{{URL::asset('images/gold.jpg')}}" class="" alt="" />
                                                    @elseif(\App\User::where('id',$message->from)->value('gold_supplier') == 1)
                                                    <img width="70px" src="{{URL::asset('images/premiumgold.jpg')}}" class="" alt="" />
                                                    @endif
                                                </div>
                                                <div class="message-header">
                                                    <strong>To:</strong>
                                                    {{\App\User::where('id',$message->to)->value('company_name')}}

                                                    @if(\App\User::where('id',$message->to)->value('premium_gold_supplier') == 1)
                                                    <img width="70px" src="{{URL::asset('images/gold.jpg')}}" class="" alt="" />
                                                    @elseif(\App\User::where('id',$message->to)->value('gold_supplier') == 1)
                                                    <img width="70px" src="{{URL::asset('images/premiumgold.jpg')}}" class="" alt="" />
                                                    @endif
                                                </div>
                                        </div>
                                    </div>
                                    <div class="view-mail">
                                      <div class="col-md-12 message-main-body" style="margin-bottom: 20px;">

                                        @if($message->type == 'reqtobuyer')
                                            <?php
                                            $additionals = json_decode(\App\ReqToBuyer::where('id', $message->req_id)->value('additional'));
                                            $images = json_decode(\App\ReqToBuyer::where('id', $message->req_id)->value('images'));
                                            $j = 1;
                                            ?>
                                            <div>
                                                {{\App\ReqToBuyer::where('id',$message->req_id)->value('message')}}
                                            </div>
                                            @if($images!=null)
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                  <label for="">Attached Images: </label> <br/>
                                                  <div class="text-center">
                                                    @foreach($images as $image)
                                                      <img src="{!! asset($image) !!}" alt="" width="200px;">
                                                    @endforeach
                                                  </div>
                                            </div>
                                            @endif
                                            @if(isset($additionals))
                                                <div>
                                                    <h6>Additionals</h6>
                                                    @foreach($additionals as $item)
                                                        {!! $j++.".".$item."<br>" !!}

                                                    @endforeach
                                                </div>
                                            @endif

                                        @elseif($message->type == 'reqtosupplier')
                                            <?php
                                            $additionals = json_decode(\App\ReqToSupplier::where('id', $message->req_id)->value('additional'));

                                            $images = json_decode(\App\ReqToSupplier::where('id', $message->req_id)->value('images'));

                                            $j = 1;
                                            ?>

                                            <div class="col-md-12" style="border-bottom: 1px solid #DDD; padding: 5px 0px;">
                                                <label for="">Subject: </label> {{\App\ReqToSupplier::where('id',$message->req_id)->value('subject')}}
                                            </div>
                                            <div class="col-md-12" style="border-bottom: 1px solid #DDD; padding: 5px 0px;">
                                                <label for="">Message: </label> {{\App\ReqToSupplier::where('id',$message->req_id)->value('message')}}
                                            </div>
                                            <div class="col-md-12" style="border-bottom: 1px solid #DDD; padding: 5px 0px;">
                                                <label for="">Reply me within: </label> {{substr(\App\ReqToSupplier::where('id',$message->req_id)->value('response_required_time'),0,10)}}
                                            </div>

                                            @if(isset($additionals))
                                                <div class="col-md-12" style="padding: 5px 0px;">
                                                    <label for="">Additionals requested: </label> <br/>
                                                    <div style="margin-left: 5%;">
                                                      @foreach($additionals as $item)
                                                          {!! $j++.".".$item."<br>" !!}

                                                      @endforeach
                                                    </div>

                                                </div>
                                            @endif
                                            @if($images!=null)
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                  <label for="">Attached Images: </label> <br/>
                                                  <div class="text-center">
                                                    @foreach($images as $image)
                                                      <img src="{!! asset($image) !!}" alt="" width="200px;">
                                                    @endforeach
                                                  </div>
                                            </div>
                                            @endif
                                        @elseif($message->type == 'reply')
                                            <?php
                                            $images = json_decode(\App\Replies::where('id', $message->req_id)->value('images'));
                                            ?>
                                            <div class="col-md-12" style="border-bottom: 1px solid #DDD; padding: 5px 0px;">
                                                Message: {{\App\Replies::where('id',$message->req_id)->value('message')}}
                                            </div>
                                            @if($images!=null)
                                            <div class="col-md-12" style="margin-top: 20px;">
                                                  <label for="">Attached Images: </label> <br/>
                                                  <div class="text-center">
                                                    @foreach($images as $image)
                                                      <img src="{!! asset($image) !!}" alt="" width="200px;">
                                                    @endforeach
                                                  </div>
                                            </div>
                                            @endif
                                        @endif
                                    </div>
                                  </div>
                                </div>

                            </div>
                            <!-- /CONTENT MAIL -->
                        </div>
                    </div>
                </div>
            </div>


            <!-- Messae Reply Modal starts -->
            <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Send Reply</h4>
                        </div>
                        <form action="{{ url('message/reply') }}" class="form-horizontal" role="form"
                              data-toggle="validator" id="editForm" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="content">
                                    <input type="hidden" value="{{$message->from}}" name="user_id">

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">To: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <label class="control-label">{{\App\User::where('id',$message->from)->value('company_name')}}</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Message: </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <textarea name="message" required
                                                      class="col-md-6 col-sm-6 col-xs-12 form-control"
                                                      placeholder="Message Text *"></textarea>

                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="image"
                                               class="control-label col-md-3 col-sm-3 col-xs-12">Image: </label>
                                        <div class="col-md-8 col-sm-8 col-xs-12">
                                            <input type="file" name="images[]" id="file" class="form-control float-left"
                                                   onchange="readURL(this);" multiple>

                                            <img src="{{ URL::asset('images/product-image.png') }}"
                                                 style="margin-left: 20%; padding: 10px; width: 50%;" id="blah"
                                                 alt="Image">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Send Message</button>
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
