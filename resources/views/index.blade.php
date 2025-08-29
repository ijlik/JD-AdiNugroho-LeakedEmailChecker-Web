<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Leaked Email Checker</title>
    <meta name="robots" content="index, follow"/>
    <meta name="keywords" content="Email Checker, Email Hacked, Email Breach, Email Pwned"/>
    <meta name="description" content="This is Bitlion free service to check your email is already breach or not"/>

    <!-- favicons -->
    <link rel="shortcut icon" href="/images/favicon.png">

    <!-- Style CSS -->
    <link rel="stylesheet" type="text/css" href="/fonts/jost/stylesheet.css"/>
    <link rel="stylesheet" type="text/css" href="/libs/line-awesome/css/line-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="/libs/fontawesome-pro/css/fontawesome.css"/>
    <link rel="stylesheet" type="text/css" href="/libs/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="/libs/slick/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="/libs/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/libs/quilljs/css/quill.bubble.css"/>
    <link rel="stylesheet" type="text/css" href="/libs/quilljs/css/quill.core.css"/>
    <link rel="stylesheet" type="text/css" href="/libs/quilljs/css/quill.snow.css"/>
    <link rel="stylesheet" type="text/css" href="/libs/chosen/chosen.min.css"/>
    <link rel="stylesheet" type="text/css" href="/libs/datetimepicker/jquery.datetimepicker.min.css"/>
    <link rel="stylesheet" type="text/css" href="/libs/venobox/venobox.css"/>
    <link rel="stylesheet" type="text/css" href="/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/css/responsive.css"/>
    <!-- jQuery -->
    <script src="/js/jquery-1.12.4.js"></script>
    <script src="/libs/popper/popper.js"></script>
    <script src="/libs/bootstrap/js/bootstrap.min.js"></script>
    <script src="/libs/slick/slick.min.js"></script>
    <script src="/libs/slick/jquery.zoom.min.js"></script>
    <script src="/libs/isotope/isotope.pkgd.min.js"></script>
    <script src="/libs/quilljs/js/quill.core.js"></script>
    <script src="/libs/quilljs/js/quill.js"></script>
    <script src="/libs/chosen/chosen.jquery.min.js"></script>
    <script src="/libs/datetimepicker/jquery.datetimepicker.full.min.js"></script>
    <script src="/libs/venobox/venobox.min.js"></script>
    <script src="/libs/waypoints/jquery.waypoints.min.js"></script>
    <!-- orther script -->
    <script src="/js/main.js"></script>
</head>

<body>
<div id="wrapper">
    <header id="header" class="site-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-5">
                    <div class="site">
                        <div class="site__brand">
                            <a title="Logo" href="https://email-check.bitlion.io" class="site__brand__logo"><img
                                    src="/images/assets/logo.png" alt="Golo"></a>
                        </div><!-- .site__brand -->

                    </div><!-- .site -->
                </div><!-- .col-md-6 -->
                <div class="col-xl-6 col-7">
                    <div class="right-header align-right">
                        <div class="right-header__button btn" style="background-color: #212529">
                            <a title="Add place" href="https://bitlionai.com">
                                <i class="las la-arrow-circle-left la-24-white"></i>
                                <span>Back to Bitlion</span>
                            </a>
                        </div><!-- .right-header__button -->
                    </div><!-- .right-header -->
                </div><!-- .col-md-6 -->
            </div><!-- .row -->
        </div><!-- .container-fluid -->
    </header><!-- .site-header -->

    <main id="main" class="site-main overflow">
        <div class="site-banner">
            <div class="container">
                <div class="site-banner__content">
                    <h1 class="site-banner__title">Check Your Email</h1>
                    <form action="/" method="POST" class="site-banner__search layout-02">
                        @csrf
                        <div class="field-input">
                            <label for="s">Email</label>
                            <input class="site-banner__search__input open-suggestion" id="s" type="text" name="email"
                                   value="{{ $email ?? '' }}" required placeholder="Ex: jhondoe@gmail.com"
                                   autocomplete="off">
                        </div>
                        <div class="field-submit">
                            <button type="submit" style="background-color: #212529"><i
                                    class="las la-search la-24-black"></i></button>
                        </div>
                    </form><!-- .site-banner__search -->
                    @if($error)
                        <p class="site-banner__meta">
                            <span style="color: darkred">{{ $error }}</span>
                        </p><!-- .site-banner__meta -->
                    @else
                        <p class="site-banner__meta">
                            <span>Check if your email is in a data breach</span>
                        </p><!-- .site-banner__meta -->
                    @endif
                </div><!-- .site-banner__content -->
            </div>
        </div><!-- .site-banner -->
    </main><!-- .site-main -->

    @if($search && $data === [] && $error === null)
        <section class="cities-wrap" style="background-image: url(images/workspace/bg-world.png);">
            <div class="container">
                <div class="title-wrap align-center">
                    <h2>Good — Your email is not in any data breach!</h2>
                </div>
            </div>
        </section>
    @endif

    @if($search && $data !== [] && $error === null)
        <section class="cities-wrap" style="background-image: url(images/workspace/bg-world.png);">
            <div class="container">
                <div class="title-wrap align-center">
                    <h2>Oh no — Your email "{{ $email }}" is in a data breach!</h2>
                    <p>Breaches you were pwned in</p>
                </div>
                <div class="row">
                    @foreach($data as $item)
                        <div class="col-12 col-md-12 col-lg-12">
                            <div class="item hover-img">
                                <div class="item-inner"
                                     style="background-color: #320f0f; background-image: linear-gradient(to bottom right, #320f0f, #b94243);">
                                    <div class="row">
                                        <div class="col-md-2 text-center">
                                            <img style="margin-top: 20px;" src="{{ $item['LogoPath'] }}" alt="">
                                        </div>
                                        <div class="col-md-10">
                                            <div class="entry-detail" style="max-width: 100%;">
                                                <h3 style="color: white; margin-top: 20px;">{!! $item['Description'] !!}</h3>
                                                <span
                                                    style="color: #dedede; margin-bottom: 20px">Compromised data: {{ implode(',', $item['DataClasses']) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <footer id="footer" class="footer">
        <div class="container">
            <div class="footer__top">
                <div class="img-box-inner" style="margin-bottom: 0px">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 mt-3 text-center">
                                <h3>15,097,955,181</h3>
                                <p>pwned accounts</p>
                            </div>
                            <div class="col-md-6 mt-3 text-center">
                                <h3>902</h3>
                                <p>pwned websites</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <p class="footer__bottom__copyright">{{ now()->format('Y') }} &copy;
                    <a title="Bitlion" href="https://bitlionai.com" style="color: #212529; text-decoration: underline">bitlionai.com</a>.
                    All rights reserved.</p>
            </div><!-- .top-footer -->
        </div><!-- .container -->
    </footer><!-- site-footer -->
</div><!-- #wrapper -->
</body>
</html>
