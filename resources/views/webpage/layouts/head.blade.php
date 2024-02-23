<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title}}</title>
    <link rel="icon" href="/webpage/favicons/fav.ico">
    <meta property="og:locale" content="es">
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1'/>
    <meta property="title" content="{{$og_title}}">
    <meta property="description" content="{{$og_des}}">
    <meta name="description" content="{{$og_des}}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{$og_title}}">
    <meta property="og:description" content="{{$og_des}}">
    <meta property="og:url" content="{{URL::current()}}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/webpage/js/js-jqinit.js" async></script>
    <script>
        var jQInit = jQInit || [];
        jQInit.push(['myModule', function ($) {
            [
                // '/webpage/js/jquery-1.9.1.min.js',
                '/webpage/js/modernizr.min.js',
                // '/webpage/js/jplayer/circleplayer//webpage/js/jquery.transform.js',
                '/webpage/js/jquery.grab.js',
                '/webpage/js/jquery.jplayer.min.js',
                //'/webpage/js/jplayer/circleplayer//webpage/js/mod.csstransforms.min.js',
                '/webpage/js/circle.player.js',
                '/webpage/js/custom.js',
                '/webpage/js/bootstrap.min.js',
            ].forEach(function (src) {
                var script = document.createElement('script');
                script.src = src;
                script.async = false;
                document.head.appendChild(script);
            });
        }]);
    </script>


    <link rel="dns-prefetch" href="//s.w.org">
    <link rel="stylesheet" href="https://use.typekit.net/nii3adk.css">
    <link rel="stylesheet" id="wp-block-library-css" href="/webpage/css/block-library-style.min.css" type="text/css"
          media="all">
    <link rel="stylesheet" id="wp-pagenavi-css" href="/webpage/css/wp-pagenavi-pagenavi-css.css" type="text/css"
          media="all">
    <link rel="stylesheet" id="main-style-css" href="/webpage/css/main-style.css" type="text/css" media="all">
    <link rel="stylesheet" id="bootstrap-css-css" href="/webpage/css/css-bootstrap.css" type="text/css" media="all">
    <link rel="stylesheet" id="fontawesome-css-css" href="/webpage/css/css-font-awesome.min.css" type="text/css"
          media="all">
    <link rel="stylesheet" id="style-css-css" href="/webpage/css/css-style.css" type="text/css" media="all">
    <link rel="stylesheet" id="circle-player-style-css" href="/webpage/css/circle.skin-circle.player.css"
          type="text/css"
          media="all">
    <link rel="stylesheet" id="circle-monday-style-css" href="/webpage/css/css-jplayer.blue.monday.min.css"
          type="text/css"
          media="all">
    <style type="text/css" id="wp-custom-css">


        .col-md-12{
            padding-left: 1px;
            padding-right: 1px;
        }

        @media (max-width: 767px)
        {
            .container.b_margin{
                padding-left: 1px;
                padding-right: 1px;
            }
        }


        .button-45 {
            align-items: center;
            background-color: #c27cf7;
            background-position: 0 0;
            border: 1px solid #c27cf7;
            border-radius: 11px;
            box-sizing: border-box;
            color: white;
            cursor: pointer;
            display: flex;
            font-size: 2rem;
            font-weight: 700;
            line-height: 33.4929px;
            list-style: outside url(https://www.smashingmagazine.com/images/bullet.svg) none;
            padding: 2px 12px;
            text-align: left;
            text-decoration: none;
            text-shadow: none;
            text-underline-offset: 1px;
            transition: border .2s ease-in-out,box-shadow .2s ease-in-out;
            user-select: none;
            -webkit-user-select: none;
            touch-action: manipulation;
            white-space: nowrap;
            word-break: break-word;
        }

        .navbar-nav li a {
            color: #000000 !important;
        }

        .navbar-default .navbar-nav > .active > a {
            background-color: #dfb1ee !important;
        }

        #breadcrumbs a {
            color: #a739c6 !important;
        }

        .wp-pagenavi .current {
            background-color: #dfb1ee !important;
            color: #fff;
        }

        .wp-pagenavi a {
            color: black;
        }

    </style>
    <style>
        .entry-content {
            margin-bottom: 20px;
        }

        .page-description {
            padding: 20px 20px 50px;
            background-color: #f7f7f7;
            border: 2px solid #454545;
            border-radius: 10px;
            margin-bottom: 50px;
            position: relative;
        }

        .page-description .button {
            position: absolute;
            bottom: 15px;
            left: 0;
            width: 100%;
            z-index: 2;
            text-align: center;
        }

        .page-description .button button {
            background: #fd0be112;
            cursor: pointer;
            color: #fff;
            border: none;
            padding: 8px 15px;
            min-width: 180px;
            font-size: 18px;
            transition: background .2s linear;
        }

        .page-description.summary .entry-content {
            height: 110px;
            overflow: hidden;
            position: relative;
        }

        .entry-contentp {
            line-height: 1.5;
            margin: 0 0 20px;

        .page-description .button button:hover {
            background: #ee493f;
        }
    </style>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="revisit-after" content="1 days">
    <link rel="canonical" href="{{Request::fullUrl()}}"/>

    @if(isset($adsScript))
        @php echo $adsScript @endphp
    @endif

    @php
        $content = file_get_contents(storage_path("app/public/head.txt"));
        echo $content;
    @endphp


</head>
