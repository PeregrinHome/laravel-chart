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
    <main>

        {{ $items->links() }}
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
        {{ $items->links() }}
        @includeIf('templates.modals.modal-all')

    </main>
@endsection
