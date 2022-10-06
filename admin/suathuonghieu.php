<?php
    // kết nối
    $connect = mysqli_connect("localhost", "root", "", "web") or die("không thể kết nối");
    // thiết lập bảng mã
    mysqli_query($connect, "set names 'utf8'");
    if(isset($_POST['Sua'])){
        $result = $_POST['ten_thuonghieu'];
        $id=$_GET['idThuonghieu'];
        $query="UPDATE loaisanpham SET tenLoaiSP='{$result}' WHERE idLoaiSP= {$id}";
        mysqli_query($connect,$query)or die("Không thực hiện được");
        header('location: /WebNuocHoa/admin/ThuongHieu.php');
    }
?>

<?php require('../admin/admin.php') ?>
<div class="admin-content-right">
<div class="admin-content-right-cartegory">
    <div class="cartegory-content">
        <form method="POST" action="">
            <label>
                Vui lòng điền thương hiệu
                <span style="color:red;">*</span>
            </label><br>
            <input type="text" required name="ten_thuonghieu"/>
            <button class="addmin-btn" type="submit" name="Sua">Sửa</button>
        </form>
    </div>
</div>
</div>
    </section>
</body>
</html>