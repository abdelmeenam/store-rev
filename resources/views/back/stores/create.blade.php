@extends('back.layouts.dashboard')

@section('title', 'Create Store')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Stores</li>
@endsection

@section('content')

    <form action="{{ route('dashboard.stores.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('back.stores._form' ,['button' => 'Add stores'])
    </form>

@endsection
