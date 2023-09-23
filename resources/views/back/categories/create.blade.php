@extends('back.layouts.dashboard')

@section('title', 'Create Category')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">categories</li>
@endsection

@section('content')

    <form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('back.categories._form' ,['button' => 'Add category'])
    </form>

@endsection
