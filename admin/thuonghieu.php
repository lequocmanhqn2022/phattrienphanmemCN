<?php 
    $data;
    $error;
    // kết nối
    $connect = mysqli_connect("localhost", "root", "", "web") or die("không thể kết nối");
    // thiết lập bảng mã
    mysqli_query($connect, "set names 'utf8'");
    $query = 'SELECT * FROM loaisanpham';
    $result=mysqli_query($connect, $query)or die("Không thực hiện được");
    $data = mysqli_fetch_all($result);
    if(isset($_POST['themTH'])){
        $add = $_POST['text'];
        $query = "SELECT * FROM loaisanpham WHERE tenLoaiSP = '{$add}'";
        $result=mysqli_query($connect, $query)or die("Không thực hiện được");
        $row = $result->num_rows;
        if($row==0){
            $query = "INSERT INTO loaisanpham( tenLoaiSP) VALUES ('{$add}')";
            mysqli_query($connect, $query)or die("Không thực hiện được");
            header('location: /WebNuocHoa/admin/thuonghieu.php');
        }else{
            $error=true;
        }
        
    }
?>

<?php require('../admin/admin.php') ?>
<div class="admin-content-right">
            <div class="admin-content-right-cartegory">
            <h1>Danh sách loại sản phẩm</h1>
            <div class="cartegory-search-content">
                <form method="POST" action="ThuongHieu.php">
                    <div class="cartegory-content">
                        <input type="text" required placeholder="Thêm thương hiệu" name="text"/>
                        <button class="btnThem" type="submit" name="themTH">Thêm</button>
                    </div>
                </form>
                <?php 
                        if(isset($error)){
                        echo "<p style='color:red;'>Đã tồn tại Thương hiệu</p>";
                    }
                ?>
            </div>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Loại sản phẩm</th>
                        <th>Tùy chỉnh</th>
                    </tr>
                    <?php
                        $i=1;
                        foreach($data as $listSP){
                            $id=$listSP[0];
                            echo "
                                <tr>
                                    <td>$i</td>
                                    <td>{$listSP[1]}</td>
                                    <td><a href='suathuonghieu.php?idThuonghieu={$id}'>Sửa</a>|<a href='xoathuonghieu.php?idThuonghieu={$id}'>Xóa</a></td>
                                </tr>
                            ";
                            $i++;
                        }
                    ?>
                </table>
            </div>
        </div>
    </section>
</body>
</html>