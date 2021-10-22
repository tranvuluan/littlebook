<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
Session::checkSession();
include_once($filepath . '/../classes/danhmuc.php');
include_once($filepath . '/../classes/sach.php');
include_once($filepath . '/../classes/khuyenmai.php')
?>

<?php
$book = new sach();
$khuyenmai = new khuyenmai();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id_book'])) {
    $id_book = $_GET['id_book'];
    $discountpercent = $_POST['discountpercent'] / 100;
    $checksale = $book->checkSale($id_book);
    if ($checksale) {
        $themKM = $khuyenmai->setKM($id_book, $discountpercent);
        echo '<script>alert(' . $setKM . ')</script>';
    } else {
        $setKM = $khuyenmai->themKM($id_book, $discountpercent);
        $setbook = $book->setSaleBook($id_book);
        echo '<script>alert(' . $themKM . ')</script>';
    }
    header('Location: themkmsach.php');
}

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
                    <h1 class="mt-4">Thống kê</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Thống kê</li>
                    </ol>
                    <div class="row">
                    </div>
                </div>
                <div class="_khuyenmai">
                    <div class="listbook">
                        <div class="row">
                            <div class="col-11 m-auto">
                                <div class="table-responsive">
                                    <table id="dataTable" class="table table-striped table-bordered display">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Mã sách</th>
                                                <th scope="col">Tên sách</th>
                                                <th scope="col">Tác giả</th>
                                                <th scope="col">KM (%)</th>
                                                <th scope="col" class="text-center">Thêm KM</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $showbook = $book->showbook();
                                            if ($showbook) {
                                                $i = 0;
                                                while ($result = $showbook->fetch_assoc()) {
                                                    $i++;
                                            ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $i ?></th>
                                                        <td><?php echo $result['id_book'] ?></td>
                                                        <td><?php echo $result['name_book'] ?></td>
                                                        <td><?php echo $result['author_book'] ?></td>
                                                        <td>
                                                            <?php
                                                            $checksale = $book->checkSale($result['id_book']);
                                                            if ($checksale) {
                                                                while ($result1 = $checksale->fetch_assoc()) {
                                                                    echo $result1['discountpercent'] * 100;
                                                                }
                                                            } else {
                                                                echo "0";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <div onclick="setKM(this)" data-id_book="<?php echo $result['id_book'] ?>" class="btn btn-primary" data-toggle="modal" data-target="#modelId">Thêm KM</div>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Thông tin khuyến mãi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formSetKM" action="" method="POST">
                        <div class="form-group">
                            <label for="">Nhập phần trăm khuyến mãi</label>
                            <input type="text" name="discountpercent" id="" class="form-control" placeholder="" aria-describedby="helpId">
                            <input type="submit" value="send" style="display: none">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="btnSave" type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setKM(element) {
            document.getElementById('formSetKM').setAttribute('action', '?id_book=' + element.getAttribute('data-id_book'));
            let btnSave = document.getElementById('btnSave');
            btnSave.onclick = function() {
                let btnSubmit = document.querySelector('input[type=submit');
                btnSubmit.click();
            }
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="js/datatable.js"></script>
</body>

</html>