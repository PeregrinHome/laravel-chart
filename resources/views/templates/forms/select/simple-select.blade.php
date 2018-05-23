@if(gettype($items) == 'object')

    <select name="{{ $name ?? null }}" class="{{ $class ?? null }}" data-required="{{ $default ?? null }}">
        <option value="" disabled {{ ($select_item == null)? 'selected': '' }}>{{ $default ?? null }}</option>
        @foreach ($items as $item)
            @if($select_item != null)
                @if($select_item->id == $item->id)
                    <option value="{{ $select_item->id }}" selected>{{ $select_item->name }}</option>
                @else
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
            @else
                <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endif
        @endforeach
    </select>
    <label>{{$label??null}}</label>

@elseif(gettype($items) == 'array' && gettype($select_item) == 'string')

    <select name="{{ $name ?? null }}" class="{{ $class ?? null }}" data-required="{{ $default ?? null }}">
        <option value="" disabled {{ ($select_item == null)? 'selected': '' }}>{{ $default ?? null }}</option>
        @foreach ($items as $item)
            @if($select_item != null)
                @if($select_item == $item['id']) {{-- На самом деле тут вместо id передается alias, установил в контроллере передающем графики--}}
                    <option value="{{ $item['id'] }}" selected>{{ $item['name'] }}</option>
                @else
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                @endif
            @else
                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
            @endif
        @endforeach
    </select>
    <label>{{$label??null}}</label>

@elseif(gettype($items) == 'array' && gettype($select_item) != 'string')

    <select name="{{ $name ?? null }}" class="{{ $class ?? null }}" data-required="{{ $default ?? null }}">
        <option value="" disabled {{ ($select_item == null)? 'selected': '' }}>{{ $default ?? null }}</option>
        @foreach ($items as $item)
            @if($select_item != null)
                @if($select_item->id == $item['id']){{-- На самом деле тут вместо id передается alias, установил в контроллере передающем графики--}}
                    <option value="{{ $select_item->id }}" selected>{{ $select_item['name'] }}</option>
                @else
                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                @endif
            @else
                <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
            @endif
        @endforeach
    </select>
    <label>{{$label??null}}</label>

@endif