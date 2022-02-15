@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Libros</h2>
            </div>        
        </div>
    </div>    
 
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
@endif    
 
<table class="table table-bordered">
        <tr>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Editorial</th>
            <th>Imagen</th>
        </tr>
        @foreach ($libros as $libro)
        <tr>
            
            <td>{{ $libro->nombre }}</td>
            <td>{{ $libro->categoria_id }}</td>
            <td>{{ $libro->editorial }}</td>
            <td><img src="{{ $libro->imagen }}" alt="Libro"></td>
            <td class="text-center">
                <a class="btn btn-sm btn-info" href="{{ route('libros.show',$libro->id) }}">Mostrar</a>
                @if(@Auth::user()->hasRole('administrador'))
                    <a class="btn btn-sm btn-primary" href="{{ route('libros.edit',$libro->id) }}">Editar</a>
                    <form class="d-inline-block" action="{{ route('libros.destroy',$libro->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                    </form>
                @endif
                
                @if(@Auth::user()->hasRole('usuario'))
                    <a class="btn btn-sm btn-primary" href="{{ url('prestamo',$libro->id) }}">Prestar</a>
                @endif
                
            </td>
        </tr>
        @endforeach
    </table>  
@endsection
