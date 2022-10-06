<?php 
    $data;
    $error;
    // kết nối
    $connect = mysqli_connect("localhost", "root", "", "web") or die("không thể kết nối");
    // thiết lập bảng mã
    mysqli_query($connect, "set names 'utf8'");
    $query = 'SELECT * FROM member where chucvu=0';
    $result = mysqli_query($connect, $query)or die("Không thực hiện được");
    $data = mysqli_fetch_all($result);
    if(isset($_POST['Tim'])){
        $checkuser = $_POST['TimKH'];
        $query = "SELECT * FROM member WHERE fullname = '{$checkuser}' and chucvu=0";
        $result = mysqli_query($connect, $query)or die("Không thực hiện được");
        $row = $result->num_rows;
        if($row!=0){
            $query = "SELECT * FROM member WHERE fullname = '{$checkuser}'";
            $result = mysqli_query($connect, $query)or die("Không thực hiện được");
            $data = mysqli_fetch_all($result);
        }else{
            $error=true;
        }
        
    }
?>
<?php require('../admin/admin.php') ?>
        <div class="admin-content-right">
            <div class="admin-content-right-cartegory">
            <h1>Danh sách khách hàng</h1>
            <div class="cartegory-content">
                <form method="POST" action="KhachHang.php">
                    <div class="timKH">
                        <input type="text" required placeholder="Tìm tên khách hàng" name="TimKH"/>
                        <button class="btnTim" type="submit" name="Tim">Tìm</button>
                <?php 
                        if(isset($error)){
                        echo "<p style='color:red; font-size:20px;padding-top:10px'>Không tồn tại khách hàng</p>";
                    }
                ?>
                    </div>
                </form>
            </div>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Tên khách hàng</th>
                        <th>Giới tính</th>
                        <th>Email</th>
                        <th>Ngày sinh</th>
                        <th>Lịch sử đặt hàng</th>
                    </tr>
                    <?php
                        $i = 1;
                        foreach($data as $user){
                            $gender = ($user[6] == 1) ? 'Nam' : 'Nữ';
                            echo "
                                <tr>
                                    <td>$i</td>
                                    <td>{$user[4]}</td>
                                    <td>{$gender}</td>
                                    <td>{$user[3]}</td>
                                    <td>{$user[5]}</td>
                                    <td><a href='lichsumuahang.php?id={$user[1]}&ten={$user[4]}'>Chi Tiết</a></td>
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
