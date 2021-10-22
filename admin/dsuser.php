<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/session.php');
Session::checkSession();
include_once($filepath . '/../classes/useraccount.php');

?>

<?php
$useraccount = new useraccount();
?>

<?php


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
                                            <th scope="col">ID</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Fullname</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Address</th>
                                            <th scope="col" class="text-center">Chi tiết</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $showAllUserAccount = $useraccount->showAllUserAccount();
                                        if ($showAllUserAccount) {
                                            while ($result = $showAllUserAccount->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $result['id_user'] ?></td>
                                                    <td><?php echo $result['username'] ?></td>
                                                    <td><?php echo $result['fullname'] ?></td>
                                                    <td><?php echo $result['phone'] ?></td>
                                                    <td><?php echo $result['address'] ?></td>
                                                    <td>
                                                        <a class="btn btn-primary" href="userdetail.php?id_user=<?php echo $result['id_user'] ?>">Chi tiết</a>
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

    <!-- Modal -->

    <script>
        function requestAjaxToGetBookSale(id_book) {
            $.ajax({
                method: "GET",
                dataType: "html",
                url: "../classes/getbooksale.php",
                data: {
                    'id_book': String(id_book)
                },
                success: function(response) {
                    $('<div class="modal hide fade">' + response + '</div>').modal();
                }
            });
        }

        function requestAjaxtoDelete(id_book) {
            $.ajax({
                method: "GET",
                dataType: "html",
                url: "../classes/getbooksale.php",
                data: {
                    'id_bookdelete': String(id_book)
                },
                success: function(response) {
                    alert(response);
                    location.reload();
                }
            });
        }

        function requestAjaxToChange(id_book) {
            let discountpercent = document.querySelector('input[name=discountpercent').value;
            $.ajax({
                method: "GET",
                dataType: "html",
                url: "../classes/getbooksale.php",
                data: {
                    'id_bookchange': String(id_book),
                    'discountpercent': String(discountpercent)
                },
                success: function(response) {
                    alert(response);
                    location.reload();
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