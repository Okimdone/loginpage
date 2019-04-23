<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>

    @yield('CssAndScripts')

    <!--Import Google Icon Font
      <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    -->

    <!--Import materialize.css -->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>


    <!--<link rel="stylesheet" href="V/assets/css/css.css">-->
    <script src="js/jquery-dev.js"></script>
    <script type="text/javascript" src="js/login.js"></script>
    <!-- Profs scripts -->
    <script type="text/javascript" src="js/homeProf.js"></script>
</head>
<body>

    @yield('body')

    <!--JavaScript at end of body for optimized loading
    <script type="text/javascript" src="js/materialize.min.js"></script>
    -->
</body>
</html>
