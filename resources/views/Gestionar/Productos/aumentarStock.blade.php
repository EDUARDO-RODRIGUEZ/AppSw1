@extends('layout.plantilla')
    @section('contenido')
        <div class="card">
            <h1 class="card-header">
                {{ "Aumentar Stock de Producto ".$producto->id.' : Empresa '.auth()->user()->usuarioempresa->empresa->nombre }}
            </h1>
            <div class="card-body">
                <div class="container">
                    @if(count($errors) > 0)
                        <div class="errors">
                            <ul class="alert alert-danger " role="alert">
                                <i class="fas fa-exclamation-triangle"></i> Mensaje informativo : <br>
                                @foreach($errors->all() as $error)
                                    <li class="m-3">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col">
                            <form action="{{ route('productos.actualizarStock', [$producto->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-row">
                                    <div class="form-group col-4">
                                        <label for="id">Id</label>
                                        <input type="number" class="form-control" id="id" name="id"
                                               value="{{ $producto->id }}" readonly>
                                    </div>
                                    <div class="form-group col-8">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre"
                                               value="{{ $producto->nombre }}" readonly>
                                    </div>
                                </div>
                                <div class="form-row align-items-center">
                                    <div class="form-group col-sm-3 my-1">
                                        <label for="stockActual">Stock Actual</label>
                                        <input type="number" class="form-control" id="stockActual" name="stockActual"
                                        value="{{ $producto->stock }}" readonly>
                                    </div>
                                    <div class="form-group col-sm-3 my-1">
                                        <label for="aumento">Stock a Aumentar</label>
                                        <input type="number" class="form-control"
                                                   id="aumento" name="aumento">
                                    </div>
                                    <div class="form-group col-3">
                                        <label for="">Confirmar:</label>
                                        <div class="col-auto my-1">
                                            <button type="submit" class="btn btn-primary">Actualizar Stock</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
