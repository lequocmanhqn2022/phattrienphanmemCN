<?php 
    // kết nối
    $connect = mysqli_connect("localhost", "root", "", "web") or die("không thể kết nối");
    // thiết lập bảng mã
    mysqli_query($connect, "set names 'utf8'");
    if(isset($_GET['id'])){
        $id=$_GET['id'];
    }
    if(isset($_GET['ten'])){
        $ten=$_GET['ten'];
    }
    $query = "SELECT * FROM giohang where taikhoan = '{$id}'";
    $result=mysqli_query($connect, $query)or die("Không thực hiện được");
    $giohang= mysqli_fetch_all($result);
?>

<?php require('../admin/admin.php') ?>
<div class="admin-content-right">
            <div class="admin-content-right-cartegory">
            <h1>Giỏ hàng của <?php echo $ten?> </h1>
            <div class="cartegory-content">
            </div>
                <table>
                    <tr>
                        <th>Ngày chọn</th>
                        <th>Tên sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                    <?php
                        foreach($giohang as $ds){
                            $tongtien=number_format($ds[6], 0, '', '.');
                            echo "
                                <tr>
                                    <td>{$ds[7]}</td>
                                    <td>{$ds[2]}</td>
                                    <td>{$ds[4]}</td>
                                    <td>{$ds[5]}</td>
                                    <td>{$tongtien} VNĐ</td>
                                </tr>
                            ";
                        }
                    ?>
                </table>
            </div>
        </div>
    </section>
</body>
</html>