<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/../lib/database.php');
include_once($filepath . '/../helpers/format.php');
?>

<?php
class sach
{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addBook($files, $name_book, $author_book, $publisher_book, $categorychild, $description_book, $price_book, $salecheck_book, $count_book, $dateofsale)
    {
        $description_book = mysqli_real_escape_string($this->db->link, $description_book);
        $name_book = mysqli_real_escape_string($this->db->link, $name_book);

        $id_book  = uniqid();
        $permited = array('jpg', 'jpeg', 'png', 'png', 'gif');
        $file_names = $files['name'];
        $file_sizes = $files['size'];
        $file_temps = $files['tmp_name'];
        $count = count($file_names);
        $arr = array();
        for ($i = 0; $i < $count; $i++) {
            $file_name = $id_book . '_' . $i . '_' . $file_names[$i];
            array_push($arr, $file_name);
            $upload_image = "../uploads/images/book/" . $file_name;
            move_uploaded_file($file_temps[$i], $upload_image);
        }
        if ($file_names == "") {
            return "Chưa thêm hình ảnh";
        }
        $strarr = implode(",", $arr);
        $query = "INSERT INTO `tbl_book`(`id_book`, `id_categorychild`, `name_book`, `author_book`, `publisher_book`, `description_book`, `price_book`, `salecheck_book`, `count_book`, `DateOfSale`, `image_book`) VALUES ('$id_book', '$categorychild', '$name_book','$author_book', '$publisher_book', '$description_book', '$price_book','$salecheck_book', '$count_book' , '$dateofsale', '$strarr')";
        $result = $this->db->insert($query);
        if ($result) {
            return "Thêm thành công";
        } else {
            return "Lỗi";
        }
    }

    public function checkSale($id_book) {
        $query = "SELECT * FROM `tbl_booksale` WHERE id_book = '$id_book'";
        $result = $this->db->select($query);
        return $result;
    }

    public function showBook()
    {
        $query = "SELECT * FROM tbl_book";
        $result = $this->db->select($query);
        return $result;
    }

    public function showBookOfCNTT()
    {
        $query = "SELECT * FROM `tbl_categorychild`, `tbl_book` WHERE tbl_categorychild.id_categorychild = tbl_book.id_categorychild AND tbl_categorychild.id_category = '1'";
        $result = $this->db->select($query);
        return $result;
    }

    public function showBookByCategorychildId($id_categorychild)
    {
        $query = "SELECT * FROM `tbl_book` WHERE id_categorychild = $id_categorychild";
        $result = $this->db->select($query);
        return $result;
    }

    public function showBookByCategorychildIdByFilter($id_categorychild, $id_filter) {
        if ($id_filter === '0') {
            $query = "SELECT * FROM `tbl_book` WHERE id_categorychild = $id_categorychild AND salecheck_book = '2'";
        }
        elseif ($id_filter === '1') {
            $query = "SELECT * FROM `tbl_book` WHERE id_categorychild = $id_categorychild ORDER BY DateOfSale DESC";
        }
        else {
            $query = "SELECT * FROM `tbl_book` WHERE id_categorychild = $id_categorychild ORDER BY buycount_book DESC";
        }
        $result = $this->db->select($query);
        return $result;
    }

    public function updateBook($id_book, $files, $name_book, $author_book, $publisher_book, $categorychild, $description_book, $price_book, $salecheck_book, $count_book, $dateofsale)
    {
        $id_book  = $id_book;
        $permited = array('jpg', 'jpeg', 'png', 'png', 'gif');
        $file_names = $files['name'];
        $file_sizes = $files['size'];
        $file_temps = $files['tmp_name'];
        $count = count($file_names);
        $arr = array();
        for ($i = 0; $i < $count; $i++) {
            $file_name = $id_book . '_' . $i . '_' . $file_names[$i];
            array_push($arr, $file_name);
            $upload_image = "../uploads/images/book/" . $file_name;
            move_uploaded_file($file_temps[$i], $upload_image);
        }
        if ($file_names == "") {
            return "Chưa thêm hình ảnh";
        }
        $strarr = implode(",", $arr);
        $query = "UPDATE `tbl_book` SET `id_categorychild`='$categorychild', `name_book`='$name_book',`author_book`='$author_book',`publisher_book`='$publisher_book',`description_book`='$description_book',`price_book`='$price_book',`salecheck_book`='$salecheck_book', `count_book`='$count_book',`DateOfSale`='$dateofsale', `image_book`= '$strarr' WHERE `id_book`='$id_book'";
        $result = $this->db->update($query);
        if ($result) {
            return "Sửa thành công";
        } else {
            return "Lỗi";
        }
    }

    public function showBookByID($id_book)
    {
        $query = "SELECT * FROM tbl_book WHERE id_book = '$id_book'";
        $result = $this->db->select($query);
        return $result;
    }

    public function deleteBook($id_book)
    {
        $query = "DELETE FROM tbl_book WHERE id_book = '$id_book'";
        $result = $this->db->delete($query);
        if ($result) {
            return "Xoá thành công";
        } else {
            return "Lỗi";
        }
    }

    public function setSaleBook($id_book) {
        $query = "UPDATE `tbl_book` SET salecheck_book = '2' WHERE id_book = '$id_book'";
        $result = $this->db->update($query);
        return $result;
    }
}
?>
