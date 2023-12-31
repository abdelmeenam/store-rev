@extends('back.layouts.dashboard')
@section('title', 'All products ')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a>Products</a></li>
@endsection

@section('content')
        <div class="mb-5">
                <a href="{{ route('dashboard.products.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
            <a href="{{ route('dashboard.products.trash') }}" class="btn btn-sm btn-outline-dark mr-2">Trash</a>
        </div>
        <!-- Display Alert  components-->
        <x-alert type="info"/>
        <x-alert type="success"/>

        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>name</th>
                <th>category</th>
                <th>store</th>
                <th>description</th>
                <th>image</th>
                <th>price</th>
                <th>rating</th>
                <th>status</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><a href="{{ route('dashboard.products.show', $product->id) }}">{{ $product->name }}</a></td>
                    {{-- <td>{{ $product->category_id }}</td> --}}
                    {{-- <td>{{ $product->store_id }}</td> --}}
                    <td>{{ $product->category->name }}</td>     {{-- (select * from categories where id =$product->category_id) --}}
                    <td>{{ $product->store->name }}</td>       {{-- (select * from stores where id =$product->store_id) --}}
                    <td>{{ $product->description }}</td>
                    <td><img src="{{ asset('storage/' . $product->image) }}" alt="" height="50"></td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->rating }}</td>
                    <td>{{ $product->status }}</td>
                    <td>
                        <a href="{{ route('dashboard.products.edit', $product->id) }}"
                           class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                            <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post">
                                @csrf
                                <!-- Form Method Spoofing -->
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No products defined.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

            {{ $products->withQueryString()->links() }}
@endsection

