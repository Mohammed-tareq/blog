@extends('layouts.admin.app')

@section('title')
    Home
@endsection
@section('content')
    <!-- Transactions -->
    @livewire('admin.statistcs')
    <!--/ Transactions -->

    {{--     Weekly Overview Chart --}}
    <div class="row">

        <div class="col-md-6 mb-4">
            <div class="card">

                <div class="card">
                    <h3 class="m-3">Posts Growth</h3>
                    {!! $monthPosts->container() !!}
                </div>


            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card">

                <div class="card">
                    <h3 class="m-3">Users Growth</h3>
                    {!! $monthUsers->container() !!}
                </div>


            </div>
        </div>
    </div>
    <div class="col-md-12 mb-4">
        <div class="card">

            <div class="card">
                <h3 class="m-3">System Growth</h3>
                {!! $allSystem->container() !!}
            </div>

        </div>
    </div>

    {{--    / Weekly Overview Chart --}}

    {{--    tables home posts and comments--}}
    @livewire('admin.last-posts-comments')
    {{--  /  tables home posts and comments--}}

@endsection

@push('js')
    <script src="{{ $monthPosts->container() }}"></script>
    {{ $monthPosts->script() }}

    <script src="{{ $monthUsers->container() }}"></script>
    {{ $monthUsers->script() }}

    <script src="{{ $allSystem->container() }}"></script>
    {{ $allSystem->script() }}
@endpush