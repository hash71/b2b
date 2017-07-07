<?php

namespace App\Http\Controllers;


//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Message;
use App\Paginators\PaginationMerger;
use App\Replies;
use Illuminate\Support\Collection;
use Intervention\Image\Facades\Image;

class MessageController extends Controller
{
    public function getView()
    {
        $messages = Message::where('approved', 1)
                            ->where('to', \Auth::user()->getAttributeValue('id'))
                            ->orderBy('id', 'desc')
                            ->paginate(SettingsController::MAX_MORE_PAGINATE);

        return view('userview.message.view', compact('messages'));
    }

    public function getSent()
    {
        $messages = Message::where('from', \Auth::user()->getAttributeValue('id'))
                            ->orderBy('id', 'desc')
                            ->paginate(SettingsController::MAX_MORE_PAGINATE);

        return view('userview.message.sent', compact('messages'));
    }

    public function getSingleView($id)
    {
        Message::where('id', $id)->update(['new' => 0]);

        $message = Message::find($id);

        return view('userview.message.singlemessage', compact('message'));
    }

    public function postReply()
    {
        $input = \Request::all();

        Replies::unguard();

        $data = Replies::create([
            'message' => $input['message'],
            'images' => $this->get_images($input)
        ]);

        Replies::reguard();

        Message::unguard();
        Message::create([
            'from' => \Auth::user()->getAttributeValue('id'),
            'to' => $input['user_id'],
            'new' => 1,
            'approved' => 0,
            'type' => 'reply',
            'req_id' => $data->id
        ]);
        Message::reguard();

        return redirect('message/view');
    }


    private function get_images($input)
    {
        $images = [];

        if (!is_null($input['images'][0])) {
            foreach ($input['images'] as $image_file) {
                $path = 'images/products/'; //relative path, not absolute
                $image_name = time() . $image_file->getClientOriginalName();
                $image_path = $path . $image_name;
                Image::make($image_file)->resize(300, 200)->save($image_path);
                array_push($images, $image_path);
            }
        } else {
            array_push($images, "images/common-placeholder.jpg");
        }
        return json_encode($images);
    }
}
