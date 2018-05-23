@extends('layouts.app')

@section('content')
    @if($type == 'simple')
        <header>
            <div class="container">
                <div class="row">
                    <div class="col s12">
                        {{--<h1 class="center-align">{{ $graphic_name ?? null }}</h1>--}}
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="container">
                <div class="row">
                    <div class="col s12">

                        <a class="waves-effect waves-light btn createGraph">Обновить</a>

                        <div id="timegraphic-{{ $graphic_id ?? null }}"></div>

                        <form class="form-all form-graphic" action="{{ Route('route_service_data') }}" method="post"
                              style="display: none;">

                            <input type="hidden" name="get" value="graphic">
                            <input type="hidden" name="target" value="{{ $graphic_type ?? null }}">
                            <input type="hidden" name="id[]" value="{{ $graphic_id ?? null }}">
                            <div class="data-form-type" data-type="GET" style="display: none!important;"></div>
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </main>
    @elseif($type == 'multi')
        <main>
            <div class="container">
                <div class="row">
                    <div class="col s12" style="margin: 2rem 2rem;">
                        <a class="waves-effect waves-light btn createGraph">Обновить</a>
                    </div>
                    <div class="col s12">
                        <ul class="tabs">
                            @forelse ($items as $item)
                                <li class="tab col s3"><a href="#tab-timegraphic-{{ $item['id'] }}">{{ $item['name'] }}</a></li>
                            @empty
                                <li class="tab col s3"><a href="#test1">Нет графиков</a></li>
                            @endforelse

                        </ul>
                    </div>
                    @forelse ($items as $item)
                        <div id="tab-timegraphic-{{ $item['id'] }}" class="col s12">

                            <div id="timegraphic-{{ $item['id'] }}"></div>

                        </div>
                    @empty
                        <div id="test1" class="col s12">Нет графиков</div>
                    @endforelse

                    @if(!empty($items))
                    <form class="form-all form-graphic" action="{{ Route('route_service_data') }}" method="post"
                          style="display: none;">

                        <input type="hidden" name="get" value="graphic">
                        <input type="hidden" name="target" value="{{ $graphic_type ?? null }}">
                        @foreach ($items as $item)
                            <input type="hidden" name="id[]" value="{{ $item['id'] }}">
                        @endforeach

                        <div class="data-form-type" data-type="GET" style="display: none!important;"></div>
                        {{ csrf_field() }}
                    </form>
                    @endif
                </div>
            </div>
        </main>
    @endif
@endsection
