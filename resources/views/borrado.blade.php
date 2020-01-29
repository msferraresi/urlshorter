@extends('master')

@section('seccion')
<h1>Eliminacion</h1>
<form action="delteUrl" method="post">
    @csrf
    <div class="input-group mb-3">
        <input type="url" name="URL" id="URL" placeholder="Ingrese la URL que desea eliminar" class="form-control">
        <div class="class input-group-append">
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
    </div>
</form>
@endsection
