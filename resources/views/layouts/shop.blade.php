<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/reservation.css" rel="stylesheet">
    <link href="/css/vendors.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body  ng-app="copya-shop"  style="border-left:70px solid #2b303b; border-top: 60px solid #2b303b;">

@yield('content')


        <!-- Scripts -->
<script src="/js/copya.shop.js"></script>
</body>
</html>
