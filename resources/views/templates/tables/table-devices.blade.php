@if(! empty($items))
<table class="bordered">
    <thead>
    <tr>
        <th>ID</th>
        <th style="padding-right: 2rem;">Название</th>
        <th style="padding-right: 2rem;">Описание</th>
        <th class="list-devices-t-i-btn--w">
            <div class="d-flex justify-content-end">
                <div class="m-l-r-2px">
                    <a href="{{ Route('route_devices_create') }}" class="link-solid tooltipped" data-tooltip="Добавить устройство" data-position="bottom" data-delay="50"><i class="material-icons">add</i></a>
                </div>
            </div>
        </th>
        {{--<th><a href="#modal_add_device" class="btn_modal btn_modal_add_device waves-effect waves-light btn"><i class="material-icons left">clear</i>Добавить устройство</a></th>--}}
    </tr>
    </thead>
    <tbody>

@forelse ($items as $item)

    <tr class="device-{{ $item['id'] }}">
        <td>{{ $item['id'] }}</td>
        <td><a href="{{ Route('route_types', $item['id']) }}" class="link-solid" title="Открыть страницу устройства">{{ $item['name'] }}</a></td>
        <td class="p">{{ $item['description'] }}</td>
        <td class="list-devices-t-i-btn--w">
            <div class="d-flex justify-content-end">
                <div class="m-l-r-2px">
                    <a href="#" class="link-solid modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Показать токен устройства {{ $item['name'] }}?" data-type="showToken" data-target="device" data-id="{{ $item['id'] }}" data-name='{{ $item['name'] }}'><i class="material-icons">build</i></a>
                </div>
                <div class="m-l-r-2px">
                    <a href="{{ route('route_devices_create').'/'.$item['id'] }}" class="link-solid tooltipped" data-position="bottom" data-delay="50" data-tooltip="Изменить {{ $item['name'] }}?"><i class="material-icons">create</i></a>
                </div>
                <div class="m-l-r-2px">
                    <a href="#" class="link-solid red-text modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Удалить {{ $item['name'] }}?" data-type="del" data-target="device" data-id="{{ $item['id'] }}" data-name='{{ $item['name'] }}'><i class="material-icons">close</i></a>
                </div>
            </div>
        </td>
    </tr>

@empty
    <tr>
        <td colspan="4">Устройств нет. <a class="link-solid" href="{{ Route('route_devices_create') }}">Добавить устройство.</a></td>
    </tr>
@endforelse

    </tbody>
</table>
@else

    <tr>
        <td colspan="4">Устройств нет. <a class="link-solid" href="{{ Route('route_devices_create') }}">Добавить устройство.</a></td>
    </tr>

@endif