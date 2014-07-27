<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Fipra :: {{ $page_title }}</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <!--jQuery-->
        <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/themes/smoothness/jquery-ui.css" />
        <!--<script src="{{ asset('css/jquery-ui.css') }}"></script>-->
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>-->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <!--<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.0/jquery-ui.min.js"></script>-->
        <script src="{{ asset('js/jquery-ui.min.js') }}"></script>

        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div class="content-container">
            
                <nav>
                    <div class="links-toggle">
                      <a href="#" class="but-toggle"><i class="fa fa-caret-down"></i> SHOW MENU</a>
                    </div>
                    <ul>
                        @yield('nav_links')
                    </ul>
                </nav>
            <header>
                <div id="logo">
                    <img src="{{ asset('img/fipra_logo.gif') }}" alt="Fipra - Professional Public Affairs in More Than 50 Countries">
                </div>
                <div id="page-title">
                    <h1>{{ $page_title }}</h1>
                </div>
            </header>
            
            <section id="content">
                @yield('content')
            </section>
        </div>

        <div class="container">
            <footer>
                <p>&copy; Fipra <?php echo date("Y"); ?>. All Rights Reserved.<br><a href="http://fipra.com/other~3/code_of_conduct~7/" target="_blank">Code of conduct</a></p>
                <script src="{{ asset('js/site.js') }}"></script>
            </footer>
        </div>


    </body>
</html>