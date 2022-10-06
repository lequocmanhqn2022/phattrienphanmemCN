<?php
    if(isset($_GET['idSP'])){
        $id=$_GET['idSP'];
        // kết nối
        $connect = mysqli_connect("localhost", "root", "", "web") or die("không thể kết nối");
        // thiết lập bảng mã
        mysqli_query($connect, "set names 'utf8'");
        $query="SELECT * FROM sanpham JOIN loaisanpham ON sanpham.loaisanpham = loaisanpham.idLoaiSP WHERE idSP={$id}";
        $result = mysqli_query($connect, $query)or die("Không thực hiện được");
        $sanpham=mysqli_fetch_array($result);
    }
    $errorImg = "";
    if(isset($_POST['sua'])){
        $tenAnh = $_FILES['img']['name'];
        $tmp = $_FILES['img']['tmp_name'];
        $ext = explode('.', $tenAnh);
        $ext = $ext[count($ext) - 1];
        $ext = strtolower($ext);
        if($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg'){
            $errorImg = "file không hợp lệ";
        }
        else{
            require_once('../database.php');
            $direct = '../images/products/';
            $query = "SELECT tenLoaiSP,tenSP FROM sanpham JOIN loaisanpham ON idLoaiSP = sanpham.loaisanpham WHERE idSP = " . $_GET['idSP'];
            $sanpham = layDuLieu($query);

            $tenSP = $sanpham[0]['tenSP'];
            $tenLoai = $sanpham[0]['tenLoaiSP'];
            $direct .= $tenLoai . '/' . $tenSP . '.' . $ext;

            
            move_uploaded_file($tmp ,$direct);
        }
        echo "
                <script>
                    alert('Sửa sản phẩm thành công');
                    document.location = '/WebNuocHoa/admin/admin.php';
                </script> 
            ";
    }
?>


<?php require('../admin/admin.php') ?>
<div class="admin-content-right">
    <form action="" method="POST" class="form-admin" enctype="multipart/form-data">
        <div class="left">
            <div class="form-input">
                <div class="tieude-nho">Tên sản phẩm <span style="color:red;">*</span></div>
                <input type="text" required name="txtsanpham" value="<?php echo $sanpham['tenSP']?>" />
            </div>
            <div class="form-input">
                <div class="tieude-nho">Chọn thương hiệu <span style="color:red;">*</span></div>
                <div class="selected">
                    <select name="thuonghieu" id="thuonghieu">
                        <option value="">
                            <?php echo $sanpham['tenLoaiSP']?>
                        </option>

                        <?php
                                // kết nối
                                $connect = mysqli_connect("localhost", "root", "", "web") or die("không thể kết nối");
                                // thiết lập bảng mã
                                mysqli_query($connect, "set names 'utf8'");
                                $query="SELECT * FROM loaisanpham";
                                $result=mysqli_query($connect,$query) or die ("không thực hiện được");
                                $listTH=mysqli_fetch_all($result);
                                foreach($listTH as $thuonghieu){
                                    echo "
                                    <option value=''>{$thuonghieu[1]}</option>
                                    ";
                                }
                           ?>
                    </select>
                </div>
            </div>
            <div class="form-input">
                <div class="tieude-nho">Quốc gia <span style="color:red;">*</span></div>
                <input type="text" required name="txtquocgia" value="<?php echo $sanpham['quocgia']?>" />
            </div>
            <div class="form-input">
                <div class="tieude-nho">Chuyên dùng <span style="color:red;">*</span></div>
                <div class="others" style="display:flex; width: 50%;justify-content: space-between;">
                    <div class='sex' style='width:50px;'>
                        <p class='gioitinh'> Nam </p>
                        <input type='radio' name='gioitinh' class='check1' value='Nam' <?php if($sanpham['sex']=='1' ){
                            echo 'checked' ; } ?>>
                    </div>
                    <div class='sex' style='width:50px;'>
                        <p class='gioitinh'> Nữ </p>
                        <input type='radio' name='gioitinh' class='check2' value='Nữ' <?php if($sanpham['sex']=='0' ){
                            echo 'checked' ; } ?>>
                    </div>
                </div>
            </div>
            <div class="form-input">
                <div class="tieude-nho">Ngày sản xuất <span style="color:red;">*</span></div>
                <input type="date" required name="txtngaysx" value="<?php echo $sanpham['ngaySX']?>" />
            </div>
            <div class="form-input">
                <div class="tieude-nho">Số lượng đã bán <span style="color:red;">*</span></div>
                <div class="tieude-nho">
                    <?php echo $sanpham['soluongdaban']?>
                </div>
            </div>
        </div>
        <div class="right">
            <div class="form-input">
                <div class="tieude-nho">Số lượng <span style="color:red;">*</span></div>
                <input type="text" required name="txtsoluong" value="<?php echo $sanpham['soluongcon']?>" />
            </div>
            <div class="form-input">
                <div class="tieude-nho">Đơn giá <span style="color:red;">*</span></div>
                <input type="text" required name="txtdongia" value="<?php $dongia = number_format($sanpham['DonGia'], 0, '', '.');
                                                                        echo $dongia .= ' VNĐ';?>" />
            </div>
            <div class="form-input">
                <div class="tieude-nho">Giảm giá <span style="color:red;">*</span></div>
                <input type="text" required name="txtgiamgia" value="<?php $giamgia=$sanpham['giamgia'];
                                                                        echo $giamgia .= '%'?>" />
            </div>
            <div class="form-input">
                <div class="tieude-nho">Mô tả <span style="color:red;">*</span></div>
                <input type="text" required name="txtmota" value="<?php echo $sanpham['mota']?>" />
            </div>
            <div class="form-input">
                <div class="tieude-nho">Ảnh <span style="color:red;">*</span></div>
                <input type="file" accept="image/*" required name="img" />
                <p style="color: red;"><?php echo $errorImg; ?></p>
            </div>
            <div class="form-input">
                <button class="btn" type="submit" name="sua">Sửa</button>
            </div>
        </div>       
    </form>
</div>
</section>
</body>

</html>