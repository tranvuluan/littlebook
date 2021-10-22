<?php
    $filepath = realpath(dirname(__FILE__));
    include ($filepath.'/../lib/database.php');
    include ($filepath.'/../helpers/format.php');
?>
<?php
    class danhmucsach {
        
        private $db;
        private $fm;

        public function __construct()
        {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function showDanhmucsach() {
            $query = "SELECT * FROM tbl_category";
            $result = $this->db->select($query);
            return $result;
        }

        public function showDanhmuccon($id) {
            $query = "SELECT * FROM tbl_categorychild WHERE id_category = $id";
            $result = $this->db->select($query);
            return $result;
        }

        public function findDanhmuccon($id) {
            $query = "SELECT * FROM tbl_categorychild, tbl_category WHERE tbl_categorychild.id_categorychild = $id AND tbl_categorychild.id_category = tbl_category.id_category";
            $result = $this->db->select($query);
            return $result;
        }

        public function showTatCaDanhMucCon() {
            $query = "SELECT * FROM tbl_categorychild, tbl_category WHERE tbl_categorychild.id_category = tbl_category.id_category ORDER BY tbl_categorychild.id_category";
            $result = $this->db->select($query);
            return $result;
        }

        public function changeNameCategoryChild($id_categorychild, $name_categorychild) {
            $query = "UPDATE tbl_categorychild SET name_categorychild = '$name_categorychild' WHERE id_categorychild = '$id_categorychild'";
            $result = $this->db->update($query);
            if ($result) {  
                return "Đã cập nhật thành công!";
            }
            else {
                return "Lỗi";
            }
        }

        public function deleteCategoryChild($id_categorychild) {
            $query = "DELETE FROM  tbl_categorychild  WHERE id_categorychild = '$id_categorychild'";
            $result = $this->db->update($query);
            if ($result) {  
                return "Đã xoá thành công!";
            }
            else {
                return "Lỗi";
            }
        } 

        public function addcategorychild ($id_category ,$name_categorychild) {
            $query = "INSERT INTO tbl_categorychild(id_category, name_categorychild) VALUES('$id_category','$name_categorychild')";
            $result = $this->db->insert($query);
            if ($result) {  
                return "Đã thêm thành công!";
            }
            else {
                return "Lỗi";
            }
        }
        public function addcategory ($name_category) {
            $query = "INSERT INTO tbl_category(name_category) VALUES('$name_category')";
            $result = $this->db->insert($query);
            if ($result) {  
                return "Đã thêm thành công!";
            }
            else {
                return "Lỗi";
            }
        }

        public function deleteCategory ($id_category) {
            $query = "DELETE FROM tbl_category WHERE id_category = '$id_category'";
            $result = $this->db->delete($query);
            if ($result) {  
                return "Đã xoá thành công!";
            }
            else {
                return "Lỗi";
            }
        }
    }


?>