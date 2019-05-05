<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Myjob · @yield('title', isset($title) ? $title: 'AGEPOLY')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('contents/images/favicon.png') }}">
</head>
<body>

<div class="ui container centered stackable grid content-wrapper">
    @yield('content')
</div>

</body>
</html>
