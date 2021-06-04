@extends('ventas.layouts.app')

@section('title') Dashboard @endsection
@section('left-menu')

    @include('ventas.layouts.menus.sidebar')

@endsection

@section('content')

    @include('ventas.layouts.crm.dashboard')
    <!--@livewire("chat-form")-->
   <!-- @livewire("chat-list")-->


@endsection