@extends('back.layouts.dashboard')

@section('title', 'Trashed vendors ')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item "><a>vendors</a></li>
    <li class="breadcrumb-item active"><a>Trashed</a></li>
@endsection

@section('content')
        <div class="mb-5">
                <a href="{{ route('dashboard.vendors.index') }}" class="btn btn-sm btn-outline-primary mr-2">Back</a>
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
            @forelse($vendors as $vendor)
                <tr>
                    <td>{{ $vendor->id }}</td>
                    <td><a href="{{ route('dashboard.vendors.show', $vendor->id) }}">{{ $vendor->name }}</a></td>
                    <td>{{ $vendor->status }}</td>
                    <td>{{ $vendor->deleted_at }}</td>

                    <td>
                        <form action="{{ route('dashboard.vendors.restore', $vendor->id) }}" method="post">
                            @csrf
                            {{-- @method('put') --}}
                            <button type="submit" class="btn btn-sm btn-outline-danger">restore</button>
                        </form>
                    </td>

                    <td>
                            <form action="{{ route('dashboard.vendors.force-delete', $vendor->id) }}" method="post">
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

