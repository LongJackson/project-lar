<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use DB;
use App\Http\Requests\AddProductRequest;
use Auth;
use Session;

class ProductController extends Controller
{
    public function getProduct()
    {
        $data['productList'] = DB::table('vp_products')->join('vp_categories','vp_products.product_category','=','vp_categories.category_id')->orderBy('product_id','desc')->get();
        return view('backend.product', $data);
    }
    public function getAddProduct(){
        $data['categoryList'] = Category::all();
        return view('backend.addproduct', $data);
}
    public function postAddProduct(AddProductRequest $request){
        $filename = $request->img->getClientOriginalName();
        $product = new Product;
        $product->product_name = $request->name;
        $product->product_slug = str_slug($request->name);
        $product->product_image = $filename;
        $product->product_accessories = $request->accessories;
        $product->product_price = $request->price;
        $product->product_warranty = $request->warranty;
        $product->product_promotion = $request->promotion;
        $product->product_condition = $request->condition;
        $product->product_status = $request->status;
        $product->product_description = $request->description;
        $product->product_category = $request->category;
        $product->product_featured = $request->featured;
        $product->save();
        $request->img->storeAs('avatar',$filename);
        Session::flash('alert','Product added');
        return redirect()->intended('admin/product');
    }
    public function getEditProduct($id)
    {
        $data['product'] = Product::find($id);
        $data['categoryList'] = Category::all();
        return view('backend.editproduct', $data);
    }

    public function postEditProduct(Request $request,$id)
    {
        $product = new Product;
        $arr['product_name'] = $request->name;
        $arr['product_slug'] = str_slug($request->name);
        $arr['product_accessories'] = $request->accessories;
        $arr['product_price'] = $request->price;
        $arr['product_warranty'] = $request->warranty;
        $arr['product_promotion'] = $request->promotion;
        $arr['product_condition'] = $request->condition;
        $arr['product_status'] = $request->status;
        $arr['product_description'] = $request->description;
        $arr['product_featured'] = $request->featured;
        $arr['product_category'] = $request->category;
        if($request->hasFile('img')){
            $img = $request->img->getClientOriginalName();
            $arr['product_image'] = $img;
            $request->img->storeAs('avatar'.$img);
        }
        $product::where('product_id',$id)->update($arr);
        Session::flash('alert','Product updated');
        return redirect()->intended('admin/product');
    }

    public function getDeleteProduct($id)
    {
        Product::destroy($id);
        Session::flash('alert','Product removed');
        return back();
    }
}
