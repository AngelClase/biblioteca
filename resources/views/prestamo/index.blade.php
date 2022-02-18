@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                @if(@Auth::user()->hasRole('administrador'))
                    <h2>Todos los prestamos</h2>
                @endif
                @if(@Auth::user()->hasRole('usuario'))
                    <h2>Mis prestamos</h2>
                @endif
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
            @if (@Auth::user()->hasRole('administrador'))
                <th>Usuario</th>      
            @endif
            <th>Libro</th>
            <th>Fecha Plazo</th>
            <th>Fecha Entrega</th>
            <th></th>
        </tr>
        @foreach ($prestamos as $prestamo)
            @if($prestamo->user_id == @Auth::user()->id || @Auth::user()->hasRole('administrador'))
            <tr>
                @if (@Auth::user()->hasRole('administrador'))
                    <td>{{ $prestamo->user->name }}</td> 
                @endif
                <td>{{ $prestamo->libro->nombre }}</td>
                <td>{{ $prestamo->fecha_plazo }}</td>
                <td>{{ $prestamo->fecha_entrega }}</td>
                <td>
                    @if(@Auth::user()->hasRole('administrador'))
                        <a class="btn btn-sm btn-primary" href="">Editar</a>
                        <form class="d-inline-block" action="" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                        </form>
                    @endif
                    @if ($prestamo->user_id == @Auth::user()->id)
                        <a class="btn btn-sm btn-primary" href="{{ route('prestamo.devolver',$prestamo->id) }}">Entregar</a>
                    @endif
                </td>
            </tr>
            @endif
        
        @endforeach
    </table>  
@endsection
