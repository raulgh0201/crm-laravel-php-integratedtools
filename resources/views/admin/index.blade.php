@extends('admin.layouts.app')

@section('title') Dashboard @endsection
@section('left-menu')

    @include('admin.layouts.menus.sidebar')

@endsection

@section('content')

    @include('admin.layouts.crm.dashboard')

@endsection