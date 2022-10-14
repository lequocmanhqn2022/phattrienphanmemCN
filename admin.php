<?php 
    session_start();
    if(isset($_SESSION['user'])){
        // user       
        header('location: /WebNuocHoa/TrangChu.php');
    }
    else if(isset($_SESSION['admin'])){
        $admin = $_SESSION['admin'];
    }
    else{
        header('location: /WebNuocHoa/user/dangnhap/dangnhap.php');
    }
    // kết nối
    $connect = mysqli_connect("localhost", "root", "", "web") or die("không thể kết nối");
    // thiết lập bảng mã
    mysqli_query($connect, "set names 'utf8'");
    $query="SELECT * FROM loaisanpham";
    $result=mysqli_query($connect,$query);
    $dsSP=mysqli_fetch_all($result);
    //
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>
<body>
    <header>
        <div class="header-admin">
            <h1>Quản Lý Bán Hàng</h1>
        </div>
    </header>
    <section class="admin-content">
        <div class="admin-content-left">
            <ul>
                <li>
                    <h2 class="mucluc">
                        <i class="fas fa-home"></i>
                        <a href="page-admin.php">Trang chủ</a>
                    </h2>
                </li>
                <li>
                    <h2 class="mucluc">
                        <i class="fab fa-intercom"></i>
                        <a href="khachhang.php">Quản lý khách hàng</a>
                    </h2>
                </li>
                <li>
                    <h2 class="mucluc">
                        <i class="fas fa-history"></i>
                        <a href="hoadon.php">Lịch sử giao dịch</a>
                    </h2>
                </li>
                <li >
                    <h2 class="mucluc">
                        <i class="fas fa-tasks"></i>
                        <span>Sản phẩm</span>
                    </h2> 
                    <ul >
                        <?php
							foreach($dsSP as $loaiSP){
                                $tenSP=$loaiSP[1];
								$idLoai =$loaiSP[0];
								echo "
								<li class='category-item'>
									<a href='sanpham.php?tenSP={$tenSP}&idThuonghieu={$idLoai}' class='category-item__link'>{$loaiSP[1]}</a>
								</li>
								";
							}
						?>
                    </ul>
                </li>
                <li>
                    <h2 class="mucluc">
                        <i class="fas fa-balance-scale"></i>
                        <span>Khác</span>
                    </h2>
                    <ul>
                        <li class='category-item'>
                            <a href='thuonghieu.php' class='category-item__link'>Thương hiệu</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <h2 class="mucluc">
                        <i class="fas fa-sign-out-alt"></i>
                        <a href="dangxuat.php">Đăng Xuất</a>
                    </h2>
                </li>
            </ul>
        </div>
        