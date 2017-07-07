<?php

namespace App\Http\Controllers;

use Mail;
use App\Buyproduct;
use App\Feedback;
use Illuminate\Http\Request;
use App\Theme;
use App\User;
use App\Post;
use App\Product;
use App\Category;
use App\CategoryImage;
use App\CategoryOrder;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class PublicViewController extends Controller
{

    public function getHome()
    {
        $categories = CategoryOrder::orderBy('order')->get();

        foreach ($categories as $category)
        {
            $cat = Category::where('id', $category->category_id)->first();

            $category->id = $category->category_id;
            $category->name = $cat->name;

            $category->subcategory = Category::where('parent', $category->id)->get();
        }

        $featured_categories = CategoryImage::where('featured', '1')->get();

        $verified_supplier = User::where('approved',1)->where('verified_company','1')->get();

        $gold_supplier = User::where('approved',1)->where('gold_supplier','1')->get();

        foreach ($featured_categories as $feat)
        {
            $feat->name = Category::where('id', $feat->category_id)->value('name');
        }

        $heroimage = Theme::where('type', 'heroimage')->value('content_link');
        $videos = Theme::where('type', 'video')->get();
        $featured_products = Product::where('featured', '1')->get();

        $email = Theme::where('type','email')->value('content_link');
        $facebook = Theme::where('type','facebook')->value('content_link');
        $twitter = Theme::where('type','twitter')->value('content_link');
        $googleplus = Theme::where('type','googleplus')->value('content_link');
        $linkedin = Theme::where('type','linkedin')->value('content_link');

        return view('publicview.homepage', compact('categories', 'heroimage', 'videos', 'featured_categories', 'featured_products','verified_supplier','gold_supplier','email','facebook','twitter','googleplus','linkedin'));
    }

    /**
     * @return mixed
     */
    private function get_categories()
    {
        $categories = Category::where('level', 1)->lists('id')->toArray();
        $i = 0;
        $category_obj_array = [];
        foreach ($categories as $category) {
            $category_obj_array[$i] = new \stdClass();
            $category_obj_array[$i]->parent = $category;
            $category_obj_array[$i++]->child = Category::where('parent', $category)->lists('name', 'id')->toArray();
        }
        return $category_obj_array;
    }


    /**
     * @param $input
     */
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

    public function getCompanyProfile($id = null)
    {
        if ($id == null)
            return redirect('404-error');

        $company = User::where('id', $id)->first();

        if($company->role == 'buyer')
          return redirect('404-error');

        if($company->role == 'buyer')
          $products = BuyProduct::where('user',$id)->get();
        else
          $products = Product::where('user', $id)->get();

        return view('publicview.companyprofile', compact('company', 'products'));
    }

    public function getSingleProduct($id = null)
    {
        if ($id == null)
            return redirect('404-error');

        $product = Product::where('id', $id)->first();

        $product->company_name = User::where('id', $product->user)->value('company_name');

        return view('publicview.single-product', compact('product'));
    }


    public function getSingleBuyingRequest($id = null)
    {
        if ($id == null)
            return redirect('404-error');

        $product = BuyProduct::where('id', $id)->first();

        $product->company_name = User::where('id', $product->user)->value('company_name');

        return view('publicview.single-buying-request', compact('product'));
    }

    public function postUserInquiry()
    {
      $input = \Request::all();

      //Send Mail to user notifying the approval
      Mail::send('emails.userfeedback', ['data' => $input], function ($m) {
          $m->from('admin@sourcingkey.com', 'SourcingKey');

          $m->to('shaon.cse81@gmail.com', 'Admin')->subject('User Inquiry from Sourcing Key');
      });

      return true;
    }

    public function getPostList($type)
    {
        $posts = Post::where('type', $type)->orderBy('id', 'desc')->paginate(SettingsController::MAX_PAGINATE);
        return view('publicview.news-list', compact('posts','type'));
    }

    public function getPostShow($id)
    {
        $post = Post::find($id);
        return view('publicview.news-single', compact('post'));
    }
}
