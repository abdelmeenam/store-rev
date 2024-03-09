<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Store;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isNull;

class StoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stores  = Store::with(['products'])->paginate(7);
        return view('back.stores.index', compact('stores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $store = new Store();
        return view('back.stores.create', compact('store'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge(['slug' => Str::slug($request->name)]);

        // Upload image
        $data = $request->except('logo_image');
        $path = $this->uploadImage($request);
        $data['logo_image'] = $path;
        $store = Store::create($data);
        return redirect()->route('dashboard.stores.index')->with('success', 'store created successfuly');
    }


    /**
     * Upload image to storage and return path
     * @param Request $request
     * @return false|string|void
     */
    protected function uploadImage(Request $request)
    {
        if (!$request->hasFile('logo_image')) {
            return;
        }
        $file = $request->file('logo_image');
        $path = $file->Store('uploads/stores', ['disk' => 'public']);
        return $path;
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Store = Store::findOrFail($id);
        $Store->delete();
        return  redirect()->route('dashboard.stores.index')->with('success', 'Store deleted successfuly');
    }



    public function trash(Request $request)
    {
        $stores = Store::onlyTrashed()->paginate(2);
        return view('back.stores.trash', compact('stores'));
    }

    public function restore(Request $request, $id)
    {
        $store = Store::onlyTrashed()->findOrFail($id);
        $store->restore();
        return redirect()->route('dashboard.stores.trash')->with('success', 'Store restored successfuly');
    }


    public function forceDelete($id)
    {
        $store = Store::onlyTrashed()->findOrFail($id);
        !isNull($store->logo_image) ?? Storage::disk('public')->delete($store->logo_image);
        $store->forceDelete();
        return redirect()->route('dashboard.stores.trash')->with('success', 'Store force deleted successfuly');
    }
}