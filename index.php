<!DOCTYPE html>
<html lang="en">


<?php

$color='red';
$color2='green';
// echo "<div class='month'>年份:</div>";
// echo "<div class='month'>月份:</div>";
?>


    <?php
    echo "<!-- <br><br> -->";
    function mathMonthToChinese($mathMonth) {
        $mapping = [
            1 => '一月',
            2 => '二月',
            3 => '三月',
            4 => '四月',
            5 => '五月',
            6 => '六月',
            7 => '七月',
            8 => '八月',
            9 => '九月',
            10 => '十月',
            11 => '十一月',
            12 => '十二月',
        ];

        return $mapping[$mathMonth];
    }

    // $month = 9;
    // 設置地區和語言為中文（台灣）
    // setlocale(LC_TIME, 'zh_TW');
    date_default_timezone_set("Asia/Taipei");
    if (!isset($_GET['month']) || empty($_GET['month'])) {
        // $month = date('F');  //英文
        $month = date('n');   //數字
        echo "<!--"."目前數字月份(預設): " . $month ."-->";
        echo "<!-- <br><br> -->";

        // 獲取當前的月份（英文）
        $currentEMonth = date("F");  
        echo "<!--"."目前英文月份(預設): " . $currentEMonth ."-->";
        echo "<!-- <br><br> -->";

        // 獲取當前的月份（中文）
        // $currentMonth = strftime("%B");
        $currentCMonth = mathMonthToChinese($month);
        echo "<!--"."目前中文月份(預設): " . $currentCMonth ."-->";
        echo "<!-- <br><br> -->";

        // $reUrl = "Location: http://localhost/php-homework/WebBackend-Perpetual-Calendar-oscar-chang/index.php?2";
        // header($reUrl);
        // exit();
    }else{
        $month = $_GET['month'];
        $currentCMonth = mathMonthToChinese($month);
        $currentEMonth = chineseMonthToEnglish($currentCMonth);
    }
    
    // echo $month;
    // $year = '2024';
    $year=date("Y");
    echo "<!-- <br><br> -->";
    $firstDay = strtotime(date(date("Y-$month-1")));
    $firstWeekStartDay = date("w",$firstDay);  //第一天是星期幾
    echo "<!--"."第一週的開始是第 ".$firstWeekStartDay." 日 (第一天是星期幾 firstWeekStartDay)" ."-->";
    echo "<!-- <br><br> -->";
    echo "<!--"."目前月份是:". $month ."-->";
    ?>


<?php 
    // if ($month % 2 == 0) {  //偶數月份
    //     $img = rand(0,7).'.png';
    // } else {  //單數月份
    //     $img = rand(0,7).'.png';
    // }

    function getMonthSize($month, $year) {
        switch($month) {
            case 'January':
            case 'March':
            case 'May':
            case 'July':
            case 'August':
            case 'October':
            case 'December':
                return '大';
            case 'April':
            case 'June':
            case 'September':
            case 'November':
                return '小';
            case 'February':
                // 閏年判斷
                if (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)) {
                    return '大'; // 閏年二月有29天，標記為大
                } else {
                    return '小'; // 平年二月有28天，標記為小
                }
            default:
                return '';
        }
    }
    
    // 使用當前年份來測試
    $currentYear = date('Y');
    
    function monthCompare($month, $currentYear) {
        $mapping = [
            '1' => getMonthSize('January', $currentYear),
            '2' => getMonthSize('February', $currentYear),
            '3' => getMonthSize('March', $currentYear),
            '4' => getMonthSize('April', $currentYear),
            '5' => getMonthSize('May', $currentYear),
            '6' => getMonthSize('June', $currentYear),
            '7' => getMonthSize('July', $currentYear),
            '8' => getMonthSize('August', $currentYear),
            '9' => getMonthSize('September', $currentYear),
            '10' => getMonthSize('October', $currentYear),
            '11' => getMonthSize('November', $currentYear),
            '12' => getMonthSize('December', $currentYear)
        ];
        return $mapping[$month];
    }
    
    // 打印陣列來檢查結果
    // print_r($months);
    
    echo "<!--".monthCompare($month, $currentYear)."-->";
    $monthCompare = monthCompare($month, $currentYear);

    // if(monthCompare($month, $currentYear) == '大'){
    //     echo '大月'; 
    // }else{  //非大月其他月份為小月
    //     echo '小月';
    // }

    switch ($monthCompare) {
        case '大':  // 橫式
            $bg_layout = 'big_cover';
            $bg_img = 'horizontal/'.rand(1,43).'.jpg';
            $bg_position = 'center';
            $bg_repeat = 'no-repeat';
            $bg_size = 'cover';
            break;
        case '小':  // 直式
            $bg_layout = 'small_cover';
            $bg_img = 'vertical/'.rand(1,43).'.jpg';
            $bg_position = '20% 10%';
            $bg_repeat = 'no-repeat';
            $bg_size = '50% auto';
            break;
        
        default:
            $bg_layout = 'big_cover';
            $bg_img = 'horizontal/'.rand(1,43).'.jpg';
            $bg_position = 'center';
            $bg_repeat = 'no-repeat';
            $bg_size = 'cover';
            break;
    }
    

    echo "<!-- <br><br> -->";
    $days = date("t",$firstDay);
    echo "<!--"."這個月有幾天:". $days ."-->";
    echo "<!-- <br><br> -->";
    $lastDay = strtotime(date("Y-$month-$days"));
    echo "<!-- <br><br> -->";
    echo "<!--"."最後一天是:". date("Y-m-d",$lastDay) ."-->";
    echo "<!-- <br><br> -->";
    echo "<!--"."今天日期:". date("Y-m-d") ."-->"; 
    echo "<!-- <br><br> -->";
    $currentDateTime = date("H:i:s"); // 24小時制格式（時:分:秒）
    echo "<!--"."當前時分秒: " . $currentDateTime ."-->";
    echo "<!-- <br><br> -->";

    $birthday = '1985-11-22';
    echo "<!--"."我的生日是:".$birthday."<br>" ."-->";
    echo "<!--"."生日月份是:".mb_substr ( $birthday, 5, 2 )."<br>" ."-->";
    echo "<!--"."生日日期是:".mb_substr ( $birthday, 8, 2 )."<br>" ."-->";
    echo "<!-- <br><br> -->";
    // $date=$year.'-'.$month.'-'.$i*7+$j-($firstWeekStartDay-1);
    /* 生日處理判斷 */
    $replace=mb_substr($birthday,0,4);
    $replaceTo=str_replace($replace,date("Y"),$birthday);
    $spDate=strtotime($replaceTo); //生日時間戳
    // $dateSec=strtotime($date); //當下時間戳

    echo "<!-- <hr><hr> -->";
    $total_week = ceil(($days + ($firstWeekStartDay))/7) ;  // 當月總天數+空白天數/7 取無條件進入

    // 输出结果
    echo "<!--"."當月總週數為：" . $total_week . " 周" ."-->";
    echo "<!-- <hr><hr> -->";
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
        echo "<!--".'@'.$month.'@' ."-->";
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
            margin: 0 auto;
            /* background-image: url('./images/horizontal/pexels-sinarz97-20015727.jpg');  */
            background-image: url('./images/<?= $bg_img ?>'); 
            background-size: cover;
            background-repeat:no-repeat;

            background-position: <?= $bg_position ?>;
            background-repeat: <?= $bg_repeat ?>;
            background-size: <?= $bg_size ?>;
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
            /*appearance: none;*/ /* 清除原生外觀 */
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            /*appearance: none; *//* 清除原生外觀 */
            /*background-color: transparent;*/ /* 背景透明 */
            background-color: rgba(255, 255, 255, 0.5); /* 半透明背景 */
            backdrop-filter: blur(10px); /* 設置模糊半徑 */
            color: white;
            font-size: larger;
            font-weight: 900;
            text-align: center;
        }

        /* 下拉選單的選項 */
        .selectopt {
            /*background-color: rgba(255, 255, 255, 0.5);*/ /* 半透明背景 */
            backdrop-filter: blur(10px); /* 設置模糊半徑 */
        }

        /* 滑鼠懸停時的選項樣式 */
        .selectopt:hover {
            /*background-color: #f0f0f0;*/ /* 滑鼠懸停時的背景色 */
            /*background-color: rgba(255, 255, 255, 0.5);*/ /* 半透明背景 */
            backdrop-filter: blur(10px); /* 設置模糊半徑 */
        }

        .month_btn {
            width: 100%;
            display: inline-block;
            float: left;
        }

        .next_month_btn {
            width: 5%;
            /* float: left; */
            text-align: center;
            font-size: 18px;
            letter-spacing: 2px;
            text-shadow: black 0.1em 0.1em 0.2em;
            transition: all 0.2s;
            right: 20%;
            top: 75%;
            position: absolute;
        }
        .pre_month_btn {
            width: 5%;
            /* float: right; */
            text-align: center;
            font-size: 18px;
            letter-spacing: 2px;
            text-shadow: black 0.1em 0.1em 0.2em;
            transition: all 0.2s;
            left: 20%;
            top: 75%;
            position: absolute;
        }
        .pre_month_btn > a, .next_month_btn > a {
            color: white;
            text-decoration: none;
            font-size: xxx-large;
        }
  </style>
  <script>
        function get_year_val() {
            var year = document.getElementById('year').value;
            // console.log(year);
        }

        function get_month_val() {
            var month = document.getElementById("month").value;
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
                var month = urlParams.get('month');
                // console.log(month);

                var monthArray = new Array("1","2","3","4","5","6","7","8","9","10","11","12");  
                if (monthArray.includes(month)) {
                    $('#month').val(month);
                    // console.log(x + " is in the monthArray.");
                } else {
                    var d = new Date();
                    var month = d.getMonth()+1;
                    $('#month').val(month);
                    var re_url = '?month='+month;
                    window.location.href = re_url;
                    // console.log(x + " is not in the monthArray.");
                }
                
            }else{
                var d = new Date();
                var month = d.getMonth()+1;
                $('#month').val(month);
                var re_url = '?month='+month;
                window.location.href = re_url;
            }
        });

        // 使用 JavaScript 動態更新時間
        function updateTime() {
            var now = new Date();
            var hours = now.getHours().toString().padStart(2, '0');
            var minutes = now.getMinutes().toString().padStart(2, '0');
            var seconds = now.getSeconds().toString().padStart(2, '0');
            var currentTime = hours + ":" + minutes + ":" + seconds;
            document.getElementById('current-time').textContent = currentTime;
            setTimeout(updateTime, 1000); // 每秒更新一次時間
        }
    </script>
</head>
<body onload="updateTime()">
<!-- <h1>萬年曆 - Oscar</h1>   -->

<!-- 請在這裹撰寫你的萬年曆程式碼 -->
    <div class="select-date">

        <select onchange="get_year_val()" name="" id="year" class="select">
            <!-- <option class="selectopt" value="1900">1900</option> -->
            <?php
                for ($year = 1900; $year <= 2050; $year++) {
                    echo "<option class='selectopt' value='$year'>$year</option>";
                }
            ?>
        </select> <!--年-->

        <select onchange="get_month_val()" name="" id="month" class="select">
            <option class="selectopt" value="1">1</option>
            <option class="selectopt" value="2">2</option>
            <option class="selectopt" value="3">3</option>
            <option class="selectopt" value="4">4</option>
            <option class="selectopt" value="5">5</option>
            <option class="selectopt" value="6">6</option>
            <option class="selectopt" value="7">7</option>
            <option class="selectopt" value="8">8</option>
            <option class="selectopt" value="9">9</option>
            <option class="selectopt" value="10">10</option>
            <option class="selectopt" value="11">11</option>
            <option class="selectopt" value="12">12</option>      
        </select> <!--月-->

    </div>

    

    <div class="month_btn">
        <!-- <div class="next_month_btn"><a href="index.php?month=<?= $pre ?>">上個月</a></div> -->
        <!--div><?=$month?>月</!--div-->
        <!-- <div class="pre_month_btn"><a href="index.php?month=<?= $next ?>">下個月</a></div> -->
    </div>

    <?php 
    // echo "<hr>";
    ?>
    

    <style>
    .block-table{
        width:722px;
        display:flex;
        flex-wrap:wrap;
        margin: 0 auto;
        transition: .2s all;
        backdrop-filter: blur(2px);
        background-color: rgba(255, 255, 255, 0.5);
    }
    .block-table:hover {
        background-color: rgba(0, 0, 0, .1);
        /* backdrop-filter: invert(80%); */
        backdrop-filter: blur(2px);
        background-color: rgba(255, 255, 255, 0.5);
    }
    .item{
        margin-left: -1px;
        /* background-color: darkcyan; */
        margin-top: -1px;
        display: inline-block;
        width: 100px;
        height: 100px;
        border: 2px solid lightgray;
        position: relative;
        transition: all 0.2s;
        color: white;
        line-height: 50px;
        text-align: center;
        font-weight: bold;
        /* border-top: 1px solid #9E9E9E;
        border-left: 1px solid #9E9E9E;
        border-right: 5px solid #272626;
        border-bottom: 5px solid #3f3e3e; */
    }
    .item-header{
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        margin-left:-1px;
        margin-top:-1px;
        display:inline-block;
        width:100px;
        height: 50px;
        line-height: 50px;
        border:2px solid lightgray;
        text-align: center;
        background-color: #000000b8; 
        color: white; 
        /* border-right-color: white;
        border-right-style: dashed; */
    }
    .item:hover{
        /* background: white; */
        transform: scale(1.1);
        font-size: 60px;
        font-weight:bold;
        /* color: gray; */
        transition: all 0.2s;
        z-index:10;
    }

    .not-month:hover{
        transform: scale(1);
    }

    .holiday{
        text-shadow: none;
    }

    .holiday > .date{
        /* background:pink; */
        font-weight: bold;
        color: red;
        text-shadow: none;
        font-size: x-large;
        text-shadow: white 0.05em 0.05em 0.2em;
    }

    .date {
        font-size: 20px;
        /* letter-spacing: 2px; */
        text-align: right;
        padding-right: 20px;
        text-shadow: black 0.1em 0.1em 0.2em;
        transition: all 0.2s;
    }

    .not-month {
        backdrop-filter: invert(1);
        background-color: unset;
        opacity: 0.8;
    }

    .not-month > .date {
        text-shadow: #9E9E9E 0em 0em 0em;
        color: #c5c5c5;
        /* opacity: 0.8;*/
    }

    .holiday > .public_holiday {
        /* font-weight: bold; */
        color: red;
        text-shadow: none;
        font-size: large;
        text-shadow: white 0.05em 0.05em 0.2em;
    }

    .weekday > .public_holiday {
        /* font-weight: bold; */
        color: red;
        text-shadow: none;
        font-size: large;
        text-shadow: white 0.05em 0.05em 0.2em;
    }

    .weekday > .date{
        /* background:pink; */
        font-weight: bold;
        color: red;
        text-shadow: none;
        font-size: x-large;
        text-shadow: white 0.05em 0.05em 0.2em;
    }

    .public_holiday {
        display: block;
        font-size: 14px;
        font-weight: 100;
        text-align: center;
        letter-spacing: 2px;
    }

    .main-mark {
        display: block;
        width: 50%;
        margin: 25px auto;
        text-shadow: gray 0.2em 0.2em 0.2em;
    }

    .main-mark-year {
        font-size: 60px;
        font-family: fantasy;
        letter-spacing: 12px;
        color: white;
        text-align: right;
    }

    .main-mark-month {
        font-size: 60px;
        font-family: fantasy;
        letter-spacing: 12px;
        color: white;
        text-align: right;
    }

    .main-mark-time {
        font-size: 60px;
        font-family: fantasy;
        letter-spacing: 12px;
        color: white;
        text-align: left;
    }

    /* .holiday-sunday {
        color:red;
    }

    .holiday-saturday {
        color:red;
    }

    .holiday-sunday > .date, .holiday-saturday > .date {
        text-shadow: none;
        text-shadow: #795548 0.05em 0.05em 0.05em;
    }

    .item:hover > .date{
        font-size: 28px;
    } */

    

    </style>

    <div class="pre_month_btn"><a href="index.php?month=<?= $pre ?>" title="上個月">«</a></div>

    <?php 

    $days=[];
    for($i=0;$i<42;$i++){   //這個循環用於生成 42 個日期，這將用於填充一個月的行事曆
        $diff=$i-$firstWeekStartDay;  //計算了當前循環的日期與該月份的第一天之間的差距
        $days[]=date("Y-m-d",strtotime("$diff days",$firstDay));  //根據差距 $diff 將日期加到 $firstDay 上
    }
    // echo "<pre>";
    // print_r($days);
    // echo "</pre>"; 

    function chineseMonthToEnglish($chineseMonth) {
        $mapping = [
            '一月' => 'January',
            '二月' => 'February',
            '三月' => 'March',
            '四月' => 'April',
            '五月' => 'May',
            '六月' => 'June',
            '七月' => 'July',
            '八月' => 'August',
            '九月' => 'September',
            '十月' => 'October',
            '十一月' => 'November',
            '十二月' => 'December',
        ];
    
        return $mapping[$chineseMonth];
    }

    function chineseWeekdayToEnglish($chineseWeekday) {
        $mapping = [
            '星期一' => 'Sunday',
            '星期二' => 'Monday',
            '星期三' => 'Tuesday',
            '星期四' => 'Wednesday',
            '星期五' => 'Thursday',
            '星期六' => 'Friday',
            '星期日' => 'Saturday',
        ];
    
        return $mapping[$chineseWeekday];
    }

    
    if (!isset($_GET['type']) || empty($_GET['type'])) {
        $type = 'ch';
    }else{
        if($_GET['type'] == 'en'){
            $type = 'en';
        }else{
            $type = 'ch';
        }
    }


    // 宣告國定假日的關聯數組
    $holidays = [
        '2024-01-01' => '元旦',
        '2024-02-08' => '春節',
        '2024-02-09' => '春節',
        '2024-02-10' => '春節',
        '2024-02-11' => '春節',
        '2024-02-12' => '春節',
        '2024-02-13' => '春節',
        '2024-02-14' => '春節',
        '2024-02-28' => '和平紀念日',
        '2024-04-04' => '兒童節',
        '2024-04-05' => '兒童節',
        '2024-05-01' => '勞動節',
        '2024-06-10' => '端午節',
        '2024-09-17' => '中秋節',
        '2024-10-10' => '國慶日',

        '2024-02-03' => 'TEST',
        '2024-02-04' => 'TEST',
        '2024-01-31' => 'TEST2',
        '2024-01-28' => 'TEST3',
        '2024-01-27' => 'TEST3',
        '2023-12-31' => 'TEST3',
        // 添加更多國定假日...
    ];

    // 打印出所有的國定假日
    // foreach ($holidays as $date => $holidayName) {  // date=>2024-04-04   // $holidayName=>元旦
    //     echo "日期: $date, 國定假日: $holidayName" . PHP_EOL;
    // }


    if ($type == 'en') {
        echo "<div class='main-mark'>";
        echo "<div class='main-mark-year'>$year</div>";
        echo "<div class='main-mark-month'>$currentEMonth</div>";
        //echo "<div class='main-mark-time'>$currentDateTime</div>";  //php 印出當下時分秒
        echo "<div class='main-mark-time' id='current-time'>$currentDateTime</div>";
        echo "</div>";

        echo "<div class='block-table'>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期一')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期二')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期三')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期四')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期五')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期六')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期日')."</div>";


        foreach($days as $day){
            $c_month=explode("-",$day)[1]; 
            // echo $day;
            $pre_month=$month-1;
            $next_month=$month+1;
            // echo $pre_month;

            //12  1  2
            //11  12 1 

            // 打印出所有的國定假日
            // foreach ($holidays as $date => $holidayName) {  // date=>2024-04-04   // $holidayName=>元旦
            //     echo "日期: $date, 國定假日: $holidayName" . PHP_EOL;
            // }

            /***********************/
            $c_day=explode("-",$day)[2];  //將日期 $day 通過 - 符號拆分為數組，然後取出數組的第三個元素，即日期的天數部分

            if (array_key_exists($day, $holidays)) {  // "指定日期是國定假日";
                // if($c_month==$pre_month || ($month=='1'&&$c_month=='12') || ($month=='12'&&$c_month=='11')){ //非當月日期時
                if($c_month != $month){
                        echo "<div class='item not-month'>";
                        echo "<div class='date'>$c_month.'/'.$c_day</div>";
                        echo "<div class='public_holiday'>$holidays[$day]</div>";  //$holidays['2024-01-01']
                        echo "</div>";
                }/*else if($c_month==$next_month || ($month=='1'&&$c_month=='2') || ($month=='12'&&$c_month=='1')){ //非當月日期時
                        echo "<div class='item not-month'>";
                        echo "<div class='date'>$c_month.'/'.$c_day</div>";
                        echo "<div class='public_holiday'>$holidays[$day]</div>";
                        echo "</div>";
                }*/else{
                    // $c_day=explode("-",$day)[2];  
                    $w=date("w",strtotime($day));
                    if($w==0){  //如果星期幾是 0（星期日）
                            echo "<div class='item holiday holiday-sunday'>";
                            echo "<div class='date'>$c_month.'/'.$c_day</div>";
                            echo "<div class='public_holiday'>$holidays[$day]</div>";
                            echo "</div>";
                    }else if($w==6){  //如果星期幾是 6（星期六）
                            echo "<div class='item holiday holiday-saturday'>";
                            echo "<div class='date'>$c_month.'/'.$c_day</div>";
                            echo "<div class='public_holiday'>$holidays[$day]</div>";
                            echo "</div>";
                    }else{  //如果是工作日（即星期一到星期五）
                            echo "<div class='item weekday'>";
                            echo "<div class='date'>$c_day</div>";
                            echo "<div class='public_holiday'>$holidays[$day]</div>";
                            echo "</div>";
                    }
                }
            }else {  // "指定日期不是國定假日";
                // if($c_month==$pre_month || ($month=='1'&&$c_month=='12') || ($month=='12'&&$c_month=='11')){ //非當月日期時
                if($c_month != $month){
                        echo "<div class='item not-month'>";
                        echo "<div class='date'>$c_month.'/'.$c_day</div>";
                        echo "</div>";
                }/*else if($c_month==$next_month || ($month=='1'&&$c_month=='2') || ($month=='12'&&$c_month=='1')){ //非當月日期時
                        echo "<div class='item not-month'>";
                        echo "<div class='date'>$c_month.'/'.$c_day</div>";
                        echo "</div>";
                }*/else{
                    // $c_day=explode("-",$day)[2];  
                    $w=date("w",strtotime($day));
                    if($w==0){  //如果星期幾是 0（星期日）
                            echo "<div class='item holiday holiday-sunday'>";
                            echo "<div class='date'>$c_month.'/'.$c_day</div>";
                            echo "</div>";
                    }else if($w==6){  //如果星期幾是 6（星期六）
                            echo "<div class='item holiday holiday-saturday'>";
                            echo "<div class='date'>$c_day</div>";
                            echo "</div>";
                    }else{  //如果是工作日（即星期一到星期五）
                            echo "<div class='item'>";
                            echo "<div class='date'>$c_month.'/'.$c_day</div>";
                            echo "</div>";
                    }
                }
            }
        }
        echo "</div>";
    }else if($type == 'ch') {
        echo "<div class='main-mark'>";
        echo "<div class='main-mark-year'>$year</div>";
        echo "<div class='main-mark-month'>$currentCMonth</div>";
        //echo "<div class='main-mark-time'>$currentDateTime</div>";  //php 印出當下時分秒
        echo "<div class='main-mark-time' id='current-time'>$currentDateTime</div>";
        echo "</div>";

        echo "<div class='block-table'>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期一')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期二')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期三')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期四')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期五')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期六')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期日')."</div>";


        foreach($days as $day){
            $c_month=explode("-",$day)[1]; 
            // echo $day;
            $pre_month=$month-1;
            $next_month=$month+1;
            // echo $pre_month;

            //12  1  2
            //11  12 1 
            /***********************/
            $c_day=explode("-",$day)[2];  //將日期 $day 通過 - 符號拆分為數組，然後取出數組的第三個元素，即日期的天數部分

            if (array_key_exists($day, $holidays)) {  // "指定日期是國定假日";
                if($c_month==$pre_month || ($month=='1'&&$c_month=='12') || ($month=='12'&&$c_month=='11')){ //非當月日期時
                        echo "<div class='item not-month'>";
                        echo "<div class='date'>$c_day</div>";
                        echo "<div class='public_holiday'>$holidays[$day]</div>";  //$holidays['2024-01-01']
                        echo "</div>";
                }else if($c_month==$next_month || ($month=='1'&&$c_month=='2') || ($month=='12'&&$c_month=='1')){ //非當月日期時
                        echo "<div class='item not-month'>";
                        echo "<div class='date'>$c_day</div>";
                        echo "<div class='public_holiday'>$holidays[$day]</div>";
                        echo "</div>";
                }else{
                    // $c_day=explode("-",$day)[2];  
                    $w=date("w",strtotime($day));
                    if($w==0){  //如果星期幾是 0（星期日）
                            echo "<div class='item holiday holiday-sunday'>";
                            echo "<div class='date'>$c_day</div>";
                            echo "<div class='public_holiday'>$holidays[$day]</div>";
                            echo "</div>";
                    }else if($w==6){  //如果星期幾是 6（星期六）
                            echo "<div class='item holiday holiday-saturday'>";
                            echo "<div class='date'>$c_day</div>";
                            echo "<div class='public_holiday'>$holidays[$day]</div>";
                            echo "</div>";
                    }else{  //如果是工作日（即星期一到星期五）
                            echo "<div class='item weekday'>";
                            echo "<div class='date'>$c_day</div>";
                            echo "<div class='public_holiday'>$holidays[$day]</div>";
                            echo "</div>";
                    }
                }
            }else {  // "指定日期不是國定假日";
                if($c_month==$pre_month || ($month=='1'&&$c_month=='12') || ($month=='12'&&$c_month=='11')){ //非當月日期時
                        echo "<div class='item not-month'>";
                        echo "<div class='date'>$c_day</div>";
                        echo "</div>";
                }else if($c_month==$next_month || ($month=='1'&&$c_month=='2') || ($month=='12'&&$c_month=='1')){ //非當月日期時
                        echo "<div class='item not-month'>";
                        echo "<div class='date'>$c_day</div>";
                        echo "</div>";
                }else{
                    // $c_day=explode("-",$day)[2];  
                    $w=date("w",strtotime($day));
                    if($w==0){  //如果星期幾是 0（星期日）
                            echo "<div class='item holiday holiday-sunday'>";
                            echo "<div class='date'>$c_day</div>";
                            echo "</div>";
                    }else if($w==6){  //如果星期幾是 6（星期六）
                            echo "<div class='item holiday holiday-saturday'>";
                            echo "<div class='date'>$c_day</div>";
                            echo "</div>";
                    }else{  //如果是工作日（即星期一到星期五）
                            echo "<div class='item'>";
                            echo "<div class='date'>$c_day</div>";
                            echo "</div>";
                    }
                }
            }
        }
        echo "</div>";
    }

    

    ?>
    <div class="next_month_btn"><a href="index.php?month=<?= $next ?>" title="下個月">»</a></div>
</div>
<!-- 請在這裹撰寫你的萬年曆程式碼 -->
  
</body>
</html>