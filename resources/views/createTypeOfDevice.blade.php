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

        <div class="container">
            <div class="row">
                <form class="form-all col s12" action="{{ Route('route_service_data') }}" method="post">
                    <div class="row">
                        <div class="col s12" style="padding-bottom: 1rem">
                            <button type="submit" class="waves-effect waves-white btn green">Сохранить</button>
                        </div>
                        <div class="col s12" style="padding-bottom: 1rem">
                            <div class="progress modal__progress"> <div class="indeterminate"></div> </div>
                        </div>
                        <div class="input-field col s3">
                            <input placeholder="-" name="name" id="input-name" type="text"
                                   class="validate data-auto-convert-cl-c" value="{{ $name ?? null }}" required>
                            <label for="input-name">Название</label>
                        </div>
                        <div class="input-field col s3">
                            <input placeholder="-" name="alias" id="input-alias" type="text"
                                   class="validate data-auto-convert-cl-l" value="{{ $alias ?? null }}">
                            <label for="input-alias">Псевдоним(AUTO/en)</label>
                        </div>
                        <div class="input-field col s6">
                            @includeIf('templates.forms.select.simple-select',
                            [
                                'items' => $devices,
                                'select_item' => $device,
                                'name' => 'device_id',
                                'class' => 'required',
                                'label' => 'Привязка к устройству',
                                'default' => 'Выберите устройство'
                            ])
                        </div>
                        <div class="input-field col s12">
                            <textarea placeholder="-" name="description" id="input-description" class="materialize-textarea">{{ $description ?? null }}</textarea>
                            <label for="input-description">Описание(не обязательно)</label>
                        </div>
                    </div>
                    @if($type == 'PUT')
                        <input type="hidden" name="typeofdevice_id" value="{{ $typeofdevice_id ?? null }}">
                    @endif
                    <div class="data-form-type" data-type="{{ $type ?? null }}" style="display: none!important;"></div>
                    <input type="hidden" name="target" value="typeofdevice">
                    {{ csrf_field() }}
                </form>
            </div>
        </div>

    </main>
@endsection
