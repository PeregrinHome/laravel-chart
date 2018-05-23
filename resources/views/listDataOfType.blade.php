@extends('layouts.app')

@section('content')
    <header>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h1 class="center-align">Данные типа "{{ $type_name ?? null }}"</h1>
                </div>
            </div>
        </div>
    </header>
    {{--<div style="display: none;">--}}
        {{--<input type="hidden" class="meta device_id" value="{{ $device_id ?? null }}">--}}
        {{--<input type="hidden" class="meta type_id" value="{{ $type_id ?? null }}">--}}
    {{--</div>--}}
    <main>

        @includeIf('templates.pagination',
        [
            'count_page' => $count_page,
            'showPage' => $showPage,
            'link' => '?page='
        ])

        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div style="overflow-x:auto;">

                        @includeIf('templates.tables.table-data-of-type',
                        [
                            'device_id' => $device_id,
                            'items' => $items,
                            'type_id' => $type_id
                        ])

                    </div>
                </div>
            </div>
        </div>

        @includeIf('templates.modals.modal-all')

        @includeIf('templates.pagination',
        [
            'count_page' => $count_page,
            'showPage' => $showPage,
            'link' => '?page='
        ])
    </main>
@endsection
