@extends('layouts.app')

@section('content')

<div class="container">

@if(Session::has('mensaje'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{Session::get('mensaje')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<a href="{{url('empleado/create')}}" class="btn btn-md btn-success mb-3">Registrar nuevo empleado</a>

<table class="table table-hover">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>Nombres</th>
            <th>Primer Apellido</th>
            <th>Segundo Apellido</th>
            <th>Número de doc.</th>
            <th>Correo</th>
            <th>Fotografía</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($empleados as $empleado)
        <tr>
            <td>{{ $empleado->id }}</td>
            <td>{{ $empleado->Nombres }}</td>
            <td>{{ $empleado->PrimerApellido }}</td>
            <td>{{ $empleado->SegundoApellido }}</td>
            <td>{{ $empleado->Numerodoc }}</td>
            <td>{{ $empleado->Correo }}</td>
            
            <td>
                <img class="img-thumbnail img-fluid" src="{{asset('storage').'/'.$empleado->Fotografia}}" width="120" alt="">
            </td>

            <td>
                <a href="{{url('/empleado/'.$empleado->id.'/edit')}}" class="btn btn-warning">Editar</a>    
                | 
                <form class="d-inline" action="{{ url('/empleado/'.$empleado->id) }}" method="post">
                    @csrf
                    {{method_field('DELETE')}}
                    <input class="btn btn-danger" type="submit" onclick="return confirm('¿Está seguro de eliminar este registro?')" value="Borrar">
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{!! $empleados->links()!!}
</div>

@endsection

