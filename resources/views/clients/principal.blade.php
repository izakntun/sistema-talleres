@extends('layout.master')
@section('content')
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span>Participantes</span>
            </div>
            <div class="panel-body">
                <a href="{{ route('add') }}" class="btn btn-info"><i class="fa fa-user" aria-hidden="true"></i>Agregar cliente</a>
                <h1>Aquí irán los datos de los clientes</h1>
            </div>
        </div>
    </div>
@endsection