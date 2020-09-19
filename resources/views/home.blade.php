<!DOCTYPE html>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1,
           maximum-scale=1, user-scalable=no, minimal-ui">
        <meta name="csrf_token" content="{{csrf_token()}}">
        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">

    </head>

    <body>

        <div id="app">
            <app-home></app-home>
        </div>

        <script src="{{asset('js/app.js')}}"></script>

    </body>
</html>
