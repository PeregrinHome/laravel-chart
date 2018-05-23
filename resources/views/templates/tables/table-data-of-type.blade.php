<table class="bordered">
    <thead>
    <tr>
        <th style="padding-right: 3rem;">Время</th>
        <th style="padding-right: 2rem;">Данные</th>
        <th>
            <div class="d-flex justify-content-end">
                <a class="waves-effect waves-light btn red modal-trigger" data-type="del" data-target="all_data" data-id="{{ $type_id ?? null }}" data-name='Все данные, рекурсивно. (Внимание: это может занять длительное время.)'>Удалить все данные.</a>
            </div>
        </th>
    </tr>
    </thead>
    <tbody>

    @forelse ($items as $item)

        <tr class="data-{{ $item['id'] }}">
            <td>{{ $item['created_at'] ?? null }}</td>
            <td>{{ $item['value'] ?? null }}</td>
            <td>
                <div class="d-flex justify-content-end">
                    <div class="m-l-r-2px">
                        <a href="#" class="link-solid red-text modal-trigger tooltipped" data-position="bottom" data-delay="50" data-tooltip="Удалить данные?" data-type="del" data-target="data" data-id="{{ $item['id'] }}" data-name='{{ $item['value'] }} за "{{ $item['created_at'] }}"'><i class="material-icons">close</i></a>
                    </div>
                </div>
            </td>
        </tr>

    @empty
        <tr>
            <td colspan="3">Данных нет. <a class="link-solid modal-trigger" href="#!" data-type="add" data-target="data" data-id="{{ $type_id ?? null }}" data-name='100 демо записей.'>Добавить демо данные.</a></td>
        </tr>
    @endforelse

    </tbody>
</table>