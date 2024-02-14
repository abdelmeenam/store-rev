@extends('back.layouts.dashboard')
@section('title', 'All vendors ')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a>vendors</a></li>
@endsection

@section('content')

        <div class="mb-5">
            <a href="{{ route('dashboard.vendors.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
            <a href="{{ route('dashboard.vendors.trash') }}" class="btn btn-sm btn-outline-dark mr-2">Trash</a>
        </div>

        <!-- Display Alert  components-->
        <x-alert type="info"/>
        <x-alert type="success"/>

        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>name</th>
                <th>email</th>
                <th>phone</th>
                <th>active</th>
                <th>store</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($vendors as $vendor)
                <tr>
                    <td>{{ $vendor->id }}</td>
                    <td><a href="{{ route('dashboard.vendors.show', $vendor->id) }}">{{ $vendor->name }}</a></td>
                    <td>{{ $vendor->email }}</td>
                    <td>{{ $vendor->phone }}</td>
                    <td>{{ $vendor->status }}</td>
                    <td>{{ $vendor->store->name }}</td>
                    <td>
                    <td>
                        <a href="{{ route('dashboard.vendors.edit', $vendor->id) }}"
                           class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                            <form action="{{ route('dashboard.vendors.destroy', $vendor->id) }}" method="post">
                                @csrf
                                <!-- Form Method Spoofing -->
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No vendors defined.</td>
                </tr>
            @endforelse
            </tbody>
        </table>

            {{ $vendors->withQueryString()->links() }}
@endsection

