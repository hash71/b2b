<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use App\Buyproduct;
use Request;
use App\Http\Controllers\Controller;

class BuyingOffersController extends Controller
{
  public function getNew()
  {
      $categories = $this->get_categories();

      $cats = Category::orderBy('name')->get();

      return view('publicview.postbuyingrequest', compact('categories','cats'));
  }

  public function postNew()
  {
      $input = \Request::except('maincategory');

      $input['approved'] = 0;

      // dd($input);

      if (\Auth::check()) {
          $this->saveData($input);
          return redirect()->back()->with('success', 'Buying Request Posted Successfully');
      } else if ($input['member'] == 'M') {
          if (\Auth::attempt(['email' => $input['email'], 'password' => $input['login_password'], 'approved' => 1])) {
              if (\Auth::user()->role == 'admin') {
                  return redirect()->back()->with('error', 'Admin cannot post Buying Offers');
              }
              $input['user'] = \Auth::user()->getAttributeValue('id');
              $this->saveData( $input);
              return redirect()->back()->with('success', 'Buying Request Posted Successfully');
          } else {
              return redirect()->back()->with('error', 'Wrong Login Credentials');
          }
      } else if ($input['member'] == 'NM') {
          try {
              $user_id = $this->reg_user($input);
              $input['user'] = $user_id;
              $this->saveData($input);
              return redirect('auth/register-success');
          } catch (\Exception $e) {
              return redirect()->back();
          }
      }

      return redirect('buying-request/new')->with('success', 'Buying Request Posted Successfully');
  }



  /**
   * @param $product_id
   * @param $input
   * @return string
   */
  private function saveData($input)
  {
      Buyproduct::unguard();
      $data = Buyproduct::create([
          'user'  => $input['user'],
          'product_name' => $input['product_name'],
          'specification' => $input['specification'],
          'category' => $input['category'],
          'order_quantity' => $input['order_quantity'],
          'quantity_unit' => $input['quantity_unit'],
          'expire_date' => $input['expire_date'],
          'images' => $this->get_images($input),
          'approved' => $input['approved']
      ]);

      Buyproduct::reguard();
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

  public function getList()
  {
      if (\Auth::user()->getAttributeValue('role') == 'admin') {
          $products = BuyProduct::where('approved', 1)->orderBy('id', 'desc')->paginate(SettingsController::MAX_PAGINATE);
      } else if (\Auth::user()->getAttributeValue('role') == 'buyer' || \Auth::user()->getAttributeValue('role') == 'both') {
          $products = BuyProduct::where('user', \Auth::user()->getAttributeValue('id'))->where('approved', 1)->orderBy('id', 'desc')->paginate(SettingsController::MAX_PAGINATE);
      } else {
          return redirect('/dashboard');
      }

      foreach ($products as $product)
      {
          $product->category = Category::where('id', $product->category)->value('name');
      }

      $category_obj_array = $this->get_categories();

      return view('userview.buying-request-list', compact('products', 'category_obj_array'));
  }

  public function postDelete()
  {
      $prod_id = Request::input('id');

      BuyProduct::destroy($prod_id);

      return redirect('buying-request/list')->with('success', 'Buying Offer Deleted Successfully');
  }

  public function getBuyingData($id = null)
  {
      if (Request::ajax()) {
          if ($id)
          {
              $product = BuyProduct::where('id', $id)->first();

              $cat = Category::where('id', $product->category)->first();

              $product->sub_category_id = $product->category;
              $product->sub_category = $cat->name;
              $product->categoryid = $cat->parent;
              $product->category = Category::where('id', $cat->parent)->value('name');

              $product->image = first_image($product->images);

              return response()->json(['success' => true, 'result' => $product]);
          }
          else
          {
              return response()->json(['success' => false]);
          }
      }
  }

  public function postUpdate()
  {
      $input = Request::all();

      $images = [];

      if ($input['image'][0] == null) {
          $input['image'] = BuyProduct::where('id', $input['id'])->value('image');
      }
      else
      {
          foreach ($input['image'] as $image_file)
          {
              $path = 'images/products/'; //relative path, not absolute
              $image_name = time() . $image_file->getClientOriginalName();
              $image_path = $path . $image_name;
              Image::make($image_file)->resize(300, 200)->save($image_path);
              array_push($images, $image_path);
          }

          $input['image'] = json_encode($images);
      }

      $p_id = $input['id'];
      unset($input['maincategory']);
      unset($input['id']);


      BuyProduct::where('id', $p_id)->update($input);

      return redirect('buying-request/list')->with('success', 'Buying Offer Updated Successfully');
  }
}
