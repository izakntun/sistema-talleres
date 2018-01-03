@extends('layout.master')
@section('content')
    {{ Debugbar::addMessage(Route('add')) }}
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span><i class="fa fa-user-plus" aria-hidden="true"></i> Registrar cliente nuevo</span>
            </div>
            <div class="panel-body">
                {!! Form::open(['route' => 'create']) !!}
                    @include('clients.partials.form')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
