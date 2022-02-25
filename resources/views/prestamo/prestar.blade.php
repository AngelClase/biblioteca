@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Pedir nuevo prestamo del libro {{ $libro->nombre }}</h2>
            </div>        
        </div>
    </div>    
 
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
@endif

    <div class="table-responsive">
        <table class="table table-bordered ">
            <tr>
                <th>Libro</th>
                <th>Editorial</th>
                <th>Imagen</th>
                <th></th>
            </tr>
            
            <tr>
                
                <td>{{ $libro->nombre }}</td>
                <td>{{ $libro->editorial }}</td>
                <td><img src="{{ $libro->imagen }}" alt="Imagen del libro {{ $libro->nombre }}"></td>
                <td class="text-center">
                    <form class="d-inline-block" action="{{ route('prestamo.store',$libro) }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="libro_id" value="{{ $libro->id }}">
                        <select class="form-control" name="user_id">
                            @foreach ($users as $usuario)
                                <option value="{{ $usuario->id }}"> {{ $usuario->name }} </option>
                            @endforeach
                        </select>
                        <input type="hidden" name="fecha_plazo" value="{{ date_add(date_create_from_format("Y-m-d",date("Y-m-d")), date_interval_create_from_date_string("10 days"))->format("Y-m-d") }}">
                        <button type="submit" class="btn btn-sm btn-primary">Aceptar</button>
                    </form>
                    <a class="btn btn-sm btn-danger" href="{{ url('/') }}">Cancelar</a>
                    
                </td>
            </tr>
        </table> 
    </div>
    
@endsection
