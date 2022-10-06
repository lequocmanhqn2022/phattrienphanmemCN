<?php
    session_start();    
    unset($_SESSION['user']);
    header('location: /WebNuocHoa/user/dangnhap/dangnhap.php');
?>