@extends('layout.master')
@section('content')
    {{ Debugbar::addMessage(Auth::id()) }}
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span><i class="fa fa-dashboard" aria-hidden="true"></i> Panel de administración</span>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('excel') }}" class="btn btn-success pull-left"><i class="fa fa-file-excel-o"></i> Exportar a excel</a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('create') }}" class="btn btn-info pull-right"><i class="fa fa-user-plus"></i> Nuevo registro</a>
                    </div>
                </div>

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <table id="table-tickets" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Creado por</th>
                        <th>Asunto</th>
                        <th>Ente público</th>
                        <th>Tipo de Ente</th>
                        <th>Entidad federativa</th>
                        <th>Acciones</th>
                    </tr>
                    @foreach($results as $result)
                        <tr>
                            <td>{{ $result->name }}</td>
                            <td>{{ $result->asunto }}</td>
                            <td>{{ $result->nombre }}</td>
                            <td>{{ $result->descripcion }}</td>
                            <td>{{ $result->nombre }}</td>
                            <td>
                                <a href="{{ route('edit_ticket', $result->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <form style="display: inline;" method="POST" action="{{ route('delete_ticket', $result->id) }}">
                                    {!! method_field('DELETE') !!}
                                    {!! csrf_field() !!}
                                    <button class="btn btn-link" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </thead>
                </table>
                {!! $results->render() !!}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            var services = {};
            listAllTickets = function() {
                console.log($('meta[name="csrf-token"]').attr('content'));

                $.ajax({
                    type : 'POST',
                    url : '{{ route('get_all') }}',
                    data : { _token : '{{ csrf_token() }}' },
                    success: function (res) {
                        console.log(res);
                    },
                    error : function (e) {
                        console.log(e)
                    }
                });
            };
            listAllTickets();

        });
    </script>
@endsection