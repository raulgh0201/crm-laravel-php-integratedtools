@extends('admin.layouts.app')
@section('title') Prospectos @endsection

@section('left-menu')

    @include('admin.layouts.menus.sidebar')

@endsection

@section('content')
@if (count($errors) > 0)

<div class="row">
    <div class="col-12">
        <div class="alert alert-danger alert-dismissable fade show" role="alert">
            <strong>Hay un error en tu formulario!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
    
@endif

<div class="row">
    <button class="btn btn-success btn-sm" id="add-prospect-btn">Añadir Prospecto</button>
</div>
    <div class="row"> 
        @foreach ($prospects as $prospect)
            <div class="col-md-3 offset-md-2">
                <a href="{{ route('admin.prospect', ['id' => $prospect->id]) }}" style="text-decoration: none; color: black">                    
                    <div class="card mt-3">
                        <div class="card-header">
                            {{ $prospect->name }}
                        </div>
                        <div class="card-body">
                            <h6>Numero: {{ $prospect->phone }}</h6>
                            <h6>Email: {{ $prospect->email }}</h6>
                        </div>
                    </div>                    
                </a>
            </div>
        @endforeach
    </div>
    {{-- /.row --}}
    <div class="row mt-5">
        <div class="col-md-6 offset-md-4">
            <div class="" style="margin: 0 auto;">
                {{ $prospects->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>

    {{-- Modals --}}
    
    
@endsection
@push('admin.layouts.scripts.scripts')
    <script src="{{ asset('js/admin/prospects.js') }}"></script>
@endpush