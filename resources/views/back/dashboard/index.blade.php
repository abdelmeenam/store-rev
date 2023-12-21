@extends('back.layouts.dashboard')

@section('title', 'Dashboard Data')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active"><a>dashboard data</a></li>
@endsection


@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="m-0">Dashboard</h5>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <!-- DataTables -->
{{--    <link rel="stylesheet" href="{{ asset('testttttttttttt') }}">--}}
@endpush
@push('scripts')
    <!-- DataTables -->
{{--    <script src="{{ asset('testttttttttttt') }}"></script>--}}
@endpush
