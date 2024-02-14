@extends('back.layouts.dashboard')

@section('title', 'Trashed stores ')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item "><a>stores</a></li>
    <li class="breadcrumb-item active"><a>Trashed</a></li>
@endsection

@section('content')
        <div class="mb-5">
                <a href="{{ route('dashboard.stores.index') }}" class="btn btn-sm btn-outline-primary mr-2">Back</a>
        </div>

        <!-- Display Alert  components-->
        <x-alert type="info"/>
        <x-alert type="success"/>

        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>name</th>
                <th>Status</th>
                <th>Deleted At</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($stores as $store)
                <tr>
                    <td>{{ $store->id }}</td>
                    <td><a href="{{ route('dashboard.stores.show', $store->id) }}">{{ $store->name }}</a></td>
                    <td>{{ $store->status }}</td>
                    <td>{{ $store->deleted_at }}</td>

                    <td>
                        <form action="{{ route('dashboard.stores.restore', $store->id) }}" method="post">
                            @csrf
                            {{-- @method('put') --}}
                            <button type="submit" class="btn btn-sm btn-outline-danger">restore</button>
                        </form>
                    </td>

                    <td>
                            <form action="{{ route('dashboard.stores.force-delete', $store->id) }}" method="post">
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

