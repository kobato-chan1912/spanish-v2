<!DOCTYPE html>
<html lang="es">

@php
    $title = \App\Models\Config::where("config_name", "home_title")->first()->config_value;
    $description = \App\Models\Config::where("config_name", "home_description")->first()->config_value;

@endphp
@include('webpage.layouts.head', [
    'title' => $title,
    'og_des' =>
        $description,
    'og_title' => $title,
])

<body>
@include("webpage.layouts.header")
<section class="body">
    <div class="banner">
        <div class="container">
            @include("layouts.search_box")
            <br>
            <div style="clear:both;"></div>
{{--            <span--}}
{{--                style="display:block; text-align:center;border-bottom:1px solid #ededed;margin-bottom:5px;">Advertisement</span>--}}

            <!-- yo-h -->
            <div style="clear:both;"></div>
            <br>
        </div>

    </div>
    <div class="container b_margin" style="margin-top: 0;">
        <!-- <div class="container">-->


        <script>
            $(document).ready(function () {
                $("#btnViewMore").on("click", function (e) {
                    e.preventDefault();
                    $(".page-description").toggleClass("summary");
                    if ($(this).text() == "Lee mas") {
                        $(this).text("Esconder");
                    } else {
                        $(this).text("Lee mas");
                    };
                });
            });

            // jQuery(document).ready(function($){
            // 	$("#btnViewMore").on("click", function(e) {
            // 		e.preventDefault();
            // 		$(".page-description").toggleClass("summary");
            // 		if ($(this).text() == "Lee mas") {
            // 			$(this).text("Esconder");
            // 		} else {
            // 			$(this).text("Lee mas");
            // 		};
            // 	});
            // });
        </script>
        <div class="col-md-7">
            <div class="box column-1">
                <a href="{{route("newest")}}">
                    <h2 class="title"><i class="fa fa-music" aria-hidden="true"></i> Últimos tonos de llamada  </h2>
                </a>


                <ul class="list_apps">

                    @foreach ($newestSongs as $song)
                        <li class="app_item">
                            <script type="text/javascript" defer>
                                var jQInit = jQInit || [];
                                jQInit.push(['myModule{{ $song->id }}', function($) {
                                    jQuery(window).on('load', function($) {
                                        iniPlayer('{{ $song->id }}', "{{ $song->url }}");
                                    });
                                }]);
                            </script>
                            <div class="app_thumb">
                                <div id="jquery_jplayer_{{ $song->id }}" class="cp-jplayer"></div>
                                <div id="cp_container_{{ $song->id }}" class="cp-container">
                                    <div class="cp-buffer-holder">
                                        <!-- .cp-gt50 only needed when buffer is > than 50% -->
                                        <div class="cp-buffer-1"></div>
                                        <div class="cp-buffer-2"></div>
                                    </div>
                                    <div class="cp-progress-holder">
                                        <!-- .cp-gt50 only needed when progress is > than 50% -->
                                        <div class="cp-progress-1"></div>
                                        <div class="cp-progress-2"></div>
                                    </div>
                                    <div class="cp-circle-control"></div>
                                    <ul class="cp-controls">
                                        <li><a href="#" class="cp-play cp-play-{{ $song->id }}"
                                               tabindex="1">play</a></li>
                                        <li><a href="#" class="cp-pause cp-pause-{{ $song->id }}"
                                               style="display:none;" tabindex="1">pause</a></li>
                                        <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
                                    </ul>
                                </div>
                            </div>
                            <a href="/{{ $song->slug }}" class="app_name" title="">{{ $song->title }}</a>
                            <div class="starsx">
                                <span><i class="fa fa-eye" aria-hidden="true"></i> {{ $song->listeners }}</span>
                                <span><i class="fa fa-download" aria-hidden="true"></i>
                                        {{ $song->downloads }}</span>
                                <span><i class="fa fa-file-audio-o" aria-hidden="true"></i>
                                        {{ $song->size }}</span>
                            </div>
                            {{-- <div class="developer"><i class="fa fa-eye" aria-hidden="true"></i> {{$song->listeners}}</div> --}}
                        </li>
                    @endforeach

                </ul>
            </div>

            <div class="wp-pagenavi box" role="navigation">
                    <span class="pages">Página @if (request()->has('page'))
                            {{ $page }}
                        @else
                            1
                        @endif de {{ $newestSongs->lastPage() }}</span>
                @if ($page == 1 || !isset($page))
                    @if ($newestSongs->lastPage() == 1)

                        <a class="page smaller current" title="Page 1" href="{{ $url }}1">1</a>
                    @else
                        {{-- In first page --}}

                        <a class="page smaller current" title="Page 1" href="{{ $url }}1">1</a>
                        <a class="page smaller" title="Page 2" href="{{ $url }}2">2</a>
                        @if ($newestSongs->lastPage() >= 3)
                            <a class="page smaller" title="Page 3" href="{{ $url }}3">3</a>
                        @endif
                        <a class="last" href="{{ $url }}2">Next »</a>
                    @endif
                @elseif($page != 1 && $page != $newestSongs->lastPage())
                    <a class="first" href="{{ $url }}{{ $page - 1 }}">« Back</a>
                    <a class="page smaller" href="{{ $url }}{{ $page - 1 }}">{{ $page - 1 }}</a>
                    <a class="page smaller current"
                       href="{{ $url }}{{ $page }}">{{ $page }}</a>
                    <a class="page smaller" href="{{ $url }}{{ $page + 1 }}">{{ $page + 1 }}</a>
                    <a class="last" href="{{ $url }}{{ $page + 1 }}">Next »</a>
                @else
                    <a class="first" href="{{ $url }}{{ $page - 1 }}">« Back</a>
                    <a class="page smaller" href="{{ $url }}{{ $page - 1 }}">{{ $page - 1 }}</a>
                    <a class="page smaller current"
                       href="{{ $url }}{{ $page }}">{{ $page }}</a>
                @endif
            </div>
            <div class="box column-1">
                <a href="{{route("lost_mejores")}}">
                    <h2 class="title"><i class="fa fa-music" aria-hidden="true"></i> TOP tonos de llamada  </h2>
                </a>

                <ul class="list_apps">
                    @php
                        $populars = \App\Models\Song::orderBy('downloads', 'desc')
                            ->where('display', 1)
                            ->limit(5)
                            ->get();
                    @endphp
                    @foreach ($populars as $song)
                        <li class="app_item">
                            <script type="text/javascript" defer>
                                var jQInit = jQInit || [];
                                jQInit.push(['myModule{{ $song->id }}', function($) {
                                    jQuery(window).on('load', function($) {
                                        iniPlayer('{{ $song->id }}', "{{ $song->url }}");
                                    });
                                }]);
                            </script>
                            <div class="app_thumb">
                                <div id="jquery_jplayer_{{ $song->id }}" class="cp-jplayer"></div>
                                <div id="cp_container_{{ $song->id }}" class="cp-container">
                                    <div class="cp-buffer-holder">
                                        <!-- .cp-gt50 only needed when buffer is > than 50% -->
                                        <div class="cp-buffer-1"></div>
                                        <div class="cp-buffer-2"></div>
                                    </div>
                                    <div class="cp-progress-holder">
                                        <!-- .cp-gt50 only needed when progress is > than 50% -->
                                        <div class="cp-progress-1"></div>
                                        <div class="cp-progress-2"></div>
                                    </div>
                                    <div class="cp-circle-control"></div>
                                    <ul class="cp-controls">
                                        <li><a href="#" class="cp-play cp-play-{{ $song->id }}"
                                               tabindex="1">play</a></li>
                                        <li><a href="#" class="cp-pause cp-pause-{{ $song->id }}"
                                               style="display:none;" tabindex="1">pause</a></li>
                                        <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
                                    </ul>
                                </div>
                            </div>
                            <a href="/{{ $song->slug }}" class="app_name"
                               title="">{{ $song->title }}</a>
                            <div class="starsx">
                                    <span><i class="fa fa-eye" aria-hidden="true"></i>
                                        {{ $song->listeners }}</span>
                                <span><i class="fa fa-download" aria-hidden="true"></i>
                                        {{ $song->downloads }}</span>
                                <span><i class="fa fa-file-audio-o" aria-hidden="true"></i>
                                        {{ $song->size }}</span>
                            </div>
                            {{-- <div class="developer"><i class="fa fa-eye" aria-hidden="true"></i> {{$song->listeners}}</div> --}}
                        </li>
                    @endforeach

                </ul>
            </div>

        </div>

        <div class="col-md-5">
            <div class="box">
                &nbsp; &nbsp;<a href="{{route("lost_mejores")}}" title="Tonos de llamada populares">
                    <h2 class="title"><i class="fa fa-music" aria-hidden="true"></i>  Mejores tonos de llamada </h2>
                </a>
                <ul class="list_apps">


                    @foreach ($bestSongs as $song)
                        <li class="app_item">
                            <script type="text/javascript" defer>
                                var jQInit = jQInit || [];
                                jQInit.push(['myModule{{ $song->id }}', function($) {
                                    jQuery(window).on('load', function($) {
                                        iniPlayer('{{ $song->id }}', "{{ $song->url }}");
                                    });
                                }]);
                            </script>
                            <div class="app_thumb">
                                <div id="jquery_jplayer_{{ $song->id }}" class="cp-jplayer"></div>
                                <div id="cp_container_{{ $song->id }}" class="cp-container">
                                    <div class="cp-buffer-holder">
                                        <!-- .cp-gt50 only needed when buffer is > than 50% -->
                                        <div class="cp-buffer-1"></div>
                                        <div class="cp-buffer-2"></div>
                                    </div>
                                    <div class="cp-progress-holder">
                                        <!-- .cp-gt50 only needed when progress is > than 50% -->
                                        <div class="cp-progress-1"></div>
                                        <div class="cp-progress-2"></div>
                                    </div>
                                    <div class="cp-circle-control"></div>
                                    <ul class="cp-controls">
                                        <li><a href="#" class="cp-play cp-play-{{ $song->id }}"
                                               tabindex="1">play</a></li>
                                        <li><a href="#" class="cp-pause cp-pause-{{ $song->id }}"
                                               style="display:none;" tabindex="1">pause</a></li>
                                        <!-- Needs the inline style here, or jQuery.show() uses display:inline instead of display:block -->
                                    </ul>
                                </div>
                            </div>
                            <a href="/{{ $song->slug }}" class="app_name"
                               title="">{{ $song->title }}</a>
                            <div class="starsx">
                                    <span><i class="fa fa-eye" aria-hidden="true"></i>
                                        {{ $song->listeners }}</span>
                                <span><i class="fa fa-download" aria-hidden="true"></i>
                                        {{ $song->downloads }}</span>
                                <span><i class="fa fa-file-audio-o" aria-hidden="true"></i>
                                        {{ $song->size }}</span>
                            </div>
                            {{-- <div class="developer"></div> --}}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="col-md-5">
            <div class="box">
                &nbsp; &nbsp;
                <h2 class="title"><i class="fa fa-music" aria-hidden="true"></i> Categorías
                </h2>

                <ul class="list_apps">

                    @php $categories = \App\Models\Category::all(); @endphp
                    @foreach ($categories as $category)
                        <li class="list-group-item col-md-6">
                            <a href="/{{$category->category_slug}}"
                                                                         title="alarma ringtone collection"><i class="fa fa-archive" aria-hidden="true"></i>
                                {{$category->category_name}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>







{{--            style="display:block; text-align:center;border-bottom:1px solid #ededed;margin-bottom:5px;">Advertisement</span>--}}

        <!-- yo-s -->
        <br>
        <div class="col-md-12 vtn-home">
            <div class="box gt-box">
                <br>
                <div id="container-cfq">
                    <div class="page-description summary">
                        <div class="center" style="text-align: center">
                            <h1 class="gt-title page-title"><i class="fa fa-bullhorn" aria-hidden="true">
                                    Descargar Tono
                                    de llamada 2022 mp3 gratis para tel&eacute;fonos
                                </i></h1>
                        </div>
                            <div class="entry-content">
                                @php echo $post @endphp
                            </div>


                        <div class="button">
                            <button type="button" id="btnViewMore">Lee mas</button>
                        </div>
                    </div>
                    &nbsp; &nbsp; &nbsp; &nbsp;
                </div>

                <div class="gt-container" style="display:none;">
                    <!--//chen thong bao cho trang chu o day-->
                    Download free ringtone for all mobile devices with more than 95.000 ringtones such as <a
                        href="https://bestringtonesfree.net/funny-ringtones/">funny ringtone</a>, animal ringtone,
                    <a href="https://bestringtonesfree.net/bollywood/">Bollywood ringtone</a>, etc


                </div>
            </div>
        </div>

    </div>
</section>
@include("webpage.layouts.footer")

</body>

</html>
