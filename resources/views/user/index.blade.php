@extends('user.layouts.app')

@section('title') Dashboard @endsection
@section('left-menu')

    @include('user.layouts.menus.sidebar')

@endsection

@section('content')

    @include('user.layouts.crm.dashboard')

@endsection