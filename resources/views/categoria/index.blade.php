@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2 class="text-center">Categorias</h2>
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
        <div class="row">
            <div class="col-5"></div>
            <div class="col-2">
                <a class="btn btn-sm btn-primary" href="{{ route('categoria.create') }}">Crear Categoria</a>
            </div>
            <div class="col-4"></div>
        </div>
        <br>
    @endif
@endguest
<div class="row">
    <div class="col-4"></div>
    <div class="col-4">
        <table class="table table-bordered">
            <tr>
                <th>Nombre</th>
            </tr>
            @foreach ($categorias as $categoria)
            <tr>
                
                <td>{{ $categoria->nombre }}</td>
    
                <td class="text-center">
                    <a class="btn btn-sm btn-info" href="{{ route('categoria.show',$categoria->id) }}">Mostrar Libros</a>
                    @guest
                        
                    @else
                        @if(@Auth::user()->hasRole('administrador'))
                            <a class="btn btn-sm btn-primary" href="{{ route('categoria.edit',$categoria->id) }}">Editar</a>
                            <form class="d-inline-block" action="{{ route('categoria.destroy',$categoria->id) }}" method="POST">
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
    </div>
    
    <div class="col-4"></div>
</div>

@endsection
