<?php
    if(isset($_GET['tenSP'])){
        $ten=$_GET['tenSP'];
    }
    if(isset($_GET['idThuonghieu'])){
        $id=$_GET['idThuonghieu'];
    }
    // kết nối
    $connect = mysqli_connect("localhost", "root", "", "web") or die("không thể kết nối");
    // thiết lập bảng mã
    mysqli_query($connect, "set names 'utf8'");
    $query="SELECT * FROM sanpham JOIN loaisanpham ON sanpham.loaisanpham = loaisanpham.idLoaiSP WHERE loaisanpham='$id'";
    $result=mysqli_query($connect,$query)or die ("Không thực hiện được");
    $dssp=mysqli_fetch_all($result);
?>

<?php require('../admin/admin.php') ?>
<div class="admin-content-right">
            <div class="admin-content-right-cartegory">
                <p id="tenSP">Thương hiệu: <?php echo $ten ?></p>
                <div class="cartegory-content">
                    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" class="form-admin">
                    <div class="left">
                        <input type="text" required placeholder="Tìm tên sản phẩm" name="TimSP"/>
                        <button class="btnTim" type="submit" name="Tim">Tìm</button>
                    </div>
                    <div class="right">
                        <a href="themsanpham.php"><i class="fas fa-plus-circle"
                                                        style="font-size:60px;color:#D26E4B;padding-left: 20%;padding-top: 15px;"></i></a>
                    </div>
                </form>
                <?php 
                        if(isset($error)){
                        echo "<p style='color:red;'>Không tồn tại khách hàng</p>";
                    }
                ?>
                </div>
                <table>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Quốc gia</th>
                        <th>Đơn giá</th>
                        <th>Ngày sản xuất</th>
                        <th>Số lượng</th>
                        <th>Tùy chọn</th>
                    </tr>
                    <?php
                        foreach($dssp as $loaiSP){
                            $idSP='idSP='. $loaiSP[0];
                            $href = '../images/products/' .$loaiSP[13] .'/'. $loaiSP[1].'.jpg';
                            $dongia=number_format($loaiSP[5], 0, '', '.');
                            echo "
                                <tr>
                                    <td><img src='$href' width='150px' height='150px'> </td>
                                    <td>{$loaiSP[1]}</td>
                                    <td>{$loaiSP[7]}</td>
                                    <td>{$dongia}</td>
                                    <td>{$loaiSP[10]}</td>
                                    <td>{$loaiSP[4]}</td>
                                    <td><a href='suasanpham.php?$idSP'>Chi Tiết</a>|<a href='xoasanpham.php?tenSP={$ten}&idSanPham={$id}&{$idSP}'>Xóa</a></td>
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
