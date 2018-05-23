<nav class="blue darken-4">
    <div class="nav-wrapper">
        <a href="/" class="brand-logo">Графики</a>
        <a href="#" data-activates="mobile-navbar" class="button-collapse"><i class="material-icons">menu</i></a>

        <ul class="right hide-on-med-and-down">
            {{--@if(! empty($nav_items))--}}
            {{--@foreach ($nav_items as $item)--}}
            {{--<li><a href="{{ $item['link'] }}">{{ $item['name'] }}</a></li>--}}
            {{--@endforeach--}}
            {{--@endif--}}
            {{--            <li><a href="{{ route('logout') }}">{{ route('logout') }}</a></li>--}}
            @guest
                <li><a href="{{ route('login') }}">Войти</a></li>
                <li><a href="{{ route('register') }}">Регистрация</a></li>
            @else
                <li><a href="{{ route('route_home') }}">Панель: {{ Auth::user()->name }}</a></li>
                <li>
                    <a class="dropdown-button" href="#!" data-activates="create-dropdown">Создать<i class="material-icons right">arrow_drop_down</i></a>
                    <ul id="create-dropdown" class="dropdown-content">
                        <li><a href="{{ Route('route_devices_create') }}">Создать устройство</a></li>
                        <li><a href="{{ Route('route_types_create') }}">Создать тип данных</a></li>
                        <li><a href="{{ Route('route_graphics_create') }}">Создать график</a></li>
                    </ul>
                </li>
                <li><a href="{{ route('route_graphics') }}">Графики</a></li>
                <li><a href="{{ route('route_data_all') }}">Данные</a></li>
                <li><a href="{{ route('route_devices') }}">Устройства</a></li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Выйти
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                {{--<li><a class="dropdown-button" href="#!" data-activates="logout-btn">{{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i></a></li>--}}
                {{--<ul id="logout-btn" class="dropdown-content">--}}
                {{--<li>--}}
                {{--<a href="{{ route('logout') }}"--}}
                {{--onclick="event.preventDefault();--}}
                {{--document.getElementById('logout-form').submit();">--}}
                {{--Выйти--}}
                {{--</a>--}}

                {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                {{--{{ csrf_field() }}--}}
                {{--</form>--}}
                {{--</li>--}}
                {{--</ul>--}}
            @endguest
        </ul>
        <ul class="side-nav" id="mobile-navbar">
            {{--@if(! empty($nav_items))--}}
            {{--@foreach ($nav_items as $item)--}}
            {{--<li><a href="{{ $item['link'] }}">{{ $item['name'] }}</a></li>--}}
            {{--@endforeach--}}
            {{--@endif--}}

            @guest
                <li><a href="{{ route('login') }}"><i class="material-icons">cloud</i>Войти</a></li>
                <li><a href="{{ route('register') }}"><i class="material-icons">cloud</i>Регистрация</a></li>
            @else
                {{--                <li>{{ Auth::user()->name }}</li>--}}
                <li><a href="{{ route('route_home') }}">Панель: {{ Auth::user()->name }}</a></li>
                <li><a href="{{ Route('route_devices_create') }}">Создать устройство</a></li>
                <li><a href="{{ Route('route_types_create') }}">Создать тип данных</a></li>
                <li><a href="{{ Route('route_graphics_create') }}">Создать график</a></li>
                <li><a href="{{ route('route_graphics') }}">Графики</a></li>
                <li><a href="{{ route('route_data_all') }}">Данные</a></li>
                <li><a href="{{ route('route_devices') }}">Устройства</a></li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Выйти
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
                {{--<li class="dropdown">--}}

                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">--}}
                {{--{{ Auth::user()->name }} <span class="caret"></span>--}}
                {{--</a>--}}

                {{--Захреначить для мобильного меню имя с иконкой и кнопку логаут с иконкой--}}

                {{--<ul class="dropdown-menu">--}}
                {{--<li>--}}
                {{--<a href="{{ route('logout') }}"--}}
                {{--onclick="event.preventDefault();--}}
                {{--document.getElementById('logout-form').submit();">--}}
                {{--Logout--}}
                {{--</a>--}}

                {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                {{--{{ csrf_field() }}--}}
                {{--</form>--}}
                {{--</li>--}}
                {{--</ul>--}}
                {{--</li>--}}
            @endguest
        </ul>

    </div>
</nav>
{{--<nav>--}}
    {{--<div class="nav-wrapper">--}}
        {{--<div class="col s12">--}}
            {{--<a href="#!" class="breadcrumb">First</a>--}}
            {{--<a href="#!" class="breadcrumb">Second</a>--}}
            {{--<a href="#!" class="breadcrumb">Third</a>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</nav>--}}