<?php
    // kết nối
    $connect = mysqli_connect("localhost", "root", "", "web") or die("không thể kết nối");
    // thiết lập bảng mã
    mysqli_query($connect, "set names 'utf8'");
    if(isset($_GET['idSP'])){
        $idSP=$_GET['idSP'];
        $query="DELETE FROM `sanpham` WHERE idSP='$idSP'";
        mysqli_query($connect,$query)or die("Không thực hiện được");
        echo "
                <script>
                    alert('Xóa thành công');
                    document.location = '/WebNuocHoa/admin/admin.php';
                </script> 
            ";
    }
?>
<?php
include('sanpham.php')
?>