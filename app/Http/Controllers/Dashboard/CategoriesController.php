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
    public function index()
    {
        $categories = $this->categories;
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        //delete image
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }
        return  redirect()->route('dashboard.categories.index')->with('success', 'category deleted successfuly');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('back.categories.show', ['category' => $category]);
    }
}
