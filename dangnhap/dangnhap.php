<?php
    session_start();
    if(isset($_SESSION['admin'])){
        header('location: /WebNuocHoa/admin/page-admin.php');
    }else if(isset($_SESSION['user'])){
        header('location: /WebNuocHoa/TrangChu.php');;}
    else{}
    if (isset($_POST['dangnhap'])){
        $username   = $_POST['txtusername'];
        $password   = $_POST['txtpassword'];

        $pass = md5($password);
        // kết nối
        $connect = mysqli_connect("localhost", "root", "", "web") or die("không thể kết nối");
        // thiết lập bảng mã
        mysqli_query($connect, "set names 'utf8'");
        $query = "SELECT * FROM member WHERE username = '{$username}' and password = '{$pass}'";
        $result = mysqli_query($connect, $query)or die("Không thực hiện được");
        $soLuongRow = $result->num_rows; 
        $loiDangNhap;
        if($soLuongRow == 0){
            $loiDangNhap = true;
        }
        else{
            // dang nhap thanh cong
            $query = "SELECT * FROM member WHERE username = '{$username}' and password = '{$pass}' and chucvu = 1";
            $result = mysqli_query($connect, $query)or die("Không thực hiện được");
            $soLuongRow = $result->num_rows;
            if($soLuongRow == 0){
                // user
                $query = "SELECT * FROM member WHERE username = '{$username}'";
                $result = mysqli_query($connect, $query)or die("Không thực hiện được");
                $_SESSION['user'] = $username;
                $row = mysqli_fetch_array($result);
                $mang_hoten = explode(" ", $row['fullname']); 
                $so_phan_tu = count($mang_hoten);
                $_SESSION['ten'] = $mang_hoten[$so_phan_tu-1];
                header('location: /WebNuocHoa/TrangChu.php');
            }
            else{
                // admin
                $_SESSION['admin'] = $username;
                header('location: /WebNuocHoa/admin/page-admin.php');
            }          
        }
    }
    //
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Đăng nhập</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="DN.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    </head>
    <body>
        <section class="home">
            <div class="row1">
                <div class="list-img">
                    <img id="img" onclick="changeImage()" src="image/1.jpg"  alt="">
                </div>
            </div>
            <div class="row2">
                <div class="login">
                    <div class="form-login">
                        <h2><a id='login' href="dangnhap.php">WELCOME</a></h2>
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                            <div class="input-box">
                                <input type="text" required name="txtusername" placeholder="username" >
                            </div>
                            <div class="input-box">
                                <input type="password" required name="txtpassword" placeholder="password" class="password">
                                <span class="btn-show-hide">
                                    <i class="fas fa-eye" style="display: none; min-width: 20px;"></i>
                                    <i class="fas fa-eye-slash" style="display: block;"></i>
                                </span>
                            </div>
                            <?php 
                                if(isset($loiDangNhap)){
                                    echo "<p style='color:red;'>Sai tài khoản hoặc mật khẩu</p>";
                                }
                            ?>
                            <button class="btn-dangnhap" name="dangnhap" type="submit">Đăng nhập</button>
                            <div><a href="#" class="btn-quenmk">Quên mật khẩu?</a></div>
                            <div class="line"></div>
                            <button class="btn-dangky" name="dangky" type="submit">
                                <a href="/WebNuocHoa/user/dangky/dangky.php">Tạo tài khoản mới</a>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <script >
            const btnShowHideElement = document.querySelector('.btn-show-hide');
            const passwordInputElement = document.querySelector('.input-box .password');
            const openEyeElement = document.querySelector('.btn-show-hide i:first-child');
            const closeEyeElement = document.querySelector('.btn-show-hide i:last-child');

            btnShowHideElement.addEventListener('click', () => {
                if(passwordInputElement.attributes.type.value == "password"){
                passwordInputElement.attributes.type.value =  "text";
                openEyeElement.style.display = "block";
                closeEyeElement.style.display = "none";
                }
                else{
                    passwordInputElement.attributes.type.value =  "password";
                    openEyeElement.style.display = "none";
                    closeEyeElement.style.display = "block";
                    }
            });
            //chuyển đổi ảnh ở trang đăng nhập
            var index = 1;
            changeImage = function changeImage(){
            var imgs = ["image/1.jpg","image/2.jpg","image/3.jpg","image/4.jpg"];
            document.getElementById('img').src = imgs[index];
            index++;
            if(index==4)
            {
                index=0;
            }
            }
            setInterval(changeImage,4000);
        </script>
        <script src="../../admin/online.js"></script>
    </body>
</html>