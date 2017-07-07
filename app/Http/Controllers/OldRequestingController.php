<?php

namespace App\Http\Controllers;

use App\Message;
use App\Product;
use App\ReqToBuyer;
use App\ReqToSupplier;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RequestingController extends Controller
{


    public function getBuyerToSupplier($id)
    {
        if (\Auth::check()) {
            if (\Auth::user()->getAttributeValue('role') != 'buyer' && \Auth::user()->getAttributeValue('role') != 'both') {
                return redirect()->back();
            }
        }
        $supplier_id = $id;
        $categories = Category::orderBy('name')->get();

        return view('publicview.sendinquiry', compact('supplier_id', 'categories'));
    }

    public function postBuyerToSupplier($supplier_id)
    {

        $supplier_id = $supplier_id;

        $input = \Request::all();

//        dd($input);

        $input['approved'] = 0;

        if (\Auth::check()) {
            if (\Auth::user()->getAttributeValue('role') != 'buyer' && \Auth::user()->getAttributeValue('role') != 'both') {
                return redirect()->back();
            }
            $this->saveData($supplier_id, $input, \Auth::user()->getAttributeValue('id'));
            return "successs";
        } else if ($input['member'] == 'M') {
            if (\Auth::attempt(['email' => $input['email'], 'password' => $input['login_password']]) && \Auth::user()->getAttributeValue('approved') == 1) {
                if (\Auth::user()->getAttributeValue('role') != 'buyer' && \Auth::user()->getAttributeValue('role') != 'both') {
                    return redirect()->back();
                }
                $this->saveData($supplier_id, $input, \Auth::user()->getAttributeValue('id'));
                return redirect('reqs/buyer-to-supplier/'.$supplier_id)->with('success', 'Message Sent Successfully');
            } else {
                return redirect()->back();
            }
        } else if ($input['member'] == 'NM') {
            try {
                $user_id = $this->reg_user($input);
                $this->saveData($supplier_id, $input, $user_id);
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
    private function saveData($supplier_id, $input, $user)
    {
        ReqToSupplier::unguard();

        $data = ReqToSupplier::create([
            'supplier' => $supplier_id,
            'buyer' => $user,
            'subject' => $input['subject'],
            'message' => $input['message'],
            'response_required_time' => date('Y-m-d', strtotime('+' . $input['response_required_time'] . ' days')),
            'images' => $this->get_images($input),
            'approved' => $input['approved'],
            'additional' => isset($input['additional']) ? json_encode($input['additional']) : ""
        ]);

        ReqToSupplier::reguard();

        Message::unguard();
        Message::create([
            'from' => $data->buyer,
            'to' => $data->supplier,
            'req_id' => $data->id,
            'approved' => 0,
            'type' => 'reqtosupplier',
            'new' => 0
        ]);
        Message::reguard();
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


    public function getSupplierToBuyer($buyer_id, $product_id)
    {
        if (!\Auth::check()) {
            return redirect('auth/login');
        } elseif (\Auth::user()->getAttributeValue('role') != 'supplier' && \Auth::user()->getAttributeValue('role') != 'both') {
            return redirect()->back();
        }

        $buyer_id = $buyer_id;
        $product_id = $product_id;
        $categories = Category::orderBy('name')->get();

        return view('publicview.buyer-contact', compact('buyer_id', 'product_id', 'categories'));

    }

    public function postSupplierToBuyer($buyer)
    {

        if (!\Auth::check()) {
            return redirect('auth/login');
        } elseif (\Auth::user()->getAttributeValue('role') != 'supplier' && \Auth::user()->getAttributeValue('role') != 'both') {
            return redirect()->back();
        }

        $input = \Request::all();

        ReqToBuyer::unguard();

        $data = ReqToBuyer::create([
            'supplier' => \Auth::user()->getAttributeValue('id'),
            'buyer' => $buyer,
            'message' => $input['message'],
            'supply_ability' => $input['supply_ability'],
            'images' => $this->get_images($input),
            'approved' => 0,
            'additional' => isset($input['additional']) ? json_encode($input['additional']) : ""

        ]);
        ReqToBuyer::reguard();

        Message::unguard();
        Message::create([
            'from' => $data->supplier,
            'to' => $data->buyer,
            'req_id' => $data->id,
            'approved' => 0,
            'type' => 'reqtobuyer',
            'new' => 0
        ]);
        Message::reguard();

        return redirect('reqs/supplier-to-buyer/'.$buyer)->with('success', 'Message Sent Successfully');
    }


}
