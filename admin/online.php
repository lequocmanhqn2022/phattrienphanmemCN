<?php
    if(!isset($_SESSION['online'])){
        $_SESSION['online'] = session_id();
    } 
    $id = $_SESSION['online'];
    $time = date("Y-m-d H:i:s");
    $data = file_get_contents('online.txt');
    $data = json_decode($data, true);
    $data[$id] = $time;
    file_put_contents('online.txt', json_encode($data));
    function reloadOnline(){
        $now = date("Y-m-d H:i:s");
        $data = file_get_contents('online.txt');
        $data = json_decode($data, true);
        foreach($data as $id => $date){
            $difSecond = strtotime($data[$id]) - (strtotime($now) - 10);
            if($difSecond < 0){
                unset($data[$id]);
                file_put_contents('online.txt', json_encode($data));
            }
        }
        echo count($data)-1;
    }
?>