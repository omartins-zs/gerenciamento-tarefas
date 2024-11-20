<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div id="app"></div> <!-- Vue.js será montado aqui -->

    @vite('resources/js/app.js')
</body>
</html>
