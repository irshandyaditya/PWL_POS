@extends('layout.app')

{{-- Customize Layout Sections --}}

@section('subtitle', 'welcome')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content Body: Main page content --}}

@section('content_body')
    <p>Welcome to this beautiful admin panel.</p>
@stop

{{--  Push Extra CSS --}}

@push('css')
    {{--- add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@endpush