<?php
    $dangky;
    $loidangky;
    $connect = mysqli_connect("localhost", "root", "", "web") or die("không thể kết nối");
        // thiết lập bảng mã
    mysqli_query($connect, "set names 'utf8'");
    if(isset($_POST['dangky'])){
        $username   = $_POST['txtUsername'];
        $password   = $_POST['txtPassword'];
        $repassword = $_POST['txtRePassword'];
        $email      = $_POST['txtEmail'];
        $fullname   = $_POST['txtFullname'];
        $birthday   = $_POST['txtBirthday'];
        $sex        = $_POST['txtSex'];

        if($username == '' || $password == '' || $repassword == '' || $email == '' || $fullname == '' || $birthday == '' || $sex == ''){
            $loidangky = 'Vui lòng điền đủ thông tin!';
        }
        else if(strlen($password)<5){
            $loidangky = 'Mật khẩu không bảo mật !';
        }
        else if($password != $repassword){
            $loidangky = 'Mật khẩu không khớp!';
        }
        
        else if(strtotime($birthday) < strtotime("1999-01-01")){
            $loidangky ='Bạn chưa đủ tuổi !';
        }
        else if($username != ''){
            $query = "SELECT * FROM member WHERE username = '{$username}'";
            $result = mysqli_query($connect, $query)or die("Không thực hiện được");
            $count = $result->num_rows;
            if($count > 0){
                $loidangky = 'Username đã tồn tại!';
            }
        }
        else if($email != ''){
            $query = "SELECT * FROM member WHERE email = '{$email}'";
            $count = $result->num_rows;
            if($count > 0){
                $loidangky = 'Email đã tồn tại!';
            }
        }

        if(!isset($loidangky)){
            $pass = md5($password);
            $query = "INSERT INTO member(username, password, email, fullname, birthday, sex) VALUES ('{$username}','{$pass}','{$email}','{$fullname}', '{$birthday}', {$sex})";
            mysqli_query($connect, $query);
            echo "
            <script>
                alert('Đăng ký thành công');
                document.location = '/WebNuocHoa/user/dangnhap/dangnhap.php';
            </script> 
        ";
        }
    }
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="type.css">
        <title>Đăng ký</title>
    </head>
    <body>
        <div class="t1">
                <div class="slider">
                    <img class="slide" stt="0" src="https://images.squarespace-cdn.com/content/v1/53883795e4b016c956b8d243/1556180336379-6Q2NSCBGQ6Y895LVE0JB/6755a278394229.5ca3ac07eb08f.jpg?format=1000w"/>
                    <img class="slide" style="display:none" stt="1" src="https://images.squarespace-cdn.com/content/v1/53883795e4b016c956b8d243/1556180376617-AV12DX2A2O5DKFW8L3C9/30e80e78394229.5ca3ab3a573ab.jpg?format=1000w"/>
                    <img class="slide" style="display:none" stt="2" src="https://afamilycdn.com/2020/2/13/h5-15815760072151366965636.jpg"/> 
                    <img class="slide" style="display:none" stt="3" src="https://bazaarvietnam.vn/wp-content/uploads/2020/03/han-su-dung-nuoc-hoa-freepik.jpg"/> 
                    <a href="#" id="prev"><i class="fas fa-chevron-left"></i></a>
                    <a href="#" id="next"><i class="fas fa-chevron-right"></i></a>
                </div>
        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
            <h1>Đăng ký tài khoản</h1>
            <table>
                <tr>
                    <td>
                        Tên đăng nhập : 
                    </td>
                    <td>
                        <input type="text" require name="txtUsername" size="50" name="taikhoan"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Mật khẩu :
                    </td>
                    <td>
                        <input type="password" require name="txtPassword" size="50" name="matkhau"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Nhập lại mật khẩu :
                    </td>
                    <td>
                        <input type="password" require name="txtRePassword" size="50" name="rematkhau"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Email :
                    </td>
                    <td>
                        <input type="text" require name="txtEmail" size="50" name="email"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Họ và tên :
                    </td>
                    <td>
                        <input type="text" require name="txtFullname" size="50" name="hoten"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Ngày sinh :
                    </td>
                    <td>
                        <input type="date" require name="txtBirthday" size="50" name="ngaysinh"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        Giới tính :
                    </td>
                    <td>
                        <select require name="txtSex" name="gioitinh">
                            <option value="1" checked>Nam</option>
                            <option value="0">Nữ</option>
                        </select>
                    </td>
                </tr>
                <?php 
                    if(isset($dangky)){
                        header('location: /WebNuocHoa/user/dangnhap/dangnhap.php');
                    }
                    else if(isset($loidangky)){
                        echo "<p style='color:red;'>{$loidangky}</p>";
                    }
                ?>
            </table>
            <div class="dk">
                <input type="submit" name="dangky" value="Đăng ký" />
            </div>
        </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.0.min.js"></script>
        <script>
            $(()=>{
                $('#next').click(function(){
                    changeImage('next');
                })
                $('#prev').click(function(){
                    changeImage('prev');
                })
            })
           function changeImage(type){
                let imgSelectVisible = $('img.slide:visible');
                let imgVisible = parseInt(imgSelectVisible.attr('stt'));
                let eqNumber = type === 'next' ? imgVisible + 1 : imgVisible - 1;
                if(eqNumber >= $('.slide').length){
                    eqNumber=0;
                }
                $('img.slide').eq(eqNumber).fadeToggle(3500);
                imgSelectVisible.hide();
            }
           setInterval(function(){
                $('#next').click();
            },4500);
        </script>
    </body>
</html>