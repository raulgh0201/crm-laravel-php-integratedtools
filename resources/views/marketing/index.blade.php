@extends('marketing.layouts.app')

@section('title') Dashboard @endsection
@section('left-menu')

    @include('marketing.layouts.menus.sidebar')

@endsection

@section('content')

    @include('marketing.layouts.crm.dashboard')

@endsection