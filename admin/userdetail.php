<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
Session::checkSession();
include_once($filepath . '/../classes/useraccount.php');
include_once($filepath . '/../classes/order.php');
?>


<?php
if (isset($_GET['id_user'])) {
    $id_user = $_GET['id_user'];
    $user = new useraccount();
    $showUserById = $user->showUserAccountById_user($id_user);
    $result = $showUserById->fetch_assoc();
}

if (isset($_GET['id_user']) && isset($_GET['action']) == 'block') {
    $id_user = $_GET['id_user'];
    $blockAccount = $user->blockAccount($id_user);
}
if (isset($_GET['id_user']) && isset($_GET['action']) == 'unblock') {
    $id_user = $_GET['id_user'];
    $unblockAccount = $user->unblockAccount($id_user);
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
                <div class="_userdetail" style="box-sizing: border-box;">
                    <div class="row">
                        <div class="col-11 m-auto">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3"><label for="exampleFormControlInput1">UserID</label>
                                        <input type="text" class="form-control" name="id_user" value="<?php echo $result['id_user'] ?>">
                                    </div>
                                    <div class="col-md-3"><label for="exampleFormControlInput1">Username</label>
                                        <input type="text" class="form-control" name="username" value="<?php echo $result['username'] ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1">Fullname</label>
                                        <input type="text" class="form-control" name="fullname" value="<?php echo $result['fullname'] ?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="exampleFormControlInput1">Phone</label>
                                        <input type="text" class="form-control" name="phone" value="<?php echo $result['phone'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col">
                                        <label for="exampleFormControlTextarea1">Địa chỉ</label>
                                        <input type="text" class="form-control" name="address" value="<?php echo $result['address'] ?>">
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlSelect1">Trạng thái</label>
                                        <input type="text" class="form-control" name="status" value="<?php if ($result['status'] == '0') echo 'Hoạt động';
                                                                                                        else echo 'Tạm khoá' ?>">
                                    </div>
                                    <div class="col">
                                        <label for="exampleFormControlInput1">Ngày đăng ký</label>
                                        <input type="date" class="form-control" name="dateOfRegister" value="<?php echo $result['dateOfRegister'] ?>">
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-danger" href="?action=block&id_user=<?php echo $result['id_user'] ?>">Khoá tài khoản</a>
                            <a class="btn btn-success" href="?action=unblock&id_user=<?php echo $result['id_user'] ?>">Mở khoá tài khoản</a>
                        </div>
                    </div>
                </div>

                <br>
                <div class="_dsproduct">
                    <h4 class="ml-4">Danh sách đơn hàng</h4>
                    <div class="row">
                        <div class="col-11 m-auto">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-striped table-bordered display">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Mã ĐH</th>
                                            <th scope="col">Địa chỉ</th>
                                            <th scope="col">Ngày mua</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Chi tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $order = new order();
                                        $showOrder = $order->showOrderById_User($id_user);
                                        if ($showOrder) {
                                            while ($result1 = $showOrder->fetch_assoc()) {
                                                
                                        ?>
                                                <tr>
                                                    <th scope="col"><?php echo $result1['id_order'] ?></th>
                                                    <th scope="col"><?php echo $result1['address'] ?></th>
                                                    <th scope="col"><?php echo $result1['date'] ?></th>
                                                    <th scope="col"><?php
                                                                    if ($result1['status'] == '0')
                                                                        echo 'Đơn hàng đang xử lý';
                                                                    elseif ($result1['status'] == '1')
                                                                        echo 'Đơn hàng đã xử lý';
                                                                    else
                                                                        echo 'Đơn hàng đã nhận';
                                                                    ?></th>
                                                    <th scope="col">
                                                        <div onclick="requestAjaxToGetOrder('<?php echo $result1['id_order'] ?>')" class="btn btn-primary">Chi tiết</div>
                                                    </th>
                                                </tr>
                                        <?php
                                            }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

        </div>
    </div>
    <script>
        function requestAjaxToGetOrder(id_order) {
            $.ajax({
                method: "GET",
                dataType: "html",
                url: "../classes/getdetailorder.php",
                data: {
                    'id_order': String(id_order)
                },
                success: function(response) {
                    $('<div class="modal hide fade">' + response + '</div>').modal();
                }
            });
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