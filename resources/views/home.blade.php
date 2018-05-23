@extends('layouts.app')

@section('content')
    <main>
        <div class="container">
            <div class="row">
                <div class="col s12">

                    <h1 class="center-align">Добро пожаловать!</h1>
                    @guest
                    <p class="center-align">Пожалуйста зарегистрируйтесь для использования данного сервиса.</p>
                    @else
                    <p class="center-left">Данные должны приходить методом POST по маршруту <br> <pre>{{ Route('route_api_data') }}</pre>в json формате
                        <br><pre>{ "token": "a0100c381dd8r37ae2a6e83343f809e", "fulldata": [{"alias": "temp", "data": 255}, {"alias": "wetness", "data": null}, {"alias": "power", "data": "0.00"} ]}</pre></p>
                    @endguest
                    <p class="center-align">Данный сервис предназначен для отображения информации в удобочитаемом виде,
                        <br>а в частности в виде графиков. В данный момент доступны лишь линейные графики времени.</p>
                    <br>
                    <p class="center-align"> Примечание: отображение и сохранение "времени" данных идет по Гринвичу GMT.</p>

                    {{--<div class="panel panel-default">--}}
                        {{--<div class="panel-heading">Dashboard</div>--}}

                        {{--<div class="panel-body">--}}
                            {{--@if (session('status'))--}}
                                {{--<div class="alert alert-success">--}}
                                    {{--{{ session('status') }}--}}
                                {{--</div>--}}
                            {{--@endif--}}
                            {{--You are logged in!--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </main>
@endsection
