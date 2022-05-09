<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/../lib/session.php';

?>


<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="adz2younet-site-verification" content="000c8b1ed43a143a667362a579d63972">

    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/assets/owl.theme.default.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/style.css">
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script data-ad-client="ca-pub-2413991138251670" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
    <script async custom-element="amp-auto-ads" src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js">
    </script>
    </script>
</head>

<body>
    <!--Header-->
    <!-- Banner (logo,slogan) -->
    <div class="_top">
        <div class="row">
            <div class="_left">
                <div class="phone" style="padding-left: 15px;">
                    <div style="margin-right: 2px;" style="display: inline;" class="fa fa-phone my"></div>
                    (+84) 868486575
                </div>
                <div class="email">
                    <div style="margin-right: 2px;" class="fa fa-envelope my"></div>
                    sachdao@gmail.com
                </div>
            </div>
            <div class="_middle">
                <div>Free shipping on all orders over 150k <a href="#" style="padding: 2px 6px 3px 6px; text-decoration: none; background-color: #b48b33; font-size: 16px; color: white;border-radius: 10px;">Shop
                        Now!</a></div>
            </div>
            <div class="_right">
                <a href="#">
                    <div class="fa fa-facebook"></div>
                </a>
                <a href="#">
                    <div class="fa fa-instagram"></div>
                </a>
                <a href="#">
                    <div class="fa fa-twitter"></div>
                </a>
                <a href="#">
                    <div class="fa fa-globe"></div>
                </a>
            </div>
        </div>
    </div>
    <header>
        <div class="container">
            <div class="container_menu">
                <input type="checkbox" name="" id="check">

                <div class="logo-container">
                    <a href="index.php">
                        <h3 class="logo">Little<span>BookStore</span></h3>
                    </a>
                </div>

                <div class="nav-btn">
                    <div class="nav-links">
                        <ul>
                            <li class="nav-link" style="--i: .6s">
                                <a href="index.php">Home</a>
                            </li>
                            <li class="nav-link" style="--i: .85s">
                                <a href="#">Danh mục<i class="fa fa-caret-down"></i></a>
                                <div class="dropdown">
                                    <ul>
                                        <li class="dropdown-link">
                                            <a href="congnghethongtin.php">Công nghệ thông tin</a>
                                        </li>
                                        <li class="dropdown-link">
                                            <a href="selfhelp.php">Sách phát triển bản thân</a>
                                        </li>
                                        <li class="dropdown-link">
                                            <a href="#">Sách ngoại ngữ<i class="fa fa-caret-down"></i></a>
                                            <div class="dropdown second">
                                                <ul>
                                                    <li class="dropdown-link">
                                                        <a href="ngoaingu.php">Tiếng Anh</a>
                                                    </li>
                                                    <li class="dropdown-link">
                                                        <a href="ngoaingu.php">Tiếng Nhật</a>
                                                    </li>
                                                    <li class="dropdown-link">
                                                        <a href="ngoaingu.php">Tiếng Trung</a>
                                                    </li>
                                                    <div class="arrow"></div>
                                                </ul>
                                            </div>
                                        </li>
                                        <div class="arrow"></div>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-link" style="--i: 1.1s">
                                <a href="khuyenmai.php">Khuyến mãi</a>
                            </li>
                            <li class="nav-link" style="--i: 1.35s">
                                <a href="contact.php">Liên hệ</a>
                            </li>
                        </ul>
                    </div>


                    <div class="log-sign" style="--i: 1.8s;">
                        <?php
                        if (isset($_SESSION['userLogin'])) {
                        ?>
                            <div class="user" style="margin-right: 10px; position:relative; color: white;">
                                <a href="#" class="fa fa-user-o topfa" style="padding-right: 5px; font-size: 20px;color: white;"></a>
                                <span class="drop-info" style="cursor:pointer;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span style="font-size: 16px;"><?php echo $_SESSION['fullname'] ?>
                                    </span>
                                    <i class="ml-2 fa fa-caret-down"></i>
                                </span>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="accountdetail.php">Thông tin tài khoản</a>
                                    <a class="dropdown-item" href="?action=logout">Đăng xuất</a>
                                    <?php
                                    if (isset($_GET['action'])) {
                                        session::destroy();
                                        header('Location:index.php');
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div id="btnLogin" class="user" style="margin-right: 10px;" data-toggle="modal" data-target="#modelId">
                                <span style="font-size: 16px;"><a href="#" class="btn transparent">Login/Register</a></span>
                            </div>
                        <?php } ?>
                    </div>

                    <!-- <div class="log-sign" style="--i: 1.8s">
                    <a href="#" class="btn transparent">Log in</a>
                    <a href="#" class="btn solid">Sign up</a>
                </div> -->

                </div>

                <div class="hamburger-menu-container">
                    <div class="hamburger-menu">
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- <main>
        <section>
            <div class="overlay"></div>
        </section>
    </main> -->
    <!-- Kết thúc header -->
    <!-- Modal -->
    <div class="modal fade modalLogin" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 420px;padding: 1rem;">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -7px; margin-right:2px;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body loginformbody">
                    <div class="form-title text-center">
                        <h4>Login</h4>
                        <span id="spanlogin" style="color:red;display: inline-block;"></span>
                    </div>
                    <div class="d-flex flex-column">
                        <form id="formLoginUser">
                            <div id="fg_fullname" class="form-group d-none">
                                <label>Họ tên</label>
                                <input type="fullname" class="form-control" id="fullname">
                            </div>
                            <div class="form-group">
                                <label>Tên đăng nhập</label>
                                <input type="email" class="form-control" id="username">
                            </div>
                            <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" id="password">
                            </div>
                            <div class="form-group d-none" id="fg_repassword">
                                <label>Xác nhận mật khẩu</label>
                                <input type="password" class="form-control" id="repassword">
                            </div>
                            <div id="fg_phone" class="form-group d-none">
                                <label>Số điện thoại</label>
                                <input type="phone" class="form-control" id="phone">
                            </div>
                            <button id="btnlogin" type="button" class="btn btn-info btn-block btn-round" onclick="requestAjaxToLogin()">Login</button>
                            <button id="btnregister" type="button" class="btn btn-info btn-block btn-round d-none" onclick="requestAjaxToRegister(this)">Register</button>
                        </form>

                        <div class="text-center text-muted delimiter">or use a social network</div>
                        <div class="d-flex justify-content-center social-buttons">
                            <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Twitter">
                                <i class="fa fa-twitter"></i>
                            </button>
                            <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Facebook">
                                <i class="fa fa-facebook"></i>
                            </button>
                            <button type="button" class="btn btn-secondary btn-round" data-toggle="tooltip" data-placement="top" title="Linkedin">
                                <i class="fa fa-linkedin"></i>
                            </button>
                            </di>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <div class="signup-section">Not a member yet? <a href="#a" class="text-info" onclick="toRegister()"> Sign Up</a>.</div>
                    <div id="footer_signin" class="btn btn-primary w-100 d-none" onclick="toSignIn()">Sign In</div>
                </div>
            </div>
        </div>
    </div>