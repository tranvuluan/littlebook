<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/userlogin.php';
?>
<?php
if (isset($_POST['username']) && isset($_POST['password']) && $_POST['repassword']) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $userlogin = new userlogin();
    $register = $userlogin->register_login($username, md5($password), md5($repassword), $fullname, $phone);
    echo $register;
}
?>