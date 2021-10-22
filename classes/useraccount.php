<?php 
$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/../lib/database.php';
$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/../helpers/format.php';

?>

<?php

class useraccount {
    private $db;
    private $fm;

    public function __construct() 
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addUserAccount($username, $userpassword, $fullname, $phone, $address, $email) {
        $username = mysqli_real_escape_string($this->db->link, $username);
        $fullname = mysqli_real_escape_string($this->db->link, $fullname);
        $phone = mysqli_real_escape_string($this->db->link, $phone);
        $address = mysqli_real_escape_string($this->db->link, $address);
        $email = mysqli_real_escape_string($this->db->link, $email);

        $query = "INSERT INTO `tbl_useraccount`(`username`, `userpassword`, `fullname`, `phone`, `address`, `email`) VALUES('$username', '$userpassword', '$fullname', '$phone', '$address', '$email')";
        $result = $this->db->insert($query);
        if ($result) {
            return "Successful";
        }
        else {
            return "Fail";
        }
    }

    public function showAllUserAccount() {
        $query = "SELECT * FROM `tbl_useraccount` ORDER BY id_user DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function showUserAccountById_user($id_user) {
        $id_user = $id_user;
        $query = "SELECT * FROM `tbl_useraccount` WHERE id_user = '$id_user'";
        $result = $this->db->select($query);
        return $result;
    }

    public function blockAccount($id_user) {
        $id_user = $id_user;
        $query = "UPDATE `tbl_useraccount` SET status = '1' WHERE id_user = '$id_user'";
        $result = $this->db->update($query);
        return $result;
    }

    public function unblockAccount($id_user) {
        $id_user = $id_user;
        $query = "UPDATE `tbl_useraccount` SET status = '0' WHERE id_user = '$id_user'";
        $result = $this->db->update($query);
        return $result;
    }

}

?>