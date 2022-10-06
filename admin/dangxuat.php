<?php
    session_start();
    unset($_SESSION['admin']);
    header('location: /WebNuocHoa/user/dangnhap/dangnhap.php');
?>