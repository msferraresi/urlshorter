@extends('master')

@section('seccion')
<h1>Estadisticas</h1>
<form action="urlStatistics" method="post">
    @csrf
    <div class="input-group mb-3">
        <input type="url" name="URL" id="URL" placeholder="Ingrese la URL que desea consultar" class="form-control">
        <div class="class input-group-append">
            <button type="submit" class="btn btn-success">Consultar</button>
        </div>
    </div>
</form>
@endsection
