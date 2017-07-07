<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostsController extends Controller
{
    //
    public function getNewsCreate()
    {
        return view('userview.news-create');
    }

    public function getNewsUpdate($id)
    {
        return view('userview.news-udpate');
    }

    public function getIndustryCreate()
    {
        return view('userview.industry-create');
    }

    public function postNewsCreate()
    {
        $input = \Request::all();
        $input['post'] = str_replace('\r\n', '<br>', $input['post']);
        $input['type'] = 'news';
        Post::unguard();
        Post::create($input);
        Post::reguard();
    }
    public function postIndustryCreate()
    {
        $input = \Request::all();
        $input['post'] = str_replace('\r\n', '<br>', $input['post']);
        $input['type'] = 'industry';
        Post::unguard();
        Post::create($input);
        Post::reguard();
    }

    public function getNewsList()
    {
        $news_list = Post::where('type', 'news')->paginate(10);
        return view('publicview.news-list', compact('news_list'));
    }
    public function getIndustryList()
    {
        $industry_list = Post::where('type', 'industry')->paginate(10);
        return view('publicview.industry-list', compact('industry_list'));
    }

    public function getNewsShow($id)
    {
        $news = Post::find($id);
        return view('publicview.news-single', compact('news'));
    }

    public function getIndustryShow($id)
    {
        $industry = Post::find($id);
        return view('publicview.industry-single', compact('industry'));
    }
}
