<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
 
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MyLearning') }}</title>

    {{-- jQuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5dea42618ba87a0012fb48cc&product=inline-share-buttons" async="async"></script>
    
    {{-- oEmbed API CDN --}}
    {{-- <script charset="utf-8" src="//cdn.iframe.ly/embed.js?api_key={API KEY}"></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
    @include('inc.navbar')
    <main role="main">
        @if (Request::is('/'))
            @include('inc.showcase')
        @endif
        {{-- <div class="container"> --}}
            @include('inc.messages')
            @yield('content')
        {{-- </div>         --}}
    </main>
    
    @include('inc.footer')
    
</body>
</html>

{{-- <div class="container-fluid">
        @include('inc.navbar')

        @if (Request::is('profile*' ,'created-content*' ,'saved-content*'))
            <div class="main-content" id="main-content">
                <div class="content-container">
                    <div class="edit-template">
                        <div class="main-section">
                            <div class="side-nav" id="sidebar" role="navigation">
                                @include('inc.sidebar-profile')
                            </div>
                            <div class="content" id="content">
                                @include('inc.messages')
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif (Request::is('posts*'))
            <div class="main-content" id="main-content">
                <div class="content-container">
                    <div class="edit-template">
                        <div class="main-section">
                            <div class="side-nav" id="sidebar" role="navigation">
                                @include('inc.sidebar')
                            </div>
                            <div class="content" id="content">
                                @include('inc.messages')
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="main-content" id="maincontent">
                <div class="content-container">
                    <div class="edit-template">
                        @if (Request::is('/'))
                            @include('inc.showcase')
                        @endif
                        @include('inc.messages')
                        @yield('content')
                    </div>
                </div>
            </div>
        @endif
    </div> --}}