<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Admin panel - @yield('title')</title>
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <div id="app">
            <navbar></navbar>
            @yield('content')
        </div>
        <script src="{{ URL::asset('./js/app.js') }}"></script>
    </body>
</html>
