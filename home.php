<?php
session_start();
?>
<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Muflih Toys</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="foto/logobaru.png">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets_home/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets_home/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets_home/assets/css/flaticon.css">
    <link rel="stylesheet" href="assets_home/assets/css/price_rangs.css">
    <link rel="stylesheet" href="assets_home/assets/css/slicknav.css">
    <link rel="stylesheet" href="assets_home/assets/css/animate.min.css">
    <link rel="stylesheet" href="assets_home/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets_home/assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets_home/assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets_home/assets/css/slick.css">
    <link rel="stylesheet" href="assets_home/assets/css/nice-select.css">
    <link rel="stylesheet" href="assets_home/assets/css/style.css">
</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="foto/logobaru.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <header>
        <div class="header-area header-transparrent">
            <div class="headder-top header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-9 col-md-9">
                            <div class="logo">
                                <a href="home.php"><img style="height:100px;" src="foto/logobaru.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3">
                            <div class="menu-wrapper">
                                <div class="main-menu">
                                    <nav class="d-none d-lg-block">
                                        <ul id="navigation">
                                            <li><a href="home.php">Home</a></li>
                                        </ul>
                                    </nav>
                                </div>

                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>

        <div class="slider-area ">
            <div class="slider-active">
                <div class="single-slider slider-height d-flex align-items-center" data-background="foto/mainan.jpg">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-10 text-center">
                                <div class="hero__caption bg-success">
                                    <h1 class="text-white">Selamat Datang Di Website<br> Muflih Toys</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="our-services section-pad-t30">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <span>Muflih Toys</span>
                            <h2>Silahkan Login </h2>
                        </div>

                    </div>
                </div>

            </div>
            <div class="apply-process-area apply-bg pt-150 pb-150" data-background="assets_home/assets/img/gallery/how-applybg.png">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <form class="form-contact contact_form" method="post" novalidate="novalidate">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="mb-2 text-white">Email</label>
                                            <input class="form-control valid" name="email" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Email'" placeholder="Masukkan Email" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="mb-2 text-white">Password</label>
                                            <input class="form-control" name="password" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Masukkan Password'" placeholder="Masukkan Password" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" name="login" value="login" class="button button-contactForm boxed-btn">Login</button>
                                </div>
                                <?php
                                include('koneksi.php');
                                if (isset($_POST["login"])) {
                                    $email = $_POST["email"];
                                    $password = $_POST["password"];
                                    $ambil = $koneksi->query("SELECT * FROM pengguna
		                WHERE email='$email' AND password='$password' limit 1");
                                    $akunyangcocok = $ambil->num_rows;
                                    if ($akunyangcocok == 1) {
                                        $akun = $ambil->fetch_assoc();
                                        $_SESSION['admin'] = $akun;
                                        echo "<script> alert('Login Berhasil');</script>";
                                        echo "<script> location ='index.php';</script>";
                                        print_r($_SESSION['admin']);
                                    } else {
                                        echo "<script> alert('Login Gagal, Email atau Password anda salah');</script>";
                                        echo "<script> location ='home.php';</script>";
                                    }
                                }
                                ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- All JS Custom Plugins Link Here here -->
    <script src="assets_home/assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="assets_home/assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets_home/assets/js/popper.min.js"></script>
    <script src="assets_home/assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="assets_home/assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="assets_home/assets/js/owl.carousel.min.js"></script>
    <script src="assets_home/assets/js/slick.min.js"></script>
    <script src="assets_home/assets/js/price_rangs.js"></script>

    <!-- One Page, Animated-HeadLin -->
    <script src="assets_home/assets/js/wow.min.js"></script>
    <script src="assets_home/assets/js/animated.headline.js"></script>
    <script src="assets_home/assets/js/jquery.magnific-popup.js"></script>

    <!-- Scrollup, nice-select, sticky -->
    <script src="assets_home/assets/js/jquery.scrollUp.min.js"></script>
    <script src="assets_home/assets/js/jquery.nice-select.min.js"></script>
    <script src="assets_home/assets/js/jquery.sticky.js"></script>

    <!-- contact js -->
    <script src="assets_home/assets/js/contact.js"></script>
    <script src="assets_home/assets/js/jquery.form.js"></script>
    <script src="assets_home/assets/js/jquery.validate.min.js"></script>
    <script src="assets_home/assets/js/mail-script.js"></script>
    <script src="assets_home/assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="assets_home/assets/js/plugins.js"></script>
    <script src="assets_home/assets/js/main.js"></script>

</body>

</html>