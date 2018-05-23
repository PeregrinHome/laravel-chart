{{--@if ($paginator->hasPages())--}}
    {{--<ul class="pagination">--}}
        {{-- Previous Page Link --}}
        {{--@if ($paginator->onFirstPage())--}}
            {{--<li class="disabled"><span>&laquo;</span></li>--}}
        {{--@else--}}
            {{--<li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>--}}
        {{--@endif--}}

        {{-- Pagination Elements --}}
        {{--@foreach ($elements as $element)--}}
            {{-- "Three Dots" Separator --}}
            {{--@if (is_string($element))--}}
                {{--<li class="disabled"><span>{{ $element }}</span></li>--}}
            {{--@endif--}}

            {{-- Array Of Links --}}
            {{--@if (is_array($element))--}}
                {{--@foreach ($element as $page => $url)--}}
                    {{--@if ($page == $paginator->currentPage())--}}
                        {{--<li class="active"><span>{{ $page }}</span></li>--}}
                    {{--@else--}}
                        {{--<li><a href="{{ $url }}">{{ $page }}</a></li>--}}
                    {{--@endif--}}
                {{--@endforeach--}}
            {{--@endif--}}
        {{--@endforeach--}}

        {{-- Next Page Link --}}
        {{--@if ($paginator->hasMorePages())--}}
            {{--<li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>--}}
        {{--@else--}}
            {{--<li class="disabled"><span>&raquo;</span></li>--}}
        {{--@endif--}}
    {{--</ul>--}}
{{--@endif--}}

@if ($paginator->hasPages())
<div class="container">
    <div class="row">
        <div class="col s12 center-align">
            <ul class="pagination">

                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <li class="disabled pagination__arrow--first"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                @else
                    <li class="waves-effect pagination__arrow--first"><a href="{{ $paginator->previousPageUrl() }}"><i class="material-icons">chevron_left</i></a></li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                    {{-- "Three Dots" Separator --}}
                    @if (is_string($element))
                        <li class="disabled"><span>{{ $element }}</span></li>
                    @endif

                    {{-- Array Of Links --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="active pagination__current"><a href="#!">{{ $page }}</a></li>
                            @else
                                <li class="waves-effect"><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <li class="waves-effect pagination__arrow--last"><a href="{{ $paginator->nextPageUrl() }}"><i class="material-icons">chevron_right</i></a></li>
                @else
                    <li class="disabled pagination__arrow--last"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                @endif


            </ul>
        </div>
    </div>
</div>
@endif