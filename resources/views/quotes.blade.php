<html>
    <head>
        <title>{{ $guild->name }} Quotes</title>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app" class="table-responsive">
            <quotes></quotes>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
