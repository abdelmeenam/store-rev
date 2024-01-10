<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$products  = Product::paginate(5);
        $products  = Product::with(['category' , 'store'])->paginate(6);

        return view('back.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        $tags = new Product();
        $categories = Category::all();

        return view('back.products.create'  , compact('product' , 'categories' , 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $tags = implode(',', $product->tags()->pluck('name')->toArray());
        $categories = Category::all();
        return view('back.products.edit', compact('product' , 'categories' , 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->except('tags'));
        //$tags = explode(',', $request->post('tags'));
        $tags = json_decode($request->post('tags'));   //array of objects
        $tagsData = Tag::all();


        foreach ($tags as $t_name) {
            //$slug = Str::slug($t_name);
            $slug = Str::slug($t_name->value);      //access object
            $tag = $tagsData->where('slug' , $slug)->first();
            if (!$tag ) {
                $tag = Tag::create(['name'=>$t_name->value, 'slug'=>$slug]);
            }
            $tag_ids[] = $tag->id;
        }
        $product->tags()->sync($tag_ids);
        return  redirect()->route('dashboard.products.index')->with('success', 'product updated successfuly');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return  redirect()->route('dashboard.products.index')->with('success', 'product deleted successfuly');
    }

    public function trash(Request $request)
    {
        $products = Product::onlyTrashed()->paginate(2);
        return view('back.products.trash', compact('products'));
    }

    public function restore(Request $request , $id){
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        return redirect()->route('dashboard.products.trash')->with('success', 'product restored successfuly');
    }


     public function forceDelete($id){
        $product = Product::onlyTrashed()->findOrFail($id);
        Storage::disk('public')->delete($product->image);
        $product->forceDelete();
        return redirect()->route('dashboard.products.trash')->with('success', 'product force deleted successfuly');
    }
}
