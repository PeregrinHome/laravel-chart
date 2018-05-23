<div class="fields-lines">
    @if($items != null)
        @forelse ($items as $item)
            <div class="row fields-line-{{ $item->id }}">

                <div class="input-field col s4">
                    <input placeholder="-" name="time_line[]" id="time_line-{{ $item->id }}" type="text"
                           value="{{ $item->name }}" required>
                    <label for="time_line-{{ $item->id }}">Название линии</label>
                </div>
                <div class="input-field col s4">

                    @includeIf('templates.forms.select.simple-select',
                                    [
                                        'items' => ($types_data ?? null),
                                        'select_item' => ($item->data_alias ?? null),
                                        'name' => 'time_line[]',
                                        'class' => 'required',
                                        'label' => 'Закрепление типа данных',
                                        'default' => 'Выберите тип данных'
                                    ])

                </div>
                <div class="input-field col s3">
                    <input placeholder="-" name="time_line[]" id="time_line_color-{{ $item->id }}" type="text"
                           class="inputColor" value="{{ $item->color }}" required>
                    <label for="time_line_color-{{ $item->id }}">Цвет</label>
                </div>
                <div class="col s1">
                    <a class="waves-effect waves-light red btn" data-target=".fields-line-{{ $item->id }}"
                       onclick="$($(this).data('target')).remove();">Удалить</a>
                </div>

            </div>
        @empty

        @endforelse

    @else
        <div class="row fields-line-1">

            <div class="input-field col s4">
                <input placeholder="-" name="time_line[]" id="time_line-1" type="text"
                       value="" required>
                <label for="time_line-1">Название линии</label>
            </div>
            <div class="input-field col s4">

                @includeIf('templates.forms.select.simple-select',
                                [
                                    'items' => ($types_data ?? null),
                                    'select_item' => ($type_data ?? null),
                                    'name' => 'time_line[]',
                                    'class' => 'required',
                                    'label' => 'Закрепление типа данных',
                                    'default' => 'Выберите тип данных'
                                ])

            </div>
            <div class="input-field col s3">
                <input placeholder="-" name="time_line[]" id="time_line_color-1" type="text"
                       class="inputColor" value="" required>
                <label for="time_line_color-1">Цвет</label>
            </div>
            <div class="col s1">
                <a class="waves-effect waves-light red btn" data-target=".fields-line-1"
                   onclick="$($(this).data('target')).remove();">Удалить</a>
            </div>

        </div>

    @endif
</div>
