@extends('layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar Libro de ID {{ $libro->id }}</h2>
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
<form action="{{ route('libros.update',$libro->id) }}" method="POST" enctype="multipart/form-data"> 
        @csrf
        @method('PUT')
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ID:</strong>
                    <input type="text" name="id" value="{{ $libro->id }}" class="form-control" placeholder="{{ $libro->id }}" readonly>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ISBN:</strong>
                    <input type="text" name="isbn" value="{{ $libro->isbn }}" class="form-control" placeholder="XXX-X-XXXXXX-XX-X: {{ $libro->isbn }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Nombre:</strong>
                    <input type="text" name="nombre" value="{{ $libro->nombre }}" class="form-control" placeholder="Nombre del Libro: {{ $libro->nombre }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Categoria:</strong>
                    <input type="text" name="categoria_id" value="{{ $libro->categoria_id }}" class="form-control" placeholder="Nombre de la categoria: {{ $libro->categoria_id }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Editorial:</strong>
                    <input type="text" name="editorial" value="{{ $libro->editorial }}" class="form-control" placeholder="Nombre de la editorial: {{ $libro->editorial }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Imagen:</strong>
                    <input type="file" name="image" class="form-control" placeholder="Imagen">
                    <img src="/uploads/{{ $libro->imagen }}" width="200px">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Actualizar Libro de ID {{ $libro->id }}</button>
            </div>
        </div>
    </form>
@endsection
