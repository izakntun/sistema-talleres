@extends('layout.master')
@section('content')
    {{ Debugbar::addMessage(Route('add')) }}
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span><i class="fa fa-user-plus" aria-hidden="true"></i> Registrar cliente nuevo</span>
            </div>
            <div class="panel-body">
                <form action="{{ url('create') }}" class="form-group" method="post">
                    <label for="input_name">Nombre</label>
                    <input type="text" class="form-control" name="name" id="input_name">
                    <label for="input_last_name">apellido</label>
                    <input type="text" class="form-control" name="last_name" id="input_last_name">
                    <label for="input_email">Email</label>
                    <input type="text" class="form-control" name="email" id="input_email"><br>
                    <a href="{{ url('/') }}" class="btn btn-warning">Cancelar</a>
                    <input type="submit" class="btn btn-success" value="Enviar">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
@endsection
