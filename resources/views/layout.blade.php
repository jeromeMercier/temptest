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
    <?php
    $links = array(
      "home" => "/",
      "create" =>"/new-job",
      "help" => "/help",
      "login" =>"/log",
    );
    if($auth){
      array_push($links, "Mes jobs", "options");
      $links["Mes jobs"] = '/dickdick';
    }
    ?>
    <myjob-navbar links='{!!json_encode($links)!!}'></myjob-navbar>
    <v-content>
      <v-container fluid fill-height>
        @yield('content')
      </v-container>
    </v-content>
    <myjob-footer></myjob-footer>
  </v-app>

<script type="text/javascript" src="/js/app.js"></script>
</body>
</html>
