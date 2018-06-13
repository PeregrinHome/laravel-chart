@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    <div class="row">
                        {{ csrf_field() }}
                        <h1 class="center-align">Регистрация</h1>

                        <div class="input-field col s12{{ $errors->has('name') ? ' has-error' : '' }}">
                            <input placeholder="-" id="name" type="text" class="validate" name="name" value="{{ old('name') }}" required autofocus>
                            <label for="name">Имя</label>
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="input-field col s12{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input placeholder="-" id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required>
                            <label for="email">Email</label>
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="input-field col s12{{ $errors->has('password') ? ' has-error' : '' }}">
                            <input placeholder="-" id="password" type="password" class="validate" name="password" required>
                            <label for="password">Пароль</label>
                            @if ($errors->has('password'))
                                <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="input-field col s12">
                            <input placeholder="-" id="password-confirm" type="password" class="validate" name="password_confirmation" required>
                            <label for="password-confirm">Повторите пароль</label>
                            @if ($errors->has('password'))
                                <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                            @endif
                        </div>

                        <div class="col s12 m6">
                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} />
                                <label for="remember">Запомнить</label>
                        </div>
                        <div class="col s12 m6 right-align">
                            <button class="btn waves-effect waves-light" type="submit">Регистрация
                                <i class="material-icons left">send</i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
