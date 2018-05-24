@extends('layouts.app')

@section('content')
    <header>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h1 class="center-align">{{ $title ?? null }}</h1>
                </div>
            </div>
        </div>
    </header>
    <main>
        {{--<div style="display: none;">--}}
            {{--<input type="hidden" class="meta device_id" value="{{ $device_id ?? null }}">--}}
        {{--</div>--}}
        {{--@includeIf('templates.pagination',--}}
        {{--[--}}
            {{--'count_page' => $count_page,--}}
            {{--'showPage' => $showPage,--}}
            {{--'link' => '?page='--}}
        {{--])--}}
        {{ $items->links() }}
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <div style="overflow-x:auto;">

                        @includeIf('templates.tables.table-types-of-device',
                        [
                            'all' => ((empty($all))? null: $all),
                            'device_id' => $device_id,
                            'items' => $items
                        ])

                    </div>
                </div>
            </div>
        </div>

        {{ $items->links() }}
        @includeIf('templates.modals.modal-all')
        {{--@includeIf('templates.pagination',--}}
        {{--[--}}
            {{--'count_page' => $count_page,--}}
            {{--'showPage' => $showPage,--}}
            {{--'link' => '?page='--}}
        {{--])--}}
    </main>
@endsection
