@extends('back.layouts.dashboard')

@section('title', 'Create Product')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">products</li>
@endsection

@section('content')

    <form action="{{ route('dashboard.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('back.products._form' ,['button' => 'Add products'])
    </form>

@endsection
