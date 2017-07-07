@extends('userview.master')

@section('title', 'Message View')

@section('pagebody')

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">

            <div class="x_panel">
                <div class="x_title">
                    <h2>Messages</h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="dashboard-widget-content">
                        <div class="row">

                            <div class="col-sm-12 mail_list_column" >
                                @foreach($messages as $message)
                                    @if($message->type == 'reqtobuyer')
                                        <?php $data = \App\ReqToBuyer::where('id', $message->req_id)->first();?>
                                    @elseif($message->type == 'reqtosupplier')
                                        <?php $data = \App\ReqToSupplier::where('id', $message->req_id)->first();?>
                                    @elseif($message->type == 'reply')
                                        <?php $data = \App\Replies::where('id', $message->req_id)->first();?>
                                    @endif
                                    <a href="{{url('message/single-view',$message->id)}}">
                                        <div class="mail_list col-sm-12 <?php if($message->new) echo 'unread_message'; ?>" >
                                            <div class="left col-sm-1">
                                                <i class="fa fa-envelope<?php if(!$message->new) echo '-o'; ?>"></i>
                                            </div>
                                            <div class="right col-sm-11">
                                                <h3 class="col-sm-3">{{\App\User::where('id',$message->from)->value('company_name')}}</h3>
                                                <p class="col-sm-7">
                                                    <?php if ($message->type == 'reqtosupplier') echo $data->subject; ?>
                                                </p>
                                                <p class="col-sm-2 text-right">
                                                    <small>{{$data->created_at}}</small>
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            {!! $messages->render() !!}
                            <!-- /MAIL LIST -->
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </div>


@endsection
