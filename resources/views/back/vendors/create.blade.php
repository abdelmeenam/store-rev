@extends('back.layouts.dashboard')

@section('title', 'Create Vendor')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Vendors</li>
@endsection

@section('content')

    <form action="{{ route('dashboard.vendors.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('back.vendors._form' ,['button' => 'Add vendors'])
    </form>


@endsection
