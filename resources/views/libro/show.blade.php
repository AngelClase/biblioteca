@extends('layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Detalles del libro {{ $libro->nombre }} </h2>
            </div>        </div>
    </div>
    <!--ADMIN -->
    @if(@Auth::user()->hasRole('administrador'))
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ID:</strong>
                {{ $libro->id }}
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>ISBN:</strong>
                {{ $libro->isbn }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nombre:</strong>
                {{ $libro->nombre }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Categoria:</strong>
                {{ $libro->categoria_id }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Editorial:</strong>
                {{ $libro->editorial }}
            </div>
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Imagen:</strong>
            <img src="/uploads/{{ $libro->imagen }}" width="200px">
        </div>
    </div>
    <div class="row">
        <a class="btn btn-sm btn-info" href="{{ route('libros.index') }}">Back</a>
    </div>
@endsection
