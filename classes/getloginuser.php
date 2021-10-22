<?php 
$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/userlogin.php';

?>

<?php 

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userlogin = new userlogin();
        $login = $userlogin->login_user($username, md5($password));
        if ($login === true){
            echo 1;
        }
        else 
            echo 0;
    }

?>