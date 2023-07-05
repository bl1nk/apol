<html>
    <head>
        <title>Apol - @yield('title')</title>
        <meta name="viewport" content="width=device-width, viewport-fit=cover,initial-scale=1.0,user-scalable=no" />
        <script src="https://unpkg.com/htmx.org@1.9.2/dist/htmx.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
        <link rel="manifest" href="manifest.json">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="application-name" content="Apol">
        <meta name="apple-mobile-web-app-title" content="Apol">
        <meta name="theme-color" content="#121823">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <style>
            {!! Helpers::embed('apol.css') !!}
            {!! Helpers::embed('tinting.css') !!}
        </style>
        @if(Helpers::is_production())
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-GLLFFQ7PRP"></script>
            <script>
                window.gaId = 'G-GLLFFQ7PRP';
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
                gtag('config', window.gaId);

                document.addEventListener('DOMContentLoaded', function() {
                    document.body.addEventListener('htmx:afterSwap', function(event) {
                        var newUrl = event.detail.xhr.responseURL;
                        gtag('config', window.gaId, {
                            'page_path': newUrl
                        });
                    });
                });
            </script>
        @endif
    </head>
    <body class="tint-bg-down-5" id="body">
        @include('partials.title-bar', ['page_title' => $page_title])
        @if(isset($is_content_fetch) && $is_content_fetch || !$async_load)
            <div class="container tint-bg-down-0">
                @yield('content')
            </div>
        @else
            <div class="container tint-bg-down-0" hx-get="?fetch" hx-select=".container" hx-swap="outerHTML" hx-trigger="load">
                @include('partials.ghost-cards')
            </div>
        @endif
        @include('partials.tab-bar')
    </body>
    <script type="text/javascript">
        {!! Helpers::embed('apol.js') !!}
    </script>
</html>