<?php

namespace App\Http\Controllers;

use App\Product;
use App\ReqToSupplier;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class ReqsController extends Controller
{
    public function getBuyerToSupplier($id)
    {
        $product_id = $id;
        $categories = Category::orderBy('name')->get();

        return view('publicview.sendinquiry', compact('product_id', 'categories'));
    }

    public function postBuyerToSupplier($product_id)
    {
        $product_id = $product_id;

        $input = \Request::all();

//        dd($input);

        $input['approved'] = 0;

        if ($input['member'] == 'M') {
            if (\Auth::attempt(['email' => $input['email'], 'password' => $input['login_password']]) && \Auth::user()->getAttributeValue('approved') == 1) {
                $this->saveData($product_id, $input, \Auth::user()->getAttributeValue('id'));
                return "successs";
            } else {
                return redirect()->back();
            }
        } else if ($input['member'] == 'NM') {
            try {
                $user_id = $this->reg_user($input);
                $this->saveData($product_id, $input, $user_id);
                return redirect('auth/login');
            } catch (\Exception $e) {
                return redirect()->back();
            }
        }
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

    /**
     * @param $product_id
     * @param $input
     * @return string
     */
    private function saveData($product_id, $input, $user)
    {
        ReqToSupplier::unguard();

        ReqToSupplier::create([
            'supplier' => Product::where('id', $product_id)->value('user'),
            'buyer' => $user,
            'subject' => $input['subject'],
            'message' => $input['message'],
            'response_required_time' => date('Y-m-d', strtotime('+'.$input['response_required_time'].' days')),
            'images' => $this->get_images($input),
            'approved' => $input['approved'],
            'additional' => json_encode($input['additional'])
        ]);

        ReqToSupplier::reguard();
    }

    /**
     * @param $input
     */
    private function reg_user($input)
    {
        $input['password'] = bcrypt($input['reg_password']);
        User::unguard();
        $user_id = User::insertGetId([
            "email" => $input['email'],
            "password" => $input['password'],
            "role" => $input['type'],
            "company_name" => $input['company_name'],
            "category" => $input['category'],
            "contact_person" => $input['contact_person'],
            "business_phone" => $input['business_phone'],
            "subscribe" => $input['subscribe'],
            "approved" => 0
        ]);

        User::reguard();

        return $user_id;
    }
}
