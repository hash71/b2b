<?php

namespace App\Http\Controllers;

use App\User;
use App\Category;
use App\Buyproduct;
use App\CategoryOrder;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{

    /**
     * Product search by entering 'key' on searchbar field
     *
     * Dev. Note: This search reqeust handles by GET request because from the search result page
     * any of the other types(products, buyer, supplier) can be searched on same 'key'. Using GET type
     * holds the search key on the URL, so it is easy to handle this way.
     */
    public function getSearchBar()
    {
        $data = \Request::all();

        $approved_users = User::where('approved', 1)->lists('id')->toArray(); //Get the search result only for 'active' member

        //Get Categories for sidebar
        $categories = CategoryOrder::orderBy('order')->get();

        foreach ($categories as $category)
        {
            $cat = Category::where('id', $category->category_id)->first();

            $category->id = $category->category_id;
            $category->name = $cat->name;

            $category->subcategory = Category::where('parent', $category->id)->get();
        }


        $productcount = \App\Product::where('name', 'like', '%' . $data['name'] . '%')
                                ->where('approved',1)
                                ->whereIn('user', $approved_users)
                                ->count();

        $suppliercount = User::where('company_name', 'like', '%' . $data['name'] . '%')
                          ->whereIn('id', $approved_users)
                          ->where(function ($query) {
                                        $query->where('role', 'supplier')
                                            ->orWhere('role', 'both');
                                    })->count();

        $buyercount = Buyproduct::where('product_name', 'like', '%' . $data['name'] . '%')
                              ->where('approved',1)
                              ->whereIn('user', $approved_users)
                              ->count();

        if ($data['search_type'] == 'Products') //Product Search
        {
            $products = \App\Product::where('name', 'like', '%' . $data['name'] . '%')
                                    ->where('approved',1)
                                    ->whereIn('user', $approved_users)
                                    ->paginate(SettingsController::MAX_PAGINATE);

            $pagetitle = "Product Search for '" . $data['name'] . "'";

            return view('publicview.productsearch', compact('products', 'pagetitle', 'categories', 'data', 'productcount', 'suppliercount', 'buyercount'));
        }
        else if ($data['search_type'] == 'Suppliers') //Supplier Search
        {
            $suppliers = User::where('company_name', 'like', '%' . $data['name'] . '%')
                              ->whereIn('id', $approved_users)
                              ->where(function ($query) {
                                            $query->where('role', 'supplier')
                                                ->orWhere('role', 'both');
                                        })->paginate(SettingsController::MAX_PAGINATE);

            $pagetitle = "Supplier Search for '" . $data['name'] . "'";

            return view('publicview.suppliersearch', compact('suppliers', 'pagetitle', 'categories', 'data', 'productcount', 'suppliercount', 'buyercount'));
        }
        else if ($data['search_type'] == 'Buyers')  //Buyer Search
        {
            $products = Buyproduct::where('product_name', 'like', '%' . $data['name'] . '%')
                                  ->where('approved',1)
                                  ->whereIn('user', $approved_users)
                                  ->paginate(SettingsController::MAX_PAGINATE);

            $pagetitle = "Buyer Search for '" . $data['name'] . "'";

            return view('publicview.buyersearch', compact('products', 'pagetitle', 'categories', 'data', 'productcount', 'suppliercount', 'buyercount'));
        }

    }

    /**
     * Product search by clicking on category->sub-category link on sidebar
     *
     * Dev. Note: This search reqeust handles by GET request because from the search result page
     * any of the other types(products, buyer, supplier) can be searched on same 'category'.
     * Using GET type holds the search key on the URL, so it is easy to handle this way.
     */
    public function getCategory($search_type, $id)
    {
        $data['id'] = $id;
        $data['search_type'] = $search_type;
        //Get Categories for sidebar
        $categories = CategoryOrder::orderBy('order')->get();

        foreach ($categories as $category)
        {
            $cat = Category::where('id', $category->category_id)->first();

            $category->id = $category->category_id;
            $category->name = $cat->name;

            $category->subcategory = Category::where('parent', $category->id)->get();
        }

        $ids = [];

        if (Category::find($id)->value('parent') == 0) //Clicking on a 'main category' link
        {
            $ids = Category::where('parent', $id)->lists('id')->toArray();
        }
        array_push($ids, (int)$id);

        $approved_users = User::where('approved', 1)->lists('id')->toArray();


        $productcount = \App\Product::whereIn('category', $ids)
                    ->where('approved',1)
                    ->whereIn('user', $approved_users)
                    ->count();

        $suppliercount = User::whereIn('category', $ids)
                          ->whereIn('id', $approved_users)
                          ->where(function ($query) {
                                      $query->where('role', 'supplier')
                                          ->orWhere('role', 'both');
                                  })->count();

        $buyercount = $products = Buyproduct::whereIn('category', $ids)
                              ->where('approved',1)
                              ->whereIn('user', $approved_users)
                              ->count();

        if ($search_type == 'Products') //Product Search
        {
            $products = \App\Product::whereIn('category', $ids)
                        ->where('approved',1)
                        ->whereIn('user', $approved_users)
                        ->paginate(SettingsController::MAX_PAGINATE);

            $pagetitle = "Products List";

            return view('publicview.catproductsearch', compact('products', 'pagetitle', 'categories', 'data', 'productcount', 'suppliercount', 'buyercount'));

        }
        else if ($search_type == 'Suppliers') //Supplier Search
        {
            $suppliers = User::whereIn('category', $ids)
                              ->whereIn('id', $approved_users)
                              ->where(function ($query) {
                                          $query->where('role', 'supplier')
                                              ->orWhere('role', 'both');
                                      })->paginate(SettingsController::MAX_PAGINATE);

            $pagetitle = "Suppliers List";

            return view('publicview.catsuppliersearch', compact('suppliers', 'pagetitle', 'categories', 'data', 'productcount', 'suppliercount', 'buyercount'));

        }
        else if ($search_type == 'Buyers')
        {
            $products = Buyproduct::whereIn('category', $ids)
                                  ->where('approved',1)
                                  ->whereIn('user', $approved_users)
                                  ->paginate(SettingsController::MAX_PAGINATE);

            $pagetitle = "Buyers List";

            return view('publicview.catbuyersearch', compact('products', 'pagetitle', 'categories', 'data', 'productcount', 'suppliercount', 'buyercount'));
        }
    }
}
