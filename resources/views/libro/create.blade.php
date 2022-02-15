@extends('layout')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Añadir Nuevo Libro</h2>
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
 
<form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
@csrf     
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>ISBN:</strong>
            <input type="text" name="isbn" value="" class="form-control" placeholder="XXX-X-XXXXXX-XX-X">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Nombre:</strong>
            <input type="text" name="nombre" value="" class="form-control" placeholder="Nombre del Libro">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Categoria:</strong>
            <input type="text" name="categoria_id" value="" class="form-control" placeholder="Nombre de la categoria">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Editorial:</strong>
            <input type="text" name="editorial" value="" class="form-control" placeholder="Nombre de la editorial">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Imagen:</strong>
            <input type="file" name="imagen" class="form-control" placeholder="Imagen del libro">
        </div>
    </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Añadir Libro</button>
        </div>
    </div>
</form>
@endsection