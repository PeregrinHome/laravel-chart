@if(! empty($count_page) && ! empty($showPage) && ! empty($link))

    <div class="container">
        <div class="row">
            <div class="col s12 center-align">
                <ul class="pagination">
                    @if($showPage != 1)
                        <li class="waves-effect"><a href="{{ $link.($showPage - 1) }}"><i class="material-icons">chevron_left</i></a></li>
                    @else
                        <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                    @endif

                    @for ($j = $showPage - 2, $i = 1; $i <= ($count_page > 5? 5: $count_page); ($j > 0? $i += 1: null), $j += 1)
                        @if($j > 0)
                            @if($j == $showPage)
                                <li class="active"><a href="{{ $link.$j }}">{{ $j }}</a></li>
                            @elseif($j <= $count_page)
                                <li class="waves-effect"><a href="{{ $link.$j }}">{{ $j }}</a></li>
                            @endif
                        @endif
                    @endfor

                    @if($count_page == 1)
                        <li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                    @elseif($showPage == $count_page)
                        <li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                    @else
                        <li class="waves-effect"><a href="{{ $link.($showPage + 1) }}"><i class="material-icons">chevron_right</i></a></li>
                    @endif


                </ul>
            </div>
        </div>
    </div>

@else

    {{--<div class="container">--}}
        {{--<div class="row">--}}
            {{--<div class="col s12 center-align">--}}
                {{--<ul class="pagination">--}}
                    {{--<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>--}}
                    {{--<li class="active"><a href="#!">1</a></li>--}}
                    {{--<li class="waves-effect"><a href="#!">2</a></li>--}}
                    {{--<li class="waves-effect"><a href="#!">3</a></li>--}}
                    {{--<li class="waves-effect"><a href="#!">4</a></li>--}}
                    {{--<li class="waves-effect"><a href="#!">5</a></li>--}}
                    {{--<li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>--}}
                {{--</ul>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}

@endif