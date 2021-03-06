@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                @if(@Auth::user()->hasRole('administrador'))
                    <h2 class="text-center">Todas las sanciones</h2>
                @endif
                @if(@Auth::user()->hasRole('usuario'))
                    <h2 class="text-center">Mis sanciones</h2>
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
                <th>Fecha Inicio</th>
                <th>Dias iniciales de penalizacion</th>
                @if (@Auth::user()->hasRole('administrador'))
                    <th></th>    
                @endif
                
            </tr>
            @foreach ($sanciones as $sancion)
                @if(($sancion->user_id == @Auth::user()->id) || @Auth::user()->hasRole('administrador'))
                <tr>
                    @if (@Auth::user()->hasRole('administrador'))
                        <td>{{ $sancion->user->name }}</td> 
                    @endif
                    <td>{{ $sancion->fecha_inicio }}</td>
                    <td>{{ $sancion->retraso }}</td>
                    @if (@Auth::user()->hasRole('administrador'))
                        <td>
                            <a class="btn btn-sm btn-danger" href="">Enviar Mensaje</a>
                        </td>
                    @endif
                </tr>
                @endif
            
            @endforeach
        </table>  
    </div>
    <div class="col-3"></div>
</div>

@endsection
