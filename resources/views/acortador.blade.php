@extends('master')

@section('seccion')
<h1>Acortador</h1>

<form action="longUrl" method="post">
    @csrf
    <div class="input-group mb-3">
        <input type="url" name="URL" id="URL" placeholder="Ingrese la URL que desea acortar" class="form-control">
        <div class="class input-group-append">
            <button type="submit" class="btn btn-primary">Acortar</button>
        </div>
    </div>
</form>
@endsection
