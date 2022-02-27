@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Añadir Nueva Sancion</h2>
        </div>    
</div>
</div>
 
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('sancion.store') }}" method="POST" enctype="multipart/form-data">
@csrf     
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Usuario ID:</strong>
                <input type="text" name="user_id" value="{{ $prestamo->user_id }}" class="form-control" readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Fecha de inicio :</strong>
                <input type="text" name="" value="{{ date("d-m-Y"); }}" class="form-control" readonly>
                <input type="hidden" name="fecha_inicio" value="{{ date("Y-m-d"); }}" class="form-control">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Retraso:</strong>
                <input type="text" name="retraso" value="{{ $prestamo->retraso }}" class="form-control" readonly>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Crear sanción</button>
        </div>
    </div>
</form>
@endsection