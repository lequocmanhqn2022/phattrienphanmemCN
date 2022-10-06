<?php
$error = "";
if(isset($_POST['them'])){
    $tensanpham=$_POST['txtsanpham'];
    $thuonghieu=$_POST['thuonghieu'];
    $quocgia=$_POST['txtquocgia'];
    $gioitinh= "";
    $ngaysx=$_POST['txtngaysx'];
    $soluong=$_POST['txtsoluong'];
    $dongia=$_POST['txtdongia'];
    $giamgia=$_POST['txtgiamgia'];
    $mota=$_POST['txtmota'];
    $tenAnh = $_FILES['img']['name'];
    echo $tenAnh;
    $tmp = $_FILES['img']['tmp_name'];
    $ext = explode('.', $tenAnh);
    $ext = $ext[count($ext) - 1];
    $ext = strtolower($ext);
    if($ext != 'jpg' && $ext != 'png' && $ext != 'jpeg'){
        $error = "file không hợp lệ " . $ext;
    }
    else{
        // kết nối
        $connect = mysqli_connect("localhost", "root", "", "web") or die("không thể kết nối");
        // thiết lập bảng mã
        mysqli_query($connect, "set names 'utf8'");
        $query="INSERT INTO `sanpham`(`tenSP`, `mota`, `soluongdaban`, `soluongcon`, `DonGia`, `danhgia`, `quocgia`, `giamgia`, `loaisanpham`, `ngaySX`, `sex`)
        VALUES ('{$tensanpham}','{$mota}','0','{$soluong}','{$dongia}','0','{$quocgia}','{$giamgia}','{$thuonghieu}','{$ngaysx}','{$gioitinh}')";
        mysqli_query($connect,$query)or die("Không thực hiện được");
        echo "
                <script>
                    alert('Thêm thành công');
                    document.location = '/WebNuocHoa/admin/admin.php';
                </script> 
            ";
    }
}
?>


<?php require('../admin/admin.php') ?>
<div class="admin-content-right">
   <form action="" method="POST" class="form-admin" enctype="multipart/form-data">
       <div class="left">
           <div class="form-input">
               <div class="tieude-nho">Tên sản phẩm <span style="color:red;">*</span></div>
               <input type="text" required name="txtsanpham"/>
           </div>
           <div class="form-input">
               <div class="tieude-nho">Chọn thương hiệu <span style="color:red;">*</span></div>
               <div class="selected">
                   <select name="thuonghieu" id="thuonghieu">
                       <option value="">------- Chọn thương hiệu -------</option>
                       
                           <?php
                                // kết nối
                                $connect = mysqli_connect("localhost", "root", "", "web") or die("không thể kết nối");
                                // thiết lập bảng mã
                                mysqli_query($connect, "set names 'utf8'");
                                $query="SELECT * FROM loaisanpham";
                                $result=mysqli_query($connect,$query) or die ("không thực hiện được");
                                $listTH=mysqli_fetch_all($result);
                                foreach($listTH as $thuonghieu){
                                    $i=1;
                                    echo "
                                    <option value='{$i}'>{$thuonghieu[1]}</option>
                                    ";
                                    $i++;
                                }
                           ?>
                   </select>
               </div>
           </div>
           <div class="form-input">
               <div class="tieude-nho">Quốc gia <span style="color:red;">*</span></div>
               <input type="text" required name="txtquocgia"/>
           </div>
           <div class="form-input">
               <div class="tieude-nho">Chuyên dùng <span style="color:red;">*</span></div>
               <div class="others" style="display:flex; width: 50%;justify-content: space-between;">
                    <div class="sex" style="width:50px;">
                        <p class="gioitinh"> Nam </p>
                        <input type="radio" name="gioitinh" class="check1" value="Nam" checked> 
                    </div>
                    <div class="sex" style="width:50px;">
                        <p class="gioitinh"> Nữ </p>
                        <input type="radio" name="gioitinh" class="check2" value="Nữ">
                    </div>
                </div>
           </div>
           <div class="form-input">
               <div class="tieude-nho">Ngày sản xuất <span style="color:red;">*</span></div>
               <input type="date" required name="txtngaysx"/>
           </div>
       </div>
       <div class="right">
           <div class="form-input">
               <div class="tieude-nho">Số lượng <span style="color:red;">*</span></div>
               <input type="text" required name="txtsoluong"/>
           </div>
           <div class="form-input">
               <div class="tieude-nho">Đơn giá <span style="color:red;">*</span></div>
               <input type="text" required name="txtdongia"/>
           </div>
           <div class="form-input">
               <div class="tieude-nho">Giảm giá <span style="color:red;">*</span></div>
               <input type="text" required name="txtgiamgia"/>
           </div>
           <div class="form-input">
               <div class="tieude-nho">Mô tả <span style="color:red;">*</span></div>
               <input type="text" required name="txtmota"/>
           </div>
           <div class="form-input">
               <div class="tieude-nho">Ảnh <span style="color:red;">*</span></div>
               <input type="file" accept="image/*" required name="img"/>
           </div>
        <p style="color: red;"><?php echo $error; ?></p>
           <div class="form-input">
               <button class="btn" type="submit" name="them">Thêm</button>
           </div>
       </div>
   </form>         
</div>
</section>
</body>
</html>