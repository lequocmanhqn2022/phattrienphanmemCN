<?php 
    // kết nối
    $connect = mysqli_connect("localhost", "root", "", "web") or die("không thể kết nối");
    // thiết lập bảng mã
    mysqli_query($connect, "set names 'utf8'");
    $query = 'SELECT * FROM lichsugiaodich';
    $result=mysqli_query($connect, $query)or die("Không thực hiện được");
    $lsmh = mysqli_fetch_all($result);
    if(isset($_POST['tim'])){
        $check = $_POST['text'];
        $query = "SELECT * FROM lichsugiaodich WHERE ngayban = {$check} ";
        $result = mysqli_query($connect, $query)or die("Không thực hiện được");
        $row = $result->num_rows;
        if($row!=0){
            $query = "SELECT * FROM lichsugiaodich WHERE ngayban = {$check}'";
            $result = mysqli_query($connect, $query)or die("Không thực hiện được");
            $lsmh = mysqli_fetch_all($result);
        }else{
            $error=true;
        }
        
    }
?>

<?php require('../admin/admin.php') ?>
<div class="admin-content-right">
            <div class="admin-content-right-cartegory">
            <h1>Danh sách hóa đơn</h1>
            <div class="cartegory-content">
                <form method="POST" action="">
                    <div class="timHD">
                        <input type="date" required name="text"/>
                        <button class="btnngay" type="submit" name="tim">Tìm</button>
                        <?php 
                        if(isset($error)){
                        echo "<p style='color:red; font-size:20px;padding-top:10px'>Không tồn tại</p>";
                    }
                ?>
                    </div>
                </form>
            </div>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Tên khách hàng</th>
                        <th>Số điện thoại</th>
                        <th>Ngày bán</th>
                        <th>Địa chỉ</th>
                        <th>Tổng tiền</th>
                    </tr>
                    <?php
                        $i=1;
                        foreach($lsmh as $ds){
                            $tongtien=number_format($ds[5], 0, '', '.');
                            echo "
                                <tr>
                                    <td>{$i}</td>
                                    <td>{$ds[2]}</td>
                                    <td>{$ds[3]}</td>
                                    <td>{$ds[0]}</td>
                                    <td>{$ds[4]}</td>
                                    <td>{$tongtien} VNĐ</td>
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