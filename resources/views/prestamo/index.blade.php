@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                @if(@Auth::user()->hasRole('administrador'))
                    <h2 class="text-center">Todos los prestamos</h2>
                @endif
                @if(@Auth::user()->hasRole('usuario'))
                    <h2 class="text-center">Mis prestamos</h2>
                @endif
                <br> <br>
            </div>        
        </div>
    </div>    
 
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
@endif   


<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
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
                @if(($prestamo->user_id == @Auth::user()->id && $prestamo->fecha_entrega == "") || @Auth::user()->hasRole('administrador'))
                <tr>
                    @if (@Auth::user()->hasRole('administrador'))
                        <td>{{ $prestamo->user->name }}</td> 
                    @endif
                    <td>{{ $prestamo->libro->nombre }}</td>
                    <td>{{ $prestamo->fecha_plazo }}</td>
                    @if(@Auth::user()->hasRole('administrador'))
                        <td>{{ $prestamo->fecha_entrega }}</td>
                    @endif
                    
                    <td>
                        @if (@Auth::user()->hasRole('administrador'))
                            <a class="btn btn-sm btn-primary" href="{{ url('gestion/devolver',$prestamo->id) }}">Entregar</a>
                        @endif
                    </td>
                </tr>
                @endif
            
            @endforeach
        </table>  
    </div>
    <div class="col-3"></div>
</div>

@endsection
