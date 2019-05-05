<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Myjob · @yield('title', isset($title) ? $title: 'AGEPOLY')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('contents/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body>
  <v-app id="app">
  </v-app>

<script type="text/javascript" src="/js/app.js"></script>
</body>
</html>
