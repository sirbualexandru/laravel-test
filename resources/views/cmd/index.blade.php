<!DOCTYPE html>
<html lang="en-us" id="extr-page">
<head>
    <meta charset="utf-8">
    <title> artisan cmd area </title>
    <base href="<?php echo url('/'); ?>" />

    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- #CSS Links -->
    <!-- Basic Styles -->
    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">

    <!-- #GOOGLE FONT -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">
</head>

<body class="animated fadeInDown">

<div class="container">
    <h3 class="title">Artisan commands</h3>
    <hr>
    <a href="/cmd/artisan/config:cache" class="btn btn-primary">Artisan config:cache</a>

    <a href="/cmd/artisan/config:clear" class="btn btn-primary">Artisan config:clear</a>

    <a href="/cmd/artisan/cache:clear" class="btn btn-primary">Artisan cache:clear</a>

    <a href="/cmd/artisan/migrate" class="btn btn-primary">Artisan migrate</a>

    <a href="/cmd/artisan/db:seed" class="btn btn-primary">Artisan seed</a>

    <a href="/cmd/artisan/migrate:refresh" class="btn btn-warning">Artisan migrate refresh and seed</a>

    <hr>
    <h3 class="title">Artisan commands output</h3>
    <hr>
    @if(session('output'))
        <pre>{{ session('output') }}</pre>
    @endif
</div>

<!--================================================== -->

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    if (!window.jQuery) {
        document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');
    }
</script>

<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    if (!window.jQuery.ui) {
        document.write('<script src="js/libs/jquery-ui-1.10.3.min.js"><\/script>');
    }
</script>
<!-- BOOTSTRAP JS -->
<script src="js/bootstrap/bootstrap.min.js"></script>

</body>
</html>