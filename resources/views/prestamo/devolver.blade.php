@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Devolución del libro {{ $libro->nombre }}</h2>
            </div>        
        </div>
    </div>    
 
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
@endif

<div class="row col-10">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Detalles del libro {{ $libro->nombre }} </h2>
            </div>
        </div>
    </div>
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
                {{ $libro->categoria->nombre }}
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
</div>

<div class="row col-10">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Detalles del prestamo </h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Usuario:</strong>
                {{ $user->name }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Fecha Plazo:</strong>
                {{  date_format(new DateTime($prestamo->fecha_plazo), "d-m-Y"); }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Fecha Entrega:</strong>
                {{ date("d-m-Y"); }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Fecha Pedido:</strong>
                {{ date_format(new DateTime($prestamo->created_at), "d-m-Y"); }}
            </div>
        </div>
    </div>
    
</div>

<div class="row text-center">
    @if ($tieneRetraso == true)
        <div class="row col-6">
            <div class="alert alert-danger">
                <p>Tienes un retraso de {{ $prestamo->retraso }} días, se te aplicarán intereses</p>
            </div>
        </div>
        
    @endif

    <form class="d-inline-block" action="{{ route('prestamos.update',$prestamo->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" value="{{ date("Y-m-d") }}" name="fecha_entrega">
        <button type="submit" class="btn btn-sm btn-danger">Aplicar Devolucion</button>
    </form>
    <div class="d-inline-block">
        <a class="btn btn-sm btn-danger" href="{{ url('/') }}">Cancelar</a>
    </div>
    
</div>
@endsection
