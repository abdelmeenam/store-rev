@extends('back.layouts.dashboard')

@section('title', 'Edit Category')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">categories</li>
@endsection
@section('content')

    <form action="{{ route('dashboard.categories.update' , $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('back.categories._form' , ['button' => 'Update category'])
    </form>

@endsection
