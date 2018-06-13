@extends('layouts.app')

@section('content')
    <header>
        <div class="container">
            <div class="row">
                <div class="col s12">
                    <h1 class="center-align">Устройства</h1>
                </div>
            </div>
        </div>
    </header>
    <main>
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

                        @includeIf('templates.tables.table-devices',
                        [
                            'items' => $items
                        ])

                    </div>
                </div>
            </div>
        </div>

        @includeIf('templates.modals.modal-all')
        {{ $items->links() }}
        {{--@includeIf('templates.pagination',--}}
        {{--[--}}
            {{--'count_page' => $count_page,--}}
            {{--'showPage' => $showPage,--}}
            {{--'link' => '?page='--}}
        {{--])--}}
    </main>
@endsection
