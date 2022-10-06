<?php 
    $data;
    $error;
    // kết nối
    $connect = mysqli_connect("localhost", "root", "", "web") or die("không thể kết nối");
    // thiết lập bảng mã
    mysqli_query($connect, "set names 'utf8'");
    $query = 'SELECT * FROM chiphivanchuyen';
    $result=mysqli_query($connect, $query)or die("Không thực hiện được");
    $data = mysqli_fetch_all($result);
?>

<?php require('../admin/admin.php') ?>
<div class="admin-content-right">
            <div class="admin-content-right-cartegory">
            <h1>Phí Vận Chuyển</h1>
            <div class="cartegory-search-content">
                <form method="POST" action="ThuongHieu.php">
                    <div class="cartegory-content">
                        <input type="text" required name="text"/>
                        <button class="btnThem" type="submit" name="themTH">Thêm</button>
                    </div>
                </form>
            </div>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Trong Nước</th>
                        <th>Ngoài Nước</th>
                        <th>Tùy chỉnh</th>
                    </tr>
                    <?php
                        $i=1;
                        foreach($data as $list){
                            $id=$list[0];
                            echo "
                                <tr>
                                    <td>$i</td>
                                    <td>{$list[1]}</td>
                                    <td>{$list[2]}</td>
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