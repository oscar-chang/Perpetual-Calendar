<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="#">
  <title>萬年曆作業</title>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <style>
   /*請在這裹撰寫你的CSS*/ 
   *{
            font-family: 'Courier New', Courier, monospace;
        }
        body {
            width: 80%;
        }
        .block_margin_35 {
            width: 75%;
        }
        table {
            border: 5px double black;
            border-collapse: collapse;
            margin: 0 auto;
        }
        td {
            border: 2px black;
            border-style: groove;
            padding: 3px 10px;
        }

        .red {
            color: red;
            font-weight:900;
        }

        .green {
            color: green;
            font-weight:900;
        }

        #month {
            font-size: 18px;
            padding: 5px 7px;
        }

        .month_btn {
            width: 100%;
            display: inline-block;
            float: left;
        }

        .next_month_btn {
            width: 35%;
            float: left;
            text-align: center;
        }
        .pre_month_btn {
            width: 35%;
            float: right;
            text-align: center;
        }
  </style>
  <script>
        function get_month_val() {
            month = document.getElementById("month").value;
            $('#month').data('month',month); 
            // console.log(month);

            var m = $('#month').data('month');
            var re_url = '?month='+m;
            window.location.href = re_url;
        }

        $(document).ready(function(){
            // 創建 URL 物件並解析 URL 字符串
            var url = new URL(window.location.href);

            // 獲取 URL 中的 searchParams
            var searchParams = url.searchParams;

            // 判斷是否存在 param2 參數
            if (searchParams.has("month")) {
                const urlParams = new URLSearchParams(window.location.search);
                var month = urlParams.get('month');;
                // console.log(month);
                $('#month').val(month);
            }
        });
    </script>
</head>
<body>
<h1>萬年曆 - Oscar</h1>  


<!-- 請在這裹撰寫你的萬年曆程式碼 -->
<div class="header"><h1>時間</h1></div>
<div class="block_margin_35">

    <h2>線上月曆製作</h2>
    <ul>
        <li>以表格方式呈現整個月份日期</li>
        <li>可以在特殊日其中顯示資訊(假日或紀念日)</li>
        <li>嘗試以block box 或 flex box 的方式製作月曆</li>
    </ul>
    <?php

    $color='red';
    $color2='green';
    // echo "<div class='month'>年份:</div>";
    // echo "<div class='month'>月份:</div>";
    ?>

    <select onchange="get_month_val()" name="" id="month">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>      
    </select>


    <?php
    // $month = 9;
    if (!isset($_GET['month'])) {
        // $month = date('F');  //英文
        $month = date('n');   //數字
    }else{
        $month = $_GET['month'];
    }
    
    // echo $month;
    // $year = '2024';
    $year=date("Y");
    echo "<br>";
    $firstDay = strtotime(date(date("Y-$month-1")));
    $firstWeekStartDay = date("w",$firstDay);  //第一天是星期幾
    echo "第一週的開始是第 ".$firstWeekStartDay." 日 (第一天是星期幾 firstWeekStartDay)";
    echo "<br><br>";
    echo "目前月份是:". $month;
    echo "<br>";
    $days = date("t",$firstDay);
    echo "這個月有幾天:". $days;
    echo "<br>";
    $lastDay = strtotime(date("Y-$month-$days"));
    echo "最後一天是 ". date("Y-m-d",$lastDay);
    echo "<br>";
    echo "<br>";

    $birthday = '1985-11-22';
    echo "我的生日是:".$birthday."<br>";
    echo "生日月份是:".mb_substr ( $birthday, 5, 2 )."<br>";
    echo "生日日期是:".mb_substr ( $birthday, 8, 2 )."<br>";
    echo "<br>";

    echo "<hr>";
    $total_week = ceil(($days + ($firstWeekStartDay))/7) ;  // 當月總天數+空白天數/7 取無條件進入

    // 输出结果
    echo "當月總週數為：" . $total_week . " 周";
    echo "<hr>";
    ?>

    <?php 
        // // 當判斷是裡面只有一行 && 給值 才可以簡化為 3元運算式
        // if(true){
        //     $month = '';
        // }else{
        //     $month = '';
        // }

        // //簡化為
        // $month = (isset($_GET['month']))?$_GET['month']:date("Y");


        // if($month-1 >=1){
        //     $pre = '';
        // }
        echo '@'.$month.'@';
        if($month == '12'){
            $next = 1;
            $pre = $month-1;
        }
        if($month == '1'){
            $pre = 12;
            $next = $month+1;
        }
        if($month < '12' && $month > '1'){
            $next = $month+1;
            $pre = $month-1;
        }
        // if($month > '1'){
            
        // }
    ?>

    <div class="month_btn">
        <div class="next_month_btn"><a href="calendar.php?month=<?= $pre ?>">上個月</a></div>
        <div class="pre_month_btn"><a href="calendar.php?month=<?= $next ?>">下個月</a></div>
    </div>

    <?php 
    echo "<hr>";

    /*
    4  1  1 -0
    5  3  3 -2
    6  6  6 -5
    7  1  1 -0
    */

    echo "<table>";
    echo "<tr>";
    echo "<td class='$color' style='';>日</td>";
    echo "<td>一</td>";
    echo "<td>二</td>";
    echo "<td>三</td>";
    echo "<td>四</td>";
    echo "<td>五</td>";
    echo "<td class='$color2' style='';>六</td>";
    echo "</tr>";



    // 我改寫的
    for($i=0;$i<$total_week;$i++){   //一個月最多 6 個禮拜
        echo "<tr>";
        for($j=0;$j<7;$j++){   //一個禮拜最多 7 天
            if($i==0 /* $j>=$firstWeekStartDay */){  // 第一列
                if($j>=$firstWeekStartDay){  // 一號之後有日期
                    if($j==0){
                        echo "<td class='$color' style=''>◆";  //星期日
                        echo    $i*7+$j-($firstWeekStartDay-1);
                        echo "</td>";
                    }else if($j==6){
                        echo "<td class='$color2' style='';>★";  //星期六
                        echo    $i*7+$j-($firstWeekStartDay-1);
                        echo "</td>";
                    }else{
                        echo "<td>^";
                        echo    $i*7+$j-($firstWeekStartDay-1);  //星期一~五
                        echo "</td>";
                    }
                }else{  // 一號之前沒日期
                    if($j==0){
                        echo "<td class='$color' style='';>$";  //星期日
                        echo "";
                        echo "</td>";
                    }else if($j==6){
                        echo "<td class='$color2' style='';>㊣";  //星期六
                        echo    $i*7+$j-($firstWeekStartDay-1);
                        echo "</td>";
                    }else{
                        echo "<td>?";
                        echo "";                                //星期一~五
                        echo "</td>";
                    }
                }   
            }else if($i>0){   // 第二列之後
                if($j==0){
                    echo "<td class='$color' style='';>＃";   //星期日
                    if($i*7+$j-($firstWeekStartDay-1)<=$days){
                        echo $i*7+$j-($firstWeekStartDay-1);
                    }else{
                        echo "+ &nbsp;";  //最後沒日期星期日
                    }
                    echo "</td>";
                }else if($j==6){
                    echo "<td class='$color2' style='';>◎";  //星期六
                    if($i*7+$j-($firstWeekStartDay-1)<=$days){
                        echo $i*7+$j-($firstWeekStartDay-1);
                    }else{
                        echo "- &nbsp;";   //最後沒日期星期六
                    }
                    echo "</td>";
                }else{
                    echo "<td>";
                    if($i*7+$j-($firstWeekStartDay-1)<=$days){
                        echo '■'.$i*7+$j-($firstWeekStartDay-1);  //第三排到最後一天
                    }else{
                        echo "! &nbsp;";   //最後沒日期星期一~星期五
                    }
                    echo "</td>";
                }
                    
                
            }else{
                echo "<td></td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";


    echo "<br>";
    //老師的
    echo "<table>";
    echo "<tr>";
    echo "<td>日</td>";
    echo "<td>一</td>";
    echo "<td>二</td>";
    echo "<td>三</td>";
    echo "<td>四</td>";
    echo "<td>五</td>";
    echo "<td>六</td>";
    echo "</tr>";
    for($i=0;$i<6;$i++){
        echo "<tr>";
        for($j=0;$j<7;$j++){
            $date=$year.'-'.$month.'-'.$i*7+$j-($firstWeekStartDay-1);
            /* 生日處理判斷 */
            $replace=mb_substr($birthday,0,4);
            $replaceTo=str_replace($replace,date("Y"),$birthday);
            $spDate=strtotime($replaceTo); //生日時間戳
            $dateSec=strtotime($date); //當下時間戳
            /* 生日處理判斷 */
            if($i==0 && $j>=$firstWeekStartDay ){
                if($spDate==$dateSec){ // 假如 生日時間戳 = 下時間戳 就特別顯示
                    echo "<td style='background-color:yellow;font-weight:bolder;font-size:24px;color:blue'>";
                }else if(date("w",strtotime($date))==0 || date("w",strtotime($date))==6){
                    echo "<td style='background-color:pink'>";
                }else{
                    echo "<td>";
                }
                echo    $i*7+$j-($firstWeekStartDay-1);
                echo "</td>";
            }else if($i>0){
                if($spDate==$dateSec){
                    echo "<td style='background-color:yellow;font-weight:bolder;font-size:24px;color:blue'>";
                }else if(date("w",strtotime($date))==0 || date("w",strtotime($date))==6){
                    echo "<td style='background-color:pink'>";
                }else{
                    echo "<td>";
                }
                if($i*7+$j-($firstWeekStartDay-1)<=$days){
                    echo $i*7+$j-($firstWeekStartDay-1);
                }else{
                    echo "&nbsp;";
                }
                echo "</td>";
                
            }else{
                echo "<td></td>";
            }
        }
        echo "</tr>";
    }
    echo "<br>";

    //  印 $i $j
    echo "<table>";
    echo "<tr>";
    echo "<td>日</td>";
    echo "<td>一</td>";
    echo "<td>二</td>";
    echo "<td>三</td>";
    echo "<td>四</td>";
    echo "<td>五</td>";
    echo "<td>六</td>";
    echo "</tr>";
    echo "<br>";
    echo "<br>";
    for($i=0;$i<6;$i++){  
        echo "<tr>";
        for($j=0;$j<7;$j++){
            if($i==0 && $j>=$firstWeekStartDay ){
                echo "<td>";
                echo    $i*7+$j-($firstWeekStartDay-1)  ."<br>﹝i列".$i.",j欄".$j."﹞";
                echo "<br>".$i."*7+".$j."-(".$firstWeekStartDay."-1)";
                echo "</td>";
            }else if($i>0){
                echo "<td>";
                if($i*7+$j-($firstWeekStartDay-1)<=$days){
                    echo $i*7+$j-($firstWeekStartDay-1) ."<br>﹝i列".$i.',j欄'.$j."﹞";
                    echo "<br>".$i."*7+".$j."-(".$firstWeekStartDay."-1)";
                }else{
                    echo "&nbsp;";
                }
                echo "</td>";
                
            }else{
                echo "<td></td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>";
    ?>
    

    <style>
    .block-table{
        width:380px;
        display:flex;
        flex-wrap:wrap;
        margin: 0 auto;
    }
    .item{
        margin-left:-1px;
        margin-top:-1px;
        display:inline-block;
        width:50px;
        height:50px;
        border:1px solid lightgreen;
        position:relative;
        transition: all 0.3s;
        background:white;
        line-height: 50px;
        text-align: center;
    }
    .item-header{
        margin-left:-1px;
        margin-top:-1px;
        display:inline-block;
        width:50px;
        height: 30px;
        line-height: 35px;
        border:1px solid lightgreen;
        text-align: center;
        background-color: black; 
        color: white; 
    }
    .item:hover{
        background:lightblue;
        transform: scale(1.3);
        font-weight:bold;
        color: gray;
        transition: all 0.3s;
        z-index:10;

    }

    .holiday{
        background:pink;
    }



    </style>
    <?php 

    $days=[];
    for($i=0;$i<42;$i++){
        $diff=$i-$firstWeekStartDay;
        $days[]=date("Y-m-d",strtotime("$diff days",$firstDay));
    }
    /* echo "<pre>";
    print_r($days);
    echo "</pre>"; */
    echo "<div class='block-table'>";
    echo "<div class='item-header'>日</div>";
    echo "<div class='item-header'>一</div>";
    echo "<div class='item-header'>二</div>";
    echo "<div class='item-header'>三</div>";
    echo "<div class='item-header'>四</div>";
    echo "<div class='item-header'>五</div>";
    echo "<div class='item-header'>六</div>";
    foreach($days as $day){
        $format=explode("-",$day)[2];
        $w=date("w",strtotime($day));
        if($w==0 || $w==6){

            echo "<div class='item holiday'>$format</div>";
        }else{

            echo "<div class='item'>";
            echo "<div class='date'>$format</div>";
            echo "</div>";
        }
    }
    echo "</div>";

    ?>
</div>
<!-- 請在這裹撰寫你的萬年曆程式碼 -->
  
</body>
</html>