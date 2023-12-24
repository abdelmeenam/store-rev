@extends('back.layouts.dashboard')

@section('title', 'Trashed Categories ')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item "><a>categories</a></li>
    <li class="breadcrumb-item active"><a>Trashed</a></li>
@endsection

@section('content')
        <div class="mb-5">
                <a href="{{ route('dashboard.categories.index') }}" class="btn btn-sm btn-outline-primary mr-2">Back</a>
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
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>

                    <td><img src="{{ asset('storage/' . $category->image) }}" alt="" height="50"></td>
                    <td><a href="{{ route('dashboard.categories.show', $category->id) }}">{{ $category->name }}</a></td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->deleted_at }}</td>

                    <td>
                        <form action="{{ route('dashboard.categories.restore', $category->id) }}" method="post">
                            @csrf
                            @method('put')
                            <button type="submit" class="btn btn-sm btn-outline-danger">restore</button>
                        </form>
                    </td>

                    <td>
                            <form action="{{ route('dashboard.categories.force-delete', $category->id) }}" method="post">
                                @csrf
                                <!-- Form Method Spoofing -->
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No categories defined.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

        {{ $categories->withQueryString()->links() }}
@endsection

