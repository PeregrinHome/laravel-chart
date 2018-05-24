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
    </main>
@endsection
