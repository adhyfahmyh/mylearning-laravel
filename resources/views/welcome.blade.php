@extends('layouts.app')

@section('content')
    <div class="landing-page">
        <div class="welcome">
            <h2 style="font-weight:bold;">Selamat datang, {{Auth::user()->firstname}} {{Auth::user()->lastname}}</h2>
        </div>
        <hr>
        {{-- <div class="recommendation">
            <hr>
            <h4>Konten pembelajaran dengan rating tertinggi:</h4>
            @if(count($contents) > 0)
                <div class="card-deck" style="max-width:100%;">
                    @foreach($contents as $content)
                        <div class="col-md-3">
                            @if (empty($content->content_img))
                                <img src="https://www.litmos.com/wp-content/uploads/2016/06/blog-eLearning-templates.png" alt="post_image" class="card-img-top" height="250">
                            @else
                                <img src="{{ url('/data_file/images/'.$content->content_img) }}" alt="post_image" class="card-img-top" height="250">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title mb-0">{{ $content->title }}</h5><hr>
                                @if (empty($content->description))
                                    <p class="card-text"><small>Tidak ada deskripsi</small></p>
                                @else
                                    <p class="card-text"><small>{{$content->description}}</small></p>
                                @endif
                                @if (empty($content->rating))
                                    <p class="mb-0">
                                        <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUzLjg2NyA1My44NjciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUzLjg2NyA1My44Njc7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRUZDRTRBOyIgcG9pbnRzPSIyNi45MzQsMS4zMTggMzUuMjU2LDE4LjE4MiA1My44NjcsMjAuODg3IDQwLjQsMzQuMDEzIDQzLjU3OSw1Mi41NDkgMjYuOTM0LDQzLjc5OCAgIDEwLjI4OCw1Mi41NDkgMTMuNDY3LDM0LjAxMyAwLDIwLjg4NyAxOC42MTEsMTguMTgyICIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" height="25"/>
                                        <small>belum ada rating</small>
                                    </p>
                                @else
                                    <p class="mb-0">
                                        <img src="data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDUzLjg2NyA1My44NjciIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUzLjg2NyA1My44Njc7IiB4bWw6c3BhY2U9InByZXNlcnZlIiB3aWR0aD0iNTEycHgiIGhlaWdodD0iNTEycHgiPgo8cG9seWdvbiBzdHlsZT0iZmlsbDojRUZDRTRBOyIgcG9pbnRzPSIyNi45MzQsMS4zMTggMzUuMjU2LDE4LjE4MiA1My44NjcsMjAuODg3IDQwLjQsMzQuMDEzIDQzLjU3OSw1Mi41NDkgMjYuOTM0LDQzLjc5OCAgIDEwLjI4OCw1Mi41NDkgMTMuNDY3LDM0LjAxMyAwLDIwLjg4NyAxOC42MTEsMTguMTgyICIvPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K" height="25"/>
                                        {{ $content->rating }}
                                        <small>/10</small>
                                    </p>
                                @endif
                                <a href="/contents/{{$content->id}}" class="stretched-link"></a>
                            </div>
                            <div class="card-footer" style="background:none; border:none;">
                                <a href="/contents/{{$content->id}}" class="btn btn-success stretched-link col-md-12">Pelajari</a>
                            </div>
                            <div class="card-footer">
                                <small class="text-muted">Dibuat pada: {{date('d-m-Y', strtotime($content->created_at))}}</small>
                            </div><br>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="col-md-12" style="text-align:center;">
                    <br><br>
                    <p>Tidak Tersedia</p>
                </div>
            @endif
        </div> --}}
        <div class="start-learning">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <a href="contents" class="btn btn-primary btn-lg btn-block" style="padding:10px">
                        <h3 class="mb-0">Mulai Belajar</h3>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection