@extends('login.app')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a><b>Sistema</b> Talleres</a>
        </div>
        <div class="register-box-body">
            <p class="login-box-msg">Registrar nuevo usuario</p>
            <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback">

                        <input id="name" type="text" placeholder="Nombre completo" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">

                        <input id="email" type="email" placeholder="E-mail" class="form-control" name="email" value="{{ old('email') }}" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                        @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} has-feedback">

                        <input id="password" type="password" placeholder="Contraseña" class="form-control" name="password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                </div>

                <div class="form-group has-feedback">

                        <input id="password-confirm" type="password" placeholder="Confirmar contraseña" class="form-control" name="password_confirmation" required>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>

                <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            Registrarse
                        </button>
                </div>
            </form>
        </div>
    </div>
@endsection
