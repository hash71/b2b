<?php namespace App\Http\Controllers;

use App\Product;
use DB;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;
use Request;
use App\Category;

class ProductsController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
        $this->middleware('notadmin', ['only' => [
            'getAdd',
            'postAdd'
        ]]);
    }


    public function getAdd()
    {
        if (\Auth::user()->getAttributeValue('role') != 'supplier' && \Auth::user()->getAttributeValue('role') != 'both') {
            return redirect()->back();
        }
        if (Product::where('user', \Auth::user()->getAttributeValue('id'))->count() > 10 && \Auth::user()->getAttributeValue('gold_supplier') == 0 && \Auth::user()->getAttributeValue('premium_gold_supplier') == 0) {
            return redirect('dashboard')->with('error', 'Please Upgrade To Gold Account To Post More Products');
        }

        $categories = Category::where('level', 1)->lists('id')->toArray();
        $i = 0;
        $category_obj_array = [];
        foreach ($categories as $category) {
            $category_obj_array[$i] = new \stdClass();
            $category_obj_array[$i]->parent = $category;
            $category_obj_array[$i++]->child = Category::where('parent', $category)->lists('name', 'id')->toArray();
        }

        return view('userview.product-add', compact('category_obj_array'));
    }

    public function postAdd()
    {

        if (\Auth::user()->getAttributeValue('role') != 'supplier' && \Auth::user()->getAttributeValue('role') != 'both') {
            return redirect()->back();
        }

        $input = Request::all();
        $input['user'] = \Auth::user()->getAttributeValue('id');

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


        unset($input['maincategory']);

        $input['images'] = json_encode($images);

        Product::unguard();
        Product::create($input);
        Product::reguard();

        return redirect('products/add')->with('success', 'New Product Added Successfully');
    }

    public function postUpdate()
    {
        $input = Request::all();

        $images = [];

        if ($input['image'][0] == null) {
            $input['image'] = Product::where('id', $input['id'])->value('image');
        } else {
            foreach ($input['image'] as $image_file) {

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


        Product::where('id', $p_id)->update($input);

        return redirect('products/list')->with('success', 'Product Updated Successfully');
    }

    public function getProductSearch()
    {
        return view('publicview.productsearch');
    }

    public function getList()
    {
        if (\Auth::user()->getAttributeValue('role') == 'admin') {
            $products = Product::where('approved', 1)->orderBy('id', 'desc')->paginate(SettingsController::MAX_PAGINATE);
        } else if (\Auth::user()->getAttributeValue('role') == 'supplier' || \Auth::user()->getAttributeValue('role') == 'both') {
            $products = Product::where('user', \Auth::user()->getAttributeValue('id'))->where('approved', 1)->orderBy('id', 'desc')->paginate(SettingsController::MAX_PAGINATE);
        } else {
            return redirect('/dashboard');
        }

        foreach ($products as $product) {
            $product->category = Category::where('id', $product->category)->value('name');
        }

        $categories = Category::where('level', 1)->lists('id')->toArray();
        $i = 0;
        $category_obj_array = [];
        foreach ($categories as $category) {
            $category_obj_array[$i] = new \stdClass();
            $category_obj_array[$i]->parent = $category;
            $category_obj_array[$i++]->child = Category::where('parent', $category)->lists('name', 'id')->toArray();
        }

        return view('userview.product-list', compact('products', 'category_obj_array'));
    }

    public function postDelete()
    {
        $prod_id = Request::input('prod_id');

        Product::destroy($prod_id);

        return redirect('products/list')->with('success', 'Product Deleted Successfully');
    }

    public function postMakefeatured()
    {
        if (Request::ajax()) {
            $p_id = Request::input('product_id');
            $checked = Request::input('status');

            if ($checked == 'true')
                $status = 1;
            else
                $status = 0;

            Product::where('id', $p_id)->update([
                'featured' => $status
            ]);
            return response()->json(['success' => true]);
        }
    }


    public function getProductData($id = null)
    {
        if (Request::ajax()) {
            if ($id) {
                $product = Product::where('id', $id)->first();

                $cat = Category::where('id', $product->category)->first();

                $product->sub_category_id = $product->category;
                $product->sub_category = $cat->name;
                $product->categoryid = $cat->parent;
                $product->category = Category::where('id', $cat->parent)->value('name');

                $product->image = first_image($product->images);

                return response()->json(['success' => true, 'result' => $product]);
            } else {
                return response()->json(['success' => false]);
            }

        }
    }
}
