<?php
ob_start();
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/inc/header.php';
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/classes/order.php');

?>

<?php

?>

<!-- Content -->
<div class="container">
    <div class="container">
        <div class="row profile">
            <div class="col-md-3">
                <div class="profile-sidebar">
                    <div class="profile-userpic"> <img src="./image/profile.png" class="img-responsive" alt="Thông tin cá nhân">
                    </div>
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-job"> <?php echo $_SESSION['fullname'] ?> </div>
                    </div>
                    <div class="profile-usermenu">
                        <ul class="nav">
                            <li class="active"> <a href="#"> <i class="glyphicon glyphicon-info-sign"></i> Cập nhật
                                    thông tin cá nhân </a>
                            </li>
                            <li> <a href="#"> <i class="glyphicon glyphicon-heart"></i> Sản
                                    phẩm yêu thích </a>
                            </li>
                            <li> <span style="cursor:pointer" onclick="changeQuanLy()">Quản lý đơn hàng</span>
                            </li>
                            <li> <a href="#"> <i class="glyphicon glyphicon-envelope"></i>
                                    Tin nhắn </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="thongtin" class="col-md-7">
                <div class="profile-content">
                    <table class="table table-bordered display">
                        <tbody>
                            <tr>
                                <td>Tên đăng nhập</td>
                                <td><?php echo $_SESSION['username'] ?></td>
                            </tr>
                            <br>
                            <tr>
                                <td>Địa chỉ email</td>
                                <td>nguyenducmanh1101@gmail.com</td>
                            </tr>
                            <tr>
                                <td>Họ và tên</td>
                                <td>
                                    <input type="text" name="fullname" class="validate[required] form-control" value="<?php echo $_SESSION['fullname'] ?>" />
                                </td>
                            </tr>
                            <tr>
                                <td>Địa chỉ</td>
                                <td>
                                    <input type="text" name="address" value="" class="validate[required] form-control" />
                                </td>
                            </tr>
                            <tr>
                                <td>Giới tính</td>
                                <td>
                                    <div><input type="radio" id="r1" name="r" />
                                        <label for="r1"><span></span>Nam</label>
                                        <input type="radio" id="r2" name="r" />
                                        <label for="r2"><span></span>Nữ</label>
                                        <input type="radio" id="r3" name="r" />
                                        <label for="r3"><span></span>Khác</label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="quanly" class="col-md-7 d-none">
            <div class="_dsproduct">
                    <h4 class="ml-4">Danh sách đơn hàng</h4>
                    <div class="row">
                        <div class="col-11 m-auto">
                            <div class="table-responsive">
                                <table id="dataTable" class="table table-striped table-bordered display">
                                    <thead class="">
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
                                        $showOrder = $order->showOrderById_User($_SESSION['id_user']);
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
            </div>
            <div id="btnsua" class="col-md-1">
                <button class="btn btn-info" onclick="return confirm('Xác nhận sửa thông tin?')">Sửa</button>
            </div>
        </div>
    </div>
</div>



<script>
    function changeQuanLy(){
        console.log('click');
        let quanly = document.getElementById('quanly');
        quanly.classList.toggle('d-none');
        let thongtin = document.getElementById('thongtin');
        thongtin.classList.toggle('d-none');
        let btnsua = document.getElementById('btnsua');
        btnsua.classList.toggle('d-none');
    }
</script>

<script>
        function requestAjaxToGetOrder(id_order) {
            $.ajax({
                method: "GET",
                dataType: "html",
                url: "classes/getdetailorder.php",
                data: {
                    'id_order': String(id_order)
                },
                success: function(response) {
                    $('<div class="modal hide fade taikhoan">' + response + '</div>').modal();
                }
            });
        }
    </script>
<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/inc/footer.php';
ob_flush();
?>