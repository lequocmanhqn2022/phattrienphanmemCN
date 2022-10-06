
<?php
    // kết nối
    $connect = mysqli_connect("localhost", "root", "", "web") or die("không thể kết nối");
    // thiết lập bảng mã
    mysqli_query($connect, "set names 'utf8'");
    if(isset($_GET['idThuonghieu'])){
        $id=$_GET['idThuonghieu'];
        $query="DELETE FROM `loaisanpham` WHERE idLoaiSP='$id'";
        mysqli_query($connect,$query)or die("Không thực hiện được");
        header($_SERVER['PHP_SELF']);
    }
?>