@extends('login.app')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a><b>Sistema</b> de control de tickets</a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Inicia sesión</p>
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">

                    <input id="email" placeholder="E-mail" type="email" class="form-control" name="email"
                           value="{{ old('email') }}" required autofocus>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}  has-feedback">

                    <input id="password" type="password" placeholder="Contraseña" class="form-control" name="password"
                           required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            {{--<label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                Recuerdame
                            </label>--}}
                        </div>
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            Entrar
                        </button>
                    </div>
                </div>
            </form>
            {{--<a class="btn btn-link" href="{{ route('password.request') }}">
                ¿Olvidó su contraseña?
            </a>--}}
        </div>

    </div>
@endsection
