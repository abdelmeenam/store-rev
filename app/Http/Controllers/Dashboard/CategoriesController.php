<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Storage;


class CategoriesController extends Controller
{
    private $categories;


    public function __construct()
    {
        $this->categories = Category::all();
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // SEARCH METHOD [1]
        // $categoryBuilder = Category::query();               // query builder of category model
        // if ($name = $request->query('name')) {      // value from query parameters
        //     $categoryBuilder->where('name', 'LIKE', '%'. $name. '%');
        // }
        // if ($status = $request->query('status')) {
        //     $categoryBuilder->whereStatus( $status);
        // }
        // $categories = $categoryBuilder->paginate(4);

        // SEARCH METHOD [2]
        // select a.*  , b.name as parent_name from categories as a left join categories as b on b.id = a.parent_id
        // $categories = Category::leftjoin('categories as parents' , 'parents.id' , '=' , 'categories.parent_id')
        // ->select(['categories.*', 'parents.name as parent_name'])
        // ->Filter($request->query())
        // ->latest()
        // ->paginate(5);

        // SEARCH METHOD [3]
        $categories = Category::with('parent')
        ->withCount('products')
        ->Filter($request->query())
        ->paginate(5);



        // SCOPES USAGE
        // $activeCategoriesCount = Category::active()->count();
        // $categories = Category::status('archived')->count();
        return view('back.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = $this->categories;
        $category = new Category();
        return view('back.categories.create', compact('parents', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $request->merge(['slug' => Str::slug($request->name)]);

        // Upload image
        $data = $request->except('image');
        $path = $this->uploadImage($request);
        $data['image'] = $path;

        $category = Category::create($data);
        return redirect()->route('dashboard.categories.index')->with('success', 'category created successfuly');
    }


    /**
     * Upload image to storage and return path
     * @param Request $request
     * @return false|string|void
     */
    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('image')) {
            return;
        }
        $file = $request->file('image');
        $path = $file->Store('uploads', ['disk' => 'public']);
        return $path;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->route('dashboard.categories.index')->with('info', 'category not found');
        }

        //Select * from categories WHERE $id =! 'id' AND ( $id != 'parent_id' OR  parent_id !== NULL )
        $parents = Category::where('id', '<>', $id)
            ->where(function ($query) use ($id) {
                $query->whereNULL('parent_id')->orWhere('parent_id', '<>', $id);
            })->get();
        return view('back.categories.edit', compact('category', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = Category::where('id', $id)->first();
        $request->merge(['slug' => Str::slug($request->name)]);

        // Upload image
        $oldImage = $category->image;
        $data = $request->except('image');
        $newImagePath = $this->uploadImage($request);

        if ($newImagePath) {
            $data['image'] = $newImagePath;
        }

        $category->update($data);

        //Delete the old image
        if ($oldImage && $newImagePath) {
            Storage::disk('public')->delete($oldImage);
        }
        return redirect()->route('dashboard.categories.index')->with('success', 'category updated successfuly');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // category has many products
        // each product belongs to a store
        return view('back.categories.show', ['category' => $category]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return  redirect()->route('dashboard.categories.index')->with('success', 'category deleted successfuly');
    }



    public function trash(Request $request)
    {
        $categories = Category::onlyTrashed()->paginate(2);
        return view('back.categories.trash', compact('categories'));
    }

    public function restore(Request $request , $id){
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        return redirect()->route('dashboard.categories.trash')->with('success', 'category restored successfuly');
    }


     public function forceDelete($id){
        $category = Category::onlyTrashed()->findOrFail($id);
        Storage::disk('public')->delete($category->image);
        $category->forceDelete();
        return redirect()->route('dashboard.categories.trash')->with('success', 'category force deleted successfuly');
    }

}
