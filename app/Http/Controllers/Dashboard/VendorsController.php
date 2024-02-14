<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Store;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Vendor\CreateVendorRequest;

class VendorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::with('store')->paginate(5);
        return view('back.vendors.index', compact('vendors'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stores = Store::get();
        $vendor = new Vendor();
        return view('back.vendors.create', compact('stores' , 'vendor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateVendorRequest $request)
    {
        //$data = $request->except('password');
        $validatedData = $request->validated();
        Vendor::create($validatedData);
        return redirect()->route('dashboard.vendors.index')->with('success','Vendor Created Successfully');
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
        $vendor = Vendor::findOrFail($id);
        $stores = Store::get();
        return view('back.vendors.edit', compact('vendor' ,'stores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateVendorRequest $request, Vendor $vendor)
    {
        $vendor->update($request->all());
        return redirect()->route('dashboard.vendors.index')->with('success', 'Vendor updated successfully!');
    }


    public function destroy($id)
    {
        $Vendor = Vendor::findOrFail($id);
        $Vendor->delete();
        return  redirect()->route('dashboard.vendors.index')->with('success', 'Vendor deleted successfuly');
    }

    public function trash(Request $request)
    {
        $vendors = Vendor::onlyTrashed()->paginate(2);
        return view('back.vendors.trash', compact('vendors'));
    }

    public function restore(Request $request , $id)
    {
        $Vendor = Vendor::onlyTrashed()->findOrFail($id);
        $Vendor->restore();
        return redirect()->route('dashboard.vendors.trash')->with('success', 'Vendor restored successfuly');
    }

     public function forceDelete($id)
     {
        $vendor = Vendor::onlyTrashed()->findOrFail($id);
        $vendor->forceDelete();
        return redirect()->route('dashboard.vendors.trash')->with('success', 'Vendor force deleted successfuly');
    }
}
