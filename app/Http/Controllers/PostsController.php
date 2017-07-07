<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{

    public function getCreate()
    {
        return view('userview.post-create');
    }

    public function postStore()
    {

        $input = \Request::all();
//        return $input;

        try {
            if (isset($input['featured_image'])) {
                $path = 'images/featured_images/'; //relative path, not absolute
                $image_file = $input['featured_image'];
                $image_name = time() . $image_file->getClientOriginalName();
                $image_path = $path . $image_name;

                // prevent possible upsizing
                Image::make($image_file)->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($image_path);

                $input['featured_image'] = $image_path;
            } else {
                $input['featured_image'] = null;
            }
        } catch (\Exception $e) {
            return $e;
        }
//        Post::unguard();
        Post::create($input);
//        Post::reguard();
        return redirect()->back()->with('success', 'Post submitted Successfully');
    }

    public function getEdit($id)
    {
        return view('userview.post-edit', compact('id'));
    }

    public function postUpdate($id)
    {
        $input = \Request::all();

        if (isset($input['featured_image'])) {
            $path = 'images/featured_images/'; //relative path, not absolute
            $image_file = $input['featured_image'];
            $image_name = time() . $image_file->getClientOriginalName();
            $image_path = $path . $image_name;

            // prevent possible upsizing
            Image::make($image_file)->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($image_path);
            $input['featured_image'] = $image_path;
        } else {
            $input['featured_image'] = Post::where('id', $id)->value('featured_image');
        }

        Post::where('id', $id)->update($input);
        return redirect()->back()->with('success', 'Post Updated Successfully');
    }

    public function getList($type)
    {
        $posts = Post::where('type', $type)->orderBy('id', 'desc')->paginate(10);
        return view('userview.posts-list', compact('posts', 'type'));
    }

    public function getDelete($id)
    {
        Post::destroy($id);
        return redirect()->back();
    }
}
