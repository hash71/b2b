@extends('userview.master')

@section('title', ucfirst($type).' List')

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
                <h2>{{ucfirst($type)}} List <small>Update, Delete {{ucfirst($type)}} from here</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
              @if($posts->total()>0)
                <table class="table table-striped responsive-utilities jambo_table bulk_action">
                    <thead>
                        <tr class="headings">
                            <th class="column-title">S/L </th>
                            <th class="column-title">Title </th>
                            <th class="column-title text-right">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $i = 1; ?>
                        @foreach($posts as $post)
                        <form class="deleteform" action="{{ URL::to('category/delete') }}" method="POST">
                            <tr class="even pointer single-cat">
                                <td>{{$i++}}</td>
                                <td class="post_title">{{$post->title}} </td>
                                <td class="text-right">
                                    <div class="btn-group">
                                      <a href="{{url('post-show',$post->id)}}" target="_blank" class="btn btn-sm btn-success viewbutton" data-placement="top" title="View">  <i class="fa fa-file"></i>
                                      </a>
                                      <a href="{{url('post/edit',$post->id)}}" class="btn btn-sm btn-default editbutton" data-placement="top" title="Edit">  <i class="fa fa-pencil"></i>
                                      </a>
                                      <a href="{{url('post/delete',$post->id)}}" class="btn btn-sm btn-danger deletebutton" data-placement="top" title="Delete">  <i class="fa fa-times"></i>
                                      </a>
                                    </div>
                                </td>
                            </tr>
                        </form>
                        @endforeach
                    </tbody>

                </table>

                <div style="text-align: right">
                    <?php echo $posts->render(); ?>
                </div>
                @else
                <div class="notavailable">
                  <h1>No {{ucfirst($type)}} Available</h1>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection
