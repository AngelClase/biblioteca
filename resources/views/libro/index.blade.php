@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="text-center">
                <h2 class="">Libros</h2>
            </div>     
            
            @guest

            @else
                @if(@Auth::user()->hasRole('administrador'))
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4">
                            <a class="btn btn-sm btn-primary" href="{{ route('libros.create') }}">Crear Libro</a>
                        </div>
                        <div class="col-4"></div>
                        
                    </div>
                    <hr>
                @endif
            @endguest
        </div>
    </div>    
 
@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
@endif
@if ($message = Session::get('danger'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
@endif   


<div class="container">
    <div class="row row-cols-4">

        @foreach ($libros as $libro)
        <div class="card col" style="width: 18rem;">
            <img class="card-img-top" height="200px" width="100px" src="{{ $libro->imagen }}" alt="Imagen del libro {{ $libro->nombre }}">
            <div class="card-body">
                <h5 class="card-title">{{ $libro->nombre }}</h5>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><strong>Categoría:</strong> {{ $libro->categoria->nombre }}</li>
              <li class="list-group-item"><strong>Editorial:</strong> {{ $libro->editorial }}</li>
            </ul>
            <div class="card-body">
                <a class="btn btn-sm btn-info" href="{{ route('libros.show',$libro->id) }}">Mostrar</a>
                
                @guest
                    
                @else
                    @if(@Auth::user()->hasRole('administrador'))
                        <br> <br> <br>
                        <a class="btn btn-sm btn-primary" href="{{ route('libros.edit',$libro->id) }}">Editar</a>
                        <a class="btn btn-sm btn-primary" href="{{ route('prestamo',$libro->id) }}">Prestar</a>
                        <form class="d-inline-block" action="{{ route('libros.destroy',$libro->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                        </form>
                    @endif
                    
                    
                @endguest
            </div>
          </div>
            

        @endforeach
    </div>
</div>
@endsection
