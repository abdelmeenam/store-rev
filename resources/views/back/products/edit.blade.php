@extends('back.layouts.dashboard')

@section('title', 'Edit Product')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">categories</li>
@endsection
@section('content')

    <form action="{{ route('dashboard.products.update' , $product->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('back.products._form' , ['button' => 'Update Product'])
    </form>

@endsection
