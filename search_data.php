<?php 
    $servername = "localhost";//伺服器名稱  本機位置  
    $username = "root";//使用者名稱
    $password = "W@3edsaq1";//密碼 未設置
    $dbname = "test";//資料庫名稱

    $conn = new mysqli($servername, $username, $password, $dbname);
    $status = $_GET["status"];

    if ($status == 1) {

        $Source_IP = $_GET["Source_IP"];
        $query = sprintf("SELECT * FROM `test` where `SourceIP` = '$Source_IP' order by Date, Time, usec desc");
    }

    if ($status == 2) {

        $Time_range_form = $_GET["Time_range_form"];
        $Time_range_to = $_GET["Time_range_to"];
        $date_start = explode(" " , $Time_range_form);
        $time_start = explode("." , $date_start[1]);
        $date_end = explode(" " , $Time_range_to);
        $time_end = explode("." , $date_endate[1]);
        $query = sprintf("SELECT * FROM `test` where  `Date` between  '$date_start[0]' and '$date_end[0]' and `Time` between  '$time_start[0]' and '$time_end[0]' and `usec` between  '$time_start[1]' and '$time_end[1]' order by Date, Time, usec desc");
        
    }

    if ($status == 3) {

        $FQDN = $_GET["FQDN"];
        $query = sprintf("SELECT * FROM `test` where `FQDN` = '$FQDN' order by Date, Time, usec desc");
    }
   
    $search = $conn->query($query);//宣告search = query()函數執行某個針對數據庫的查詢

    $data = array();//宣告data為空array

    foreach ($search as $row) {//循環 search查找到的數據 分配給$row
        $data[] = $row;//$row 在塞data空array
    }

    $search->close();//查找關閉

    $conn->close();//關閉連線

    print json_encode($data); //輸出 為json_encode的數據資料
?>