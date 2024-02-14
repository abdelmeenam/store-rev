@extends('back.layouts.dashboard')

@section('title', 'Edit Vendor')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">vendors</li>
@endsection
@section('content')

    <form action="{{ route('dashboard.vendors.update' , $vendor->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        @include('back.vendors._form' , ['button' => 'Update vendor'])
    </form>

@endsection
