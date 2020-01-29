@extends('master')

@section('seccion')
<h1>Recuperador</h1>
<form action="shortCode" method="post">
    @csrf
    <div class="input-group mb-3">
        <input type="url" name="URL" id="URL" placeholder="Ingrese la URL que desea navegar" class="form-control">
        <div class="class input-group-append">
            <button type="submit" class="btn btn-primary">Navegar</button>
        </div>
    </div>
</form>
@endsection
