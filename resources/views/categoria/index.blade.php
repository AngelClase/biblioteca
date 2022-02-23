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

@guest

@else
    @if(@Auth::user()->hasRole('administrador'))
        <div class="row col-2">
            <a class="btn btn-sm btn-primary" href="{{ route('categorias.create') }}">Crear Libro</a>
        </div>
        
    @endif
@endguest
<table class="table table-bordered">
        <tr>
            <th>Nombre</th>
            <th>Categoria</th>
            <th>Editorial</th>
            <th>Imagen</th>
        </tr>
        @foreach ($categorias as $categoria)
        <tr>
            
            <td>{{ $categoria->nombre }}</td>

            <td class="text-center">
                <a class="btn btn-sm btn-info" href="{{ route('categorias.show',$libro->id) }}">Mostrar</a>
                @guest
                    
                @else
                    @if(@Auth::user()->hasRole('administrador'))
                        <a class="btn btn-sm btn-primary" href="{{ route('ca.edit',$libro->id) }}">Editar</a>
                        <form class="d-inline-block" action="{{ route('libros.destroy',$libro->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                        </form>
                    @endif
                    
                    
                @endguest
                
            </td>
        </tr>
        @endforeach
    </table>  
@endsection
