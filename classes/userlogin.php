<?php
ob_start();
$filepath = realpath(dirname(__FILE__));
include($filepath . '/../lib/session.php');
$filepath = realpath(dirname(__FILE__));
include($filepath . '/../lib/database.php');
$filepath = realpath(dirname(__FILE__));
include($filepath . '/../helpers/format.php');

if (!isset($_SESSION)) {
    session_start();
}
?>
<?php
class userlogin
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function login_user($username, $password)
    {
        $username = $this->fm->validation($username);
        $password = $this->fm->validation($password);

        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);

        $query = "SELECT * FROM `tbl_useraccount` WHERE `username` = '$username' AND `userpassword` = '$password' LIMIT 1";
        $result = $this->db->select($query);
        if ($result != false) {
            $value = $result->fetch_assoc();
            $_SESSION['userLogin'] = true;
            // Session::set('userLogin', true);
            Session::set('id_user', $value['id_user']);
            Session::set('username', $value['username']);
            Session::set('fullname', $value['fullname']);
            Session::set('password', $value['userpassword']);
            //$this->fm->textShorten($value['fullname'], 15)
            return true;
        }
        return false;
    }

    public function register_login($username, $password, $repassword, $fullname, $phone)
    {
        $username = $this->fm->validation($username);
        $password = $this->fm->validation($password);
        $repassword = $this->fm->validation($repassword);
        $fullname = $this->fm->validation($fullname);
        $phone = $this->fm->validation($phone);

        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);
        $repassword = mysqli_real_escape_string($this->db->link, $repassword);
        $fullname = mysqli_real_escape_string($this->db->link, $fullname);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $query = "SELECT * FROM `tbl_useraccount` WHERE `username` = '$username'";
        $result1 = $this->db->select($query);
        if ($result1)
            return -1;
        if ($password != $repassword)
            return 0;
        $query = "INSERT INTO `tbl_useraccount`(`username`,`userpassword`,`fullname`,`phone`) VALUES('$username', '$password', '$fullname', '$phone')";
        $result2 = $this->db->insert($query);
        if ($result2) {
            return 1;
        }
        return 2;
    }

    public function user_check()
    {
    }

    public function user_detroy()
    {
    }
}
?>