@extends('layouts.template')
@section('content')
@yield('side-bar')
@yield('main_content')
@endsection
@push('javascript')
    <script type="text/javascript" src="{{ URL::asset('js/util/sidebar.js') }}"></script>
@endpush