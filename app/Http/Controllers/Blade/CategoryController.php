<?php

namespace App\Http\Controllers\Blade;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // list of categories
    public function index()
    {
        $categories = Category::with('parent')->get()->all();
        //dd($categories);
        return view('pages.category.index',compact('categories'));
    }

    // add category page
    public function add()
    {
        $categories = Category::all();
        return view('pages.category.add', compact('categories'));
    }

    //create category
    public function create(Request $request)
    {
        //$request->get('parent_id')

        if($request->parent_id)
        {
            $category = Category::find($request->parent_id);
            $category->has_subcategory = 1;
            $category->save();
        }
        Category::create([
            'name_uz'           => $request->get('name_uz'),
            'name_ru'           => $request->get('name_ru'),
            'parent_id'         => $request->get('parent_id')
        ]);

        return redirect()->route('categoryIndex');
    }

    // edit page
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::all();
        return view('pages.category.edit',compact('category', 'categories'));
    }

    // update data
    public function update(Request $request,$id)
    {
        //dd($request);
        $categories = Category::find($id);

        if($request->parent_id != $request->old_parent_id)
        {

            if($request->parent_id)
            {
                $category = Category::find($request->parent_id);
                $category->has_subcategory = 1;
                $category->save();
            }

            if($request->old_parent_id)
            {
                $oldCategory = Category::where('parent_id', '=', $request->old_parent_id)->count();
                if($oldCategory == 1)
                {
                    $oldCategory = Category::find($request->old_parent_id);
                    $oldCategory->has_subcategory = 0;
                    $oldCategory->save();
                }
            }
        }

        $categories->name_uz             = $request->get('name_uz');
        $categories->name_ru             = $request->get('name_ru');
        $categories->parent_id           = $request->get('parent_id');
        $categories->save();

        return redirect()->route('categoryIndex');
    }

    // delete permission
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back();
    }

    //show jowi products
    public function jowiProducts()
    {
        $products = $this->getAllfromJowi();
        $count = 1;
        return view('pages.jowi.index',compact('products', 'count'));
    }

    //get category and products from jowi
    static public function getAllfromJowi()
    {
        $curl = curl_init();
        //85c8822d-e299-488c-83fe-1a2b424237ee
        //854f78c8-1a19-42c7-bfcf-31428411bd82 ozone
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.jowi.club/v010/restaurants/85c8822d-e299-488c-83fe-1a2b424237ee?api_key=ox8jP4iknSPuJMHPkNK2G1gUINF1UoJ12k-v3d46&sig=3388b62f0330d80',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        $responses = json_decode($response,true);
        curl_close($curl);
        //dd($responses);
        //return $response;

        $jowiProducts = [];

        foreach ($responses['categories'] as $category):
            foreach ($category['courses'] as $product):
                $id = $product['id'];
                $check = Product::where('jowiid',$id)
                    ->get();
                if(!sizeof($check))
                {
                    if($product['price'] != 0)
                    {
                        $jowiProducts [] = [
                            'id' => $product['id'],
                            'title' => $product['title'],
                            'price' => $product['price_for_online_order'],
                            'category' => $category['title']
                        ];
                    }

                }
            endforeach;
        endforeach;

        return $jowiProducts;
    }
}
