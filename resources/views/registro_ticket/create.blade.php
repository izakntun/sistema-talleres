@extends('layout.master')
@section('content')
    <ul>
        @foreach($errors->all() as $error)
            <li> {{ $error }}</li>
        @endforeach
    </ul>
    <div class="col-md-9">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span><i class="fa fa-dashboard" aria-hidden="true"></i> Crear nuevo registro</span>
            </div>
            <div class="panel-body">
                <form action="{{ route('insert_ticket') }}" method="POST">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_registro">Fecha de registro</label>
                                <input type="date" class="form-control" name="fecha_registro" id="fecha_registro">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="folio">Folio de ticket</label>
                                <input type="text" class="form-control" name="folio" id="folio">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="prioridad">Prioridad</label>
                                <select class="form-control select2" name="prioridad" id="prioridad">
                                    @foreach($prioridad as $p)
                                        <option value="{{ $p->id }}">{{ $p->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categoria">Categoría</label>
                                <select class="form-control select2" name="categoria" id="categoria">
                                    @foreach($categoria as $c)
                                        <option value="{{ $c->id }}">{{ $c->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="entidad_federativa">Entidad federativa</label>
                                <select class="form-control select2" name="entidad_federativa" id="entidad_federativa">
                                    @foreach($entidades as $entidad)
                                        <option value="{{ $entidad->id }}">{{ $entidad->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="medio_consulta">Medio de consulta</label>
                                <select class="form-control select2" name="medio_consulta" id="medio_consulta">
                                    @foreach($consulta as $con)
                                        <option value="{{ $con->id }}">{{ $con->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ente_publico">Ente público</label>
                                <select class="form-control select2" name="ente_publico" id="ente_publico">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estatus">Estatus</label>
                                <select class="form-control select2" name="estatus" id="estatus">
                                    @foreach($estatus as $est)
                                        <option value="{{ $est->id }}">{{ $est->descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="asunto">Título / asunto</label>
                                <input type="text" class="form-control" name="asunto" id="asunto">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="enlace">Nombre enlace</label>
                                <input type="text" class="form-control" name="enlace" id="enlace">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="correo_electronico">Correo electrónico</label>
                                <input type="text" class="form-control" name="correo_electronico" id="correo_electronico">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefono">Teléfono</label>
                                <input type="text" class="form-control" name="telefono" id="telefono">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_respuesta">Fecha de respuesta</label>
                                <input type="date" name="fecha_respuesta" id="fecha_respuesta" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="respuesta">Respuesta</label>
                                <textarea class="form-control" name="respuesta" id="respuesta" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <textarea class="form-control" name="observaciones" id="observaciones" cols="30" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div style="margin-right: 15px" class="pull-right">
                            <a href="{{ route('/') }}" class="btn btn-default">
                                <i class="fa fa-close" aria-hidden="true"></i>
                                 Cancelar
                            </a>
                            <button class="btn btn-success"><i class="fa fa-floppy-o"></i> Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function(){
            $('.select2').select2();

            $('body').on('change', '#entidad_federativa', function () {
                var id = $(this).val();
                var ente = $('#ente_publico');
                ente.empty();
                $.ajax({
                    type : 'GET',
                    url : '{{ url('entes') }}/'+id,
                    success : function (res) {
                        ente.empty();
                        $(res).each(function (i, v) {
                            ente.append(`<option value="${v.id}">${v.nombre}</option>`);
                        });
                    }
                });
            });
        });
    </script>
@endsection