<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
Session::checkSession();
include_once($filepath . '/../classes/danhmuc.php');
include_once($filepath . '/../classes/sach.php');

?>

<?php
$book = new sach();
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id_book'])) {
    $id_book = $_GET['id_book'];
    $name_book = $_POST['name_book'];
    $author_book = $_POST['author_book'];
    $publisher_book = $_POST['publisher_book'];
    $categorychild = $_POST['categorychild'];
    $description_book = $_POST['description_book'];
    $price_book = $_POST['price_book'];
    $count_book = $_POST['count_book'];
    $dateofsale = $_POST['dateofsale'];
    $salecheck_book = $_POST['salecheck_book'];

    $update1 = $book->updateBook($id_book, $_FILES['image'], $name_book, $author_book, $publisher_book, $categorychild, $description_book, $price_book, $salecheck_book, $count_book, $dateofsale);
    echo "<script>alert('$update1');</script>";
    header('Location: dssach.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['idBook'])) {
    $id_book = $_GET['idBook'];
    $delbook = $book->deleteBook($id_book);
    echo "<script>alert('$delbook');</script>";
    header('Location: dssach.php');
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
    <title>Danh sách - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
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
                    <h1 class="mt-4">Danh sách</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Thống kê</a></li>
                        <li class="breadcrumb-item active">Danh sách</li>
                    </ol>
                    <div class="row">
                    </div>
                </div>
                <div class="listbook">
                    <div class="row">
                        <div class="col-11 m-auto">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-striped table-bordered display">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tên sách</th>
                                            <th scope="col">Tác giả</th>
                                            <th scope="col">NXB</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Ngày nhập</th>
                                            <th scope="col">Đã bán</th>
                                            <th scope="col">Chi tiết</th>
                                            <th scope="col" class="text-center">Xoá</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sach = new sach();
                                        $showbook = $sach->showbook();
                                        if ($showbook) {
                                            $i = 0;
                                            while ($result = $showbook->fetch_assoc()) {
                                                $i++;
                                        ?>
                                                <tr>
                                                    <th scope="row"><?php echo $i ?></th>
                                                    <td><?php echo $result['name_book'] ?></td>
                                                    <td><?php echo $result['author_book'] ?></td>
                                                    <td><?php echo $result['publisher_book'] ?></td>
                                                    <td><?php echo $result['price_book'] ?></td>
                                                    <td><?php echo $result['DateOfSale'] ?></td>
                                                    <td><?php echo $result['buycount_book'] ?></td>
                                                    <td>
                                                        <form id="getInfoBook" action="" method="GET">
                                                            <button type="button" onclick="requestAjax(this)" id="chitiet" data-idbook="<?php echo $result['id_book'] ?>" class="btn btn-primary" data-toggle="modal" data-target="#modelId">Chi tiết...</button>
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <form action="?idBook=<?php echo $result['id_book'] ?>" method="POST">
                                                            <button class="btn btn-danger">Xoá</button>
                                                        </form>
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
            </main>

        </div>
    </div>

    <div class="_modal">
        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thông tin sách</h5>
                        <button type="button" onclick="location.reload()" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data" id="formModal">
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
                                            <input multiple type="file" name="image[]" class="custom-file-input" id="myFileInput">
                                            <label class="custom-file-label" for="validatedCustomFile">Chọn ảnh...</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button id="btnSave" class="btn btn-primary" type="submit" onclick="return confirm('Xác nhận thêm sách?')">Lưu</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="location.reload()" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="button" id="btnChange" class="btn btn-primary" onclick="change()">Sửa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let btnChitiet = document.getElementById('chitiet');
        let btnSave = document.getElementById('btnSave');
        btnSave.style.display = 'none';
        let input = document.getElementsByTagName('input');
        for (let i = 0; i < input.length; i++) {
            input[i].setAttribute('readonly', 'readonly');
        }
        let select = document.getElementsByTagName('select');
        for (let i = 0; i < select.length; i++) {
            select[i].setAttribute('disabled', 'disabled');
        }
        let textarea = document.getElementsByTagName('textarea');
        for (let i = 0; i < textarea.length; i++) {
            textarea[i].setAttribute('disabled', 'disabled');
        }
    </script>
    <script>
        function requestAjax(element) {
            $.ajax({
                method: "GET",
                url: "../classes/laythongtinsach.php",
                data: {
                    id_book: $(element).attr("data-idbook")
                },
                success: function(response) {
                    getInfo(response);
                }
            });
        }

        function getInfo(response) {
            let arr = response.split('|');
            console.log(arr);
            let input = document.getElementsByTagName('input');
            input[1].value = arr[0];
            input[2].value = arr[1];
            input[3].value = arr[2];
            input[4].value = arr[6];
            let strdate = arr[8].split('-');
            let yyyy = strdate[0];
            let mm = strdate[1];
            let dd = strdate[2].split(' ')[0];
            strdate = mm + '/' + dd + '/' + yyyy;
            input[6].setAttribute('type', 'text')
            input[6].value = strdate;
            console.log(input[6]);
            document.getElementsByTagName('select')[2].selectedIndex = arr[9];
            document.getElementsByTagName('textarea')[0].value = arr[9];
            document.getElementsByName('description_book')[0].value = arr[3];
            document.getElementById('formModal').setAttribute('action', '?id_book=' + arr[10]);
        }

        function change() {
            let input = document.getElementsByTagName('input');
            for (let i = 0; i < input.length; i++) {
                input[i].removeAttribute('readonly');
            }
            let select = document.getElementsByTagName('select');
            for (let i = 0; i < select.length; i++) {
                select[i].removeAttribute('disabled');
            }
            let textarea = document.getElementsByTagName('textarea');
            for (let i = 0; i < textarea.length; i++) {
                textarea[i].removeAttribute('disabled');
            }
            document.getElementsByTagName('input')[6].setAttribute('type', 'datetime-local');
            btnSave.style.display = 'block';
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