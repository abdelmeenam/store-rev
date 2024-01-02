@extends('back.layouts.dashboard')

@section('title', 'Trashed products ')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item "><a>products</a></li>
    <li class="breadcrumb-item active"><a>Trashed</a></li>
@endsection

@section('content')
        <div class="mb-5">
                <a href="{{ route('dashboard.products.index') }}" class="btn btn-sm btn-outline-primary mr-2">Back</a>
        </div>

        <!-- Display Alert  components-->
        <x-alert type="info"/>
        <x-alert type="success"/>

        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Name</th>
                <th>Status</th>
                <th>Deleted At</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($products as $Product)
                <tr>
                    <td>{{ $Product->id }}</td>

                    <td><img src="{{ asset('storage/' . $Product->image) }}" alt="" height="50"></td>
                    <td><a href="{{ route('dashboard.products.show', $Product->id) }}">{{ $Product->name }}</a></td>
                    <td>{{ $Product->status }}</td>
                    <td>{{ $Product->deleted_at }}</td>

                    <td>
                        <form action="{{ route('dashboard.products.restore', $Product->id) }}" method="post">
                            @csrf
                            {{-- @method('put') --}}
                            <button type="submit" class="btn btn-sm btn-outline-danger">restore</button>
                        </form>
                    </td>

                    <td>
                            <form action="{{ route('dashboard.products.force-delete', $Product->id) }}" method="post">
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

