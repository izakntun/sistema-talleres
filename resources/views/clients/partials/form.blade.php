<div class="col-md-12">
    <h3 class="text-center"><i class="fa fa-gear" aria-hidden="true"></i> General</h3>
    <hr>
</div>
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('name', 'Nombre del propietario') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('name', 'Apellidos') !!}
        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('name', 'RFC') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('name', 'Nombre del restaurante') !!}
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('email', 'Email') !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('email', 'Teléfono') !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('email', 'Dirección') !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('email', 'Código postal') !!}
        {!! Form::text('email', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="col-md-12">
    <h3 class="text-center"><i class="fa fa-cutlery" aria-hidden="true"></i> Detalles</h3>
    <hr>
</div>
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('email', 'Tipo de negocio') !!}
        {!! Form::select('type', [
                                    'placeholder' => 'seleccione una opción',
                                    'PP' => 'Pastas y pizzas',
                                    'CR' => 'Comida rápida',
                                    'CT' => 'Comida regional',
                                    'M'  => 'Mariscos',
                                    'C'  => 'Cafetería',
                                    'H'  => 'Heladería',
                                    'T'  => 'Taquería',
                                    'V'  => 'Veganos',
                                    'R'  => 'Restaurantes generales',
                                    'CS' => 'Comida saludable',
                                    'O'  => 'Oriental',
                                    'FT' => 'FoodTruck'
                                    ],
            'placeholder', ['class' => 'form-control select2']) !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('email', 'Servicios que ofrece') !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        {!! Form::label('email', 'Servicio a domicilio ') !!}
        {!! Form::checkbox('email', 0, false) !!}
        {!! Form::label('email', 'Comida por encargo ') !!}
        {!! Form::checkbox('email', 0, false) !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Reservación de áreas ') !!}
        {!! Form::checkbox('email', 0, false) !!}
        {!! Form::label('email', 'Reservación de mesas ') !!}
        {!! Form::checkbox('email', 0, false) !!}
    </div>
</div>
<div class="col-md-6">
    {!! Form::label('email', 'Horarios ') !!}
    <div class="form-group">
        {!! Form::label('email', 'Horario de apertura ') !!}
        {!! Form::time('hours') !!}
    </div>
    <div class="form-group">
        {!! Form::label('email', 'Horario de apertura ') !!}
        {!! Form::time('hours') !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        {!! Form::submit('ENVIAR', ['class' => 'btn btn-primary pull-right']) !!}
    </div>
</div>