@extends('layouts.app')

@section('content')
    <header>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h2 class="center-align">{{ $title ?? null }}</h2>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div style="display: none;">
            <input type="hidden" class="meta types_data" data-value="{{ $types_data_JSON ?? null }}">
        </div>
        <div class="container">
            <div class="row">
                <form class="form-all col s12" action="{{ Route('route_service_data') }}" method="post">
                    <div class="row">
                        <div class="col s12" style="padding-bottom: 1rem">
                            <button type="submit" class="waves-effect waves-white btn green">Сохранить</button>
                            <div class="switch" style="display: inline-block; padding-left: 2rem;">
                                <label>
                                    "Избранное"?
                                    <input type="checkbox" name="favorites" value="1" {{ $favorite_time_graphic ?? null }}>
                                    <span class="lever"></span>

                                </label>
                            </div>
                        </div>
                        <div class="col s12" style="padding-bottom: 1rem">
                            <div class="progress modal__progress"> <div class="indeterminate"></div> </div>
                        </div>
                        <div class="input-field col s4">
                            <input placeholder="-" name="name" id="input-name" type="text"
                                   class="validate data-auto-convert-cl-c" value="{{ $name ?? null }}" required>
                            <label for="input-name">Название</label>
                        </div>
                        <div class="input-field col s4">
                            <input placeholder="-" name="alias" id="input-alias" type="text"
                                   class="validate data-auto-convert-cl-l" value="{{ $alias ?? null }}">
                            <label for="input-alias">Псевдоним(AUTO/en)</label>
                        </div>
                        <div class="input-field col s4">
                            <input placeholder="-" type="text" class="datepicker" name="border_time" id="input-border_time" value="{{ $border_time ?? null }}">
                            <label for="input-border_time">Отступ по дате</label>
                        </div>
                        {{--<div class="input-field col s3">--}}
                            {{--<input placeholder="-" type="text" class="timepicker" name="border_time" id="input-border_time" >--}}
                            {{--<label for="input-border_time">Отступ по времени</label>--}}
                        {{--</div>--}}
                        <div class="input-field col s12">
                            <textarea placeholder="-" name="description" id="input-description" class="materialize-textarea">{{ $description ?? null }}</textarea>
                            <label for="input-description">Описание(не обязательно)</label>
                        </div>
                        <div class="col s12">
                            <a class="waves-effect waves-light green btn add_time_line">Добавить линию</a>
                        </div>

                    </div>

                    @includeIf('templates.tables.table-lines-time-graphic',
                            [
                                'items' => ($lines_time_graphic ?? null),
                                'types_data' => $types_data
                            ])

                    @if($type == 'PUT')
                        <input type="hidden" name="timegraphic_id" value="{{ $timegraphic_id ?? null }}">
                    @endif
                    <div class="data-form-type" data-type="{{ $type ?? null }}" style="display: none!important;"></div>
                    <input type="hidden" name="target" value="timegraphic">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>

    </main>
@endsection
