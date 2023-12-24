@extends('back.layouts.dashboard')

@section('title', 'All Categories ')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a>categories</a></li>
@endsection


@section('content')
        <div class="mb-5">
                <a href="{{ route('dashboard.categories.create') }}" class="btn btn-sm btn-outline-primary mr-2">Create</a>
            <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-sm btn-outline-dark mr-2">Trash</a>
        </div>


        <!-- Display Alert  components-->
        <x-alert type="info"/>
        <x-alert type="success"/>

        <!-- Search component  -->
        <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
            <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')" />
            <select name="status" class="form-control" class="mx-2">
                <option value="">Select Status</option>
                <option value="active" @selected( request('status')=='active' ) >Active</option>
                <option value="archived" @selected( request('status')=='archived' )>Archived</option>
            </select>
            <button class="btn btn-dark mx-2">Filter</button>
        </form>



        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Name</th>
                <th>Parent Category</th>
                <th># of Products </th>
                <th>Status</th>
                <th>Created At</th>
                <th colspan="2">Action</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>

                    <td><img src="{{ asset('storage/' . $category->image) }}" alt="" height="50"></td>
                    <td><a href="{{ route('dashboard.categories.show', $category->id) }}">{{ $category->name }}</a></td>
                    <td>{{ $category->parent_name ?? 'Primary' }}</td>
                    <td>{{ $category->products_count }}</td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->created_at }}</td>

                    <td>
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                           class="btn btn-sm btn-outline-success">Edit</a>
                    </td>
                    <td>
                            <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
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

