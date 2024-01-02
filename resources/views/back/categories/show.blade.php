@extends('back.Layouts.dashboard')

@section('title', $category->name.' category')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection

@section('content')

    <table class="table">
        <thead>
        <tr>

            <th>Name</th>
            <th>Image</th>
            <th>Store</th>
            <th>Status</th>
            <th>Created At</th>
        </tr>
        </thead>
        <tbody>
        @php
           $products = $category->products()->with('store')->paginate(4);
        @endphp
        @forelse($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td><img src="{{ asset('storage/' . $product->image) }}" alt="" height="50"></td>
                <td>{{ $product->store->name }}</td>
                <td>{{ $product->status }}</td>
                <td>{{ $product->created_at }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="5">No products defined.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $products->links() }}

@endsection
