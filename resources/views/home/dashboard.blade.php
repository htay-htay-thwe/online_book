<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book Shop One</title>

    <!-- Swiper CSS -->
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Material Design Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/material-design-iconic-font@2.2.0/dist/css/material-design-iconic-font.min.css">


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-progressbar/0.9.0/bootstrap-progressbar-3.3.4.min.css"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/hamburgers/1.2.1/hamburgers.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.5/css/perfect-scrollbar.min.css"
        rel="stylesheet">

    <!-- Your Local Styles (replace with actual files if you have them locally) -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">


    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <!-- PAGE CONTAINER-->
    <div class="page-container">
        <!-- HEADER DESKTOP-->
        <header class="header-desktop">
            <div class="section__content section__content--p30">
                <div class="container-fluid">

                    <div class="menu-btn text-dark">
                        <i class="fas fa-bars"></i>
                    </div>

                    <div class=" header-wrap" style="z-index:0">

                        <form class="z-10 ml-5 form-header" action="{{ route('search') }}" method="POST">
                            @csrf
                            <input class="au-input au-input--xl" type="text" name="search"
                                placeholder="Search for datas &amp; reports..." />
                            <button class="au-btn--submit" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                        <div class="header-button">
                            <div class="noti-wrap">
                                <div class="noti__item js-item-menu">
                                    <i class="zmdi zmdi-notifications"></i>
                                    <span class="quantity">3</span>
                                    <div class="notifi-dropdown js-dropdown">
                                        <div class="notifi__title">
                                            <p>You have 3 Notifications</p>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c1 img-cir img-40">
                                                <i class="zmdi zmdi-email-open"></i>
                                            </div>
                                            <div class="content">
                                                <p>You got a email notification</p>
                                                <span class="date">April 12, 2018 06:50</span>
                                            </div>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c2 img-cir img-40">
                                                <i class="zmdi zmdi-account-box"></i>
                                            </div>
                                            <div class="content">
                                                <p>Your account has been blocked</p>
                                                <span class="date">April 12, 2018 06:50</span>
                                            </div>
                                        </div>
                                        <div class="notifi__item">
                                            <div class="bg-c3 img-cir img-40">
                                                <i class="zmdi zmdi-file-text"></i>
                                            </div>
                                            <div class="content">
                                                <p>You got a new file</p>
                                                <span class="date">April 12, 2018 06:50</span>
                                            </div>
                                        </div>
                                        <div class="notifi__footer">
                                            <a href="#">All notifications</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="account-wrap">
                                <div class="clearfix account-item js-item-menu">
                                    <div class="image">
                                        <img src="{{ Auth::user()->image ? asset('books/' . Auth::user()->image) : asset('images/default.png') }}"
                                            alt="{{ Auth::user()->name }}" />

                                    </div>
                                    <div class=" content" style="color: white;">
                                        <a class="js-acc-btn" href="#">{{ Auth::user()->name }}</a>
                                    </div>
                                    <div class="account-dropdown js-dropdown">
                                        <div class="clearfix info">
                                            <div class="image">
                                                <a href="#">
                                                    <img src="{{ Auth::user()->image ? asset('books/' . Auth::user()->image) : asset('images/default.png') }}"
                                                        alt="{{ Auth::user()->name }}" />

                                                </a>
                                            </div>
                                            <div class="content">
                                                <h5 class=" name">
                                                    <a href="#">{{ Auth::user()->name }}</a>
                                                </h5>
                                                <span class="email">{{ Auth::user()->email }}</span>
                                            </div>
                                        </div>
                                        <div class="account-dropdown__body">
                                            <div class="account-dropdown__item">
                                                <a href="{{ route('dashboard') }}">
                                                    <button type="submit" class="col-12"><i
                                                            class="fa-solid fa-key"></i>Password</button>
                                                </a>
                                            </div>
                                        </div>
                                        <form method="post" action="{{ route('logout') }}">
                                            @csrf
                                            <div class="account-dropdown__footer">
                                                <a><button type="submit" class="col-12 btn btn-danger"> <i
                                                            class="zmdi zmdi-power"></i>Logout</button></a>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="side-bar">
                <div class="close-btn">
                    <i class="fas fa-times"></i>
                </div>
                <div class="menu">
                    <div class="item"><a href="{{ route('dashboard') }}"><i
                                class="fas fa-desktop"></i>Dashboard</a></div>
                    <div class="item"><a class="sub-btn" href="#"><i class="fas fa-table"></i>Posts
                            <i class="fas fa-angle-right dropdown"></i></a>
                        <div class="sub-menu">
                            <a href="{{ route('post#createPage') }}" class="sub-item">Create Post</a>
                            <a href="#" class="sub-item">Sub Item 02</a>
                            <a href="#" class="sub-item">Sub Item 03</a>
                        </div>
                    </div>
                    <div class="item"><a href="{{ route('order#client') }}"><i class="fas fa-th"></i>Orders</a>
                    </div>
                    <div class="item"><a class="sub-btn" href="#"><i class="fas fa-cogs"></i>Settings
                            <i class="fas fa-angle-right dropdown"></i></a>
                        <div class="sub-menu">
                            <a href="#" class="sub-item">Sub Item 01</a>
                            <a href="#" class="sub-item">Sub Item 02</a>
                            <a href="#" class="sub-item">Sub Item 03</a>
                        </div>
                    </div>
                    <div class="item"><a href="#"><i class="fas fa-circle"></i>About</a></div>
                </div>
            </div>
        </header>
        <!-- HEADER DESKTOP-->
        @yield('scriptSource')

        @yield('content')
        <footer class="m-0">
            <div class="container-fluid ">
                <div class="row footer">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <p class="text-dark">Copyright ©2024 All rights reserved | This template is made <span
                                class="icon"><i class="fa-solid fa-heart"></i> </span><span
                                class="by">by</span> <span class="name">Htay Htay
                                Thwe</span></p>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                        <ul class="text-dark">
                            <li>About</li>
                            <li>subscribe</li>
                            <li>Contact</li>
                            <li>Support</li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Sidebar Script -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.sub-btn').click(function() {
                $(this).next('.sub-menu').slideToggle();
                $(this).find('.dropdown').toggleClass('rotate');

            });
            $('.menu-btn').click(function() {
                $('.side-bar').addClass('active');
                $('.menu-btn').css('visibility', 'hidden');
            });
            $('.close-btn').click(function() {
                $('.side-bar').removeClass('active');
                $('.menu-btn').css('visibility', 'visible');
            })
        })
    </script>

    <!-- JS Vendors -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animsition/4.0.2/js/animsition.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-progressbar/0.9.0/bootstrap-progressbar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.2/circle-progress.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.5/perfect-scrollbar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"></script>

    <!-- Your Local Main JS -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
