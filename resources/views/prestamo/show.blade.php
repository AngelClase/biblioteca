@extends('layouts.app')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Detalles del prestamo </h2>
            </div>        </div>
    </div>


    <div class="row col-2">
        <a class="btn btn-sm btn-info" href="{{ route('prestamos') }}">Back</a>
    </div>
@endsection
