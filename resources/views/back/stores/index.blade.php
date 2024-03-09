@extends('back.layouts.dashboard')
@section('title', 'All Stores ')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a>Stores</a></li>
@endsection

@section('content')
        <div class="mb-5">
                <a href="{{ route('dashboard.stores.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
            <a href="{{ route('dashboard.stores.trash') }}" class="btn btn-sm btn-outline-dark mr-2">Trash</a>
        </div>
        <!-- Display Alert  components-->
        <x-alert type="info"/>
        <x-alert type="success"/>

        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>name</th>
                <th>description</th>
                <th>logo_image</th>
                <th>cover_image</th>
                <th>status</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($stores as $store)
                <tr>
                    <td>{{ $store->id }}</td>
                    <td><a href="{{ route('dashboard.stores.show', $store->id) }}">{{ $store->name }}</a></td>
                    <td>{{ $store->description }}</td>
                    <td><img src="{{ $store->ImageUrl}}" alt="" height="50"></td>
                    <td><img src="{{ asset('storage/' . $store->cover_image) }}" alt="" height="50"></td>
                    <td>{{ $store->status }}</td>
                    <td>
                        <a href="{{ route('dashboard.stores.edit', $store->id) }}"
                           class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                            <form action="{{ route('dashboard.stores.destroy', $store->id) }}" method="post">
                                @csrf
                                <!-- Form Method Spoofing -->
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No stores defined.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

            {{ $stores->withQueryString()->links() }}
@endsection

