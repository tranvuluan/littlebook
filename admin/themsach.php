<?php
$filepath = realpath(dirname(__FILE__));

include_once($filepath . '/../lib/session.php');
Session::checkSession();
include_once($filepath . '/../classes/danhmuc.php');
include_once($filepath . '/../classes/sach.php')

?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name_book = $_POST['name_book'];
    $author_book = $_POST['author_book'];
    $publisher_book = $_POST['publisher_book'];
    $categorychild = $_POST['categorychild'];
    $description_book = $_POST['description_book'];
    $price_book = $_POST['price_book'];
    $count_book = $_POST['count_book'];
    $dateofsale = $_POST['dateofsale'];
    $salecheck_book = $_POST['salecheck_book'];
    $addbook = new sach();
    $insertbook = $addbook->addbook($_FILES['image'], $name_book, $author_book, $publisher_book, $categorychild, $description_book, $price_book, $salecheck_book, $count_book, $dateofsale);
    echo "<script>alert('$insertbook');</script>";
    header('Location: themsach.php');
}

// $tendanhmuc = $danhmuc->showDanhmucsach()
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
    </script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Quản lý</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>

        <!-- Navbar-->
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <?php
                    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
                        Session::destroy();
                    }
                    ?>
                    <a class="dropdown-item" href="?action=logout">Logout</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <!-- layoutSidenav_nav.php -->
        <?php
        include './inc/layoutSidenav_nav.php';
        ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">Thêm sách</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Thống kê</a></li>
                        <li class="breadcrumb-item active">Thêm sách</li>
                    </ol>
                    <div class="row">
                    </div>
                </div>
                <div class="book_form col-sm-11 m-auto ">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6"><label for="exampleFormControlInput1">Tên sách</label>
                                    <input type="text" class="form-control" name="name_book">
                                </div>
                                <div class="col-md-3"><label for="exampleFormControlInput1">Tác giả</label>
                                    <input type="text" class="form-control" name="author_book">
                                </div>
                                <div class="col-md-3">
                                    <label for="exampleFormControlInput1">Nhà xuất bản</label>
                                    <input type="text" class="form-control" name="publisher_book">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-7">
                                    <label for="exampleFormControlTextarea1">Mô tả</label>
                                    <textarea class="form-control" rows="2" name="description_book"></textarea>
                                </div>
                                <div class="col-md-5">
                                    <div class="col">
                                        <label for="exampleFormControlSelect1">Thể loại</label>
                                        <select class="form-control" name="categorychild">
                                            <?php
                                            $danhmuc = new danhmucsach();
                                            $tendanhmuc = $danhmuc->showTatCaDanhMucCon();
                                            while ($result = $tendanhmuc->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $result['id_categorychild'] ?>"><?php echo $result['name_category'] . '---' . $result['name_categorychild'] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm">
                                    <label for="exampleFormControlInput1">Giá</label>
                                    <input type="number" class="form-control" name="price_book" min="0">
                                </div>
                                <div class="col-sm">
                                    <label for="exampleFormControlInput1">Số lượng trong kho</label>
                                    <input type="number" class="form-control" name="count_book" min="0">
                                </div>
                                <div class="col-sm">
                                    <label for="exampleFormControlInput1">Ngày nhập</label>
                                    <input type="datetime-local" class="form-control" name="dateofsale" id="datePicker">
                                </div>
                                <div class="col-sm">
                                    <label for="exampleFormControlInput1">Tình trạng</label>
                                    <select class="form-control" name="salecheck_book">
                                        <option value="0">Ngưng bán</option>
                                        <option value="1">Đăng bán</option>
                                        <option value="2">Sale</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="custom-file">
                                        <input multiple type="file" name="image[]" class="custom-file-input" id="myFileInput" required>
                                        <label class="custom-file-label" for="validatedCustomFile">Chọn ảnh...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" onclick="return confirm('Xác nhận thêm sách?')">Submit</button>
                    </form>
                </div>
            </main>

        </div>
    </div>
    <script>
        document.getElementById("datePicker").valueAsDate = new Date();
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
</body>

</html>