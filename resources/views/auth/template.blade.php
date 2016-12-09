@extends('layouts.template')
@section('content')
    <div class="main-interface">
        @yield('side-bar')
        @yield('main_content')
    </div>
@endsection
@push('javascript')
<script type="text/javascript" src="{{ URL::asset('js/util/sidebar.js') }}"></script>
@endpush