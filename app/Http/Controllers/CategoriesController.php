<?php namespace App\Http\Controllers;


use DB;
use Request;
use App\Category;
use App\CategoryImage;
use App\CategoryOrder;
use Intervention\Image\Facades\Image;

class CategoriesController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function getCreate()
    {
        $categories = Category::where('level', '1')->get();
        
        return view('userview.category-create', compact('categories'));
    }

    public function postCreate()
    {
        $input = Request::all();

        if ($input['level'] == 1) {

            if(array_key_exists('image', $input))
            {
                $imagelink = $this->get_image_path($input['image']);
            }
            else
            {
                $imagelink = 'images/common-placeholder.jpg';
            }

            //Insert into Category Table
            $cat_id = Category::insertGetId([
                    'name' => $input['name'],
                    'parent' => 0,
                    'level' => $input['level']
                ]);

            //Insert into Category Image Table
            CategoryImage::insert([
                'category_id' => $cat_id,
                'image' => $imagelink
            ]);

            //Insert into Category Order table
            $max_order = CategoryOrder::max('order');

            CategoryOrder::insert([
                    'category_id' => $cat_id,
                    'order' => $max_order+1
                ]);

        } else if ($input['level'] == 2) {

            Category::insert([
                'name' => $input['name'],
                'parent' => $input['parent'],
                'level' => $input['level']
            ]);
        }

        return redirect('category/create')->with('success', 'New Category Created Successfully');
    }

    public function postUpdate()
    {
        $input = Request::all();

        $category = Category::find($input['id']);

        $category->name = $input['cat_name'];

        $category->save();

        if(array_key_exists('cat_image', $input))
        {
            $cat_image = CategoryImage::find($input['id']);
            $cat_image->image = $this->get_image_path($input['cat_image']);
            $cat_image->save();
        }

        return redirect('category/list')->with('success', 'Category Updated Successfully');
    }

    public function postDelete()
    {
        $cat_id = Request::input('cat_id');

        //Delete from Category Image Table
        CategoryImage::where('category_id',$cat_id)->delete();

        //Delete from Category Order Table
        $deleted_order = CategoryOrder::where('category_id',$cat_id)->value('order');
        CategoryOrder::where('category_id',$cat_id)->delete();

        //Re-order categories
        DB::update("UPDATE `category_orders` SET `order`= `order` - 1 WHERE `order` > ".$deleted_order);

        //Delete from Category Table
        Category::destroy($cat_id);

        return redirect('category/list')->with('success', 'Category Deleted Successfully');
    }

    //Custom Sorting Function
    function cmp($a, $b)
    {
        return strcmp($a->order, $b->order);
    }

    //Get Category List
    public function getList()
    {
        $categories = CategoryOrder::orderBy('order')->paginate(SettingsController::MAX_PAGINATE);

        foreach ($categories as $category) {

            $cat = Category::where('id',$category->category_id)->first();

            $category->id = $category->category_id;
            $category->name = $cat->name;

            $category->featured = CategoryImage::where('category_id',$category->id)->value('featured');

            $category->subcategory = Category::where('parent', $category->id)->get();
            $category->image = CategoryImage::where('category_id',$category->id)->value('image');
        }

        return view('userview.category-list', compact('categories'));
    }

    //Get Sub-Category List
    public function getSubCategory()
    {
        $categories = Category::where('level', '>', '1')->paginate(SettingsController::MAX_PAGINATE);

        $main_categories = Category::where('level', '1')->get();

        foreach ($categories as $category) {
            $cat_parent = $category->parent;

            $category->parent_name = Category::where('id',$cat_parent)->value('name');

            $category->subcategory = Category::where('parent', $category->id)->get();

        }

        return view('userview.sub-category-list', compact('categories','main_categories'));
    }


    //Update Sub-category
    public function postUpdateSub()
    {
        $id = Request::input('id');

        $category = Category::find($id);

        $category->name = Request::input('cat_name');

        $category->parent = Request::input('parent_cat');

        $category->save();

        return redirect('category/sub-category')->with('success', 'Sub-Category Updated Successfully');
    }

    //Delete Sub-category
    public function postDeleteSub()
    {
        $cat_id = Request::input('cat_id');

        //Delete from Category Table
        Category::destroy($cat_id);

        return redirect('category/sub-category')->with('success', 'Sub-Category Deleted Successfully');
    }


    private function get_image_path($image)
    {
        $path = 'images/category/'; //need relative path, not absolute
        $image_name = time() . $image->getClientOriginalName();
        $image_path = $path . $image_name;
        Image::make($image)->resize(300, 200)->save($image_path);
        return $image_path;
    }


    public function postReorder()
    {
        $cat_id = Request::input('id');
        $cat_new_pos = Request::input('order');

        $cat_current_pos = CategoryOrder::where('category_id',$cat_id)->value('order');

        DB::update("UPDATE `category_orders` SET `order`= `order` - 1 WHERE `order` > ".$cat_current_pos);


        DB::update("UPDATE `category_orders` SET `order`= `order` + 1 WHERE `order` >= ".$cat_new_pos);


        CategoryOrder::where('category_id',$cat_id)->update([
                                                        'order' => $cat_new_pos
                                                    ]);
        return redirect('category/list')->with('success', 'Category Re-ordered Successfully');
    }


    public function postMakefeatured()
    {
        if(Request::ajax())
        {
            $c_id = Request::input('cat_id');
            $checked = Request::input('status');

            if($checked == 'true')
                $status = 1;
            else
                $status = 0;

            CategoryImage::where('category_id',$c_id)->update([
                                            'featured' => $status
                                        ]);
            return true;
        }
    }

}
