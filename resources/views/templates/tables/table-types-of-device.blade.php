    <table class="bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th style="padding-right: 2rem;">Название</th>
            <th style="padding-right: 2rem;">Псевдоним</th>
            <th style="padding-right: 2rem;">Описание</th>
            <th class="list-devices-t-i-btn--w">
                <div class="d-flex justify-content-end">
                    <div class="m-l-r-2px">
                        <a href="{{ Route('route_types_create') }}" class="link-solid tooltipped" data-tooltip="Добавить тип данных" data-position="bottom" data-delay="50"><i class="material-icons">add</i></a>
                    </div>
                </div>
            </th>
            {{--<th><a href="#modal_add_device" class="btn_modal btn_modal_add_device waves-effect waves-light btn"><i class="material-icons left">clear</i>Добавить устройство</a></th>--}}
        </tr>
        </thead>
        <tbody>

        @forelse ($items as $item)

            <tr class="typeofdata-{{$item['id']}}">
                <td>{{ $item['id'] ?? null }}</td>
                <td><a href="{{ ((empty($all))? Route('route_type_data_show', [$device_id, $item['alias']]) : Route('route_data_type', $item['alias'])) }}" class="link-solid" title="Открыть страницу типа данных">{{ $item['name'] ?? null }}</a></td>
                <td class="p">{{ $item['alias'] ?? null }}</td>
                <td class="p">{{ $item['description'] ?? null }}</td>
                <td class="list-devices-t-i-btn--w">
                    <div class="d-flex justify-content-end">
                        <div class="m-l-r-2px">
                            <a href="{{ route('route_types_update', $item['alias']) }}" class="link-solid tooltipped" data-position="bottom" data-delay="50" data-tooltip="Изменить {{ $item['name'] }}?"><i class="material-icons">create</i></a>
                        </div>
                        <div class="m-l-r-2px">
                            <a href="#" class="link-solid red-text modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Удалить {{ $item['name'] }}?" data-type="del" data-target="typeofdata" data-id="{{ $item['id'] }}" data-name='{{ $item['name'] }}'><i class="material-icons">close</i></a>
                        </div>
                    </div>
                </td>
            </tr>

        @empty
            <tr>
                <td colspan="5">Типов данных нет. <a class="link-solid" href="{{ Route('route_types_create') }}">Добавить тип данных.</a></td>
            </tr>
        @endforelse

        </tbody>
    </table>