<!DOCTYPE html>
<html lang="en">


<?php
include 'api/LunarCalendar.php';

// function demo() {
//     $lunar = new Lunar();
//     $month = $lunar->convertSolarToLunar(2018, 1, 2);
//     echo '***';
//     print_r($month);
//     echo '***';
// }

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
    // $month=$_GET['month']??date("m");
    $today_month = date('n'); 
    $today_year = date("Y");
    
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
    }else if($_GET['month'] > 12 || $_GET['month'] < 1){
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

    // $year=date("Y");
    // echo "<!-- <br><br> -->";

    // $year=$_GET['year']??date("Y");
    
    // echo $today_year;
    // echo $year;

    if (!isset($_GET['year']) || empty($_GET['year'])) {
        $year = date('Y');   //數字
        echo "<!--"."目前年分(預設): " . $year ."-->";
        echo "<!-- <br><br> -->";

        // $reUrl = "Location: http://localhost/php-homework/WebBackend-Perpetual-Calendar-oscar-chang/index.php?2";
        // header($reUrl);
        // exit();
    }else{
        $year = $_GET['year'];
        echo "<!--"."目前年分(預設): " . $year ."-->";
    }
    echo "<!--"."目前年分(預設): " . $year ."-->";
    
    // echo $month;
    // $year = '2024';

    $firstDay = strtotime(date(date("$year-$month-1")));
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

    function isLeapYear($year) {
        return ($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0);
    }
    
    function februarySize($year) {
        if (isLeapYear($year)) {
            return '大'; // 閏年二月有29天，標記為大
        } else {
            return '小'; // 平年二月有28天，標記為小
        }
    }

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
                return februarySize($year);
                // 閏年判斷
                // if (($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0)) {
                //     return '大'; // 閏年二月有29天，標記為大
                // } else {
                //     return '小'; // 平年二月有28天，標記為小
                // }
            default:
                return '';
        }
    }
    
    // 使用當前年份來測試
    $currentYear = date('Y');
    
    function monthCompare($month, $year) {
        $mapping = [
            '1' => getMonthSize('January', $year),
            '2' => getMonthSize('February', $year),
            '3' => getMonthSize('March', $year),
            '4' => getMonthSize('April', $year),
            '5' => getMonthSize('May', $year),
            '6' => getMonthSize('June', $year),
            '7' => getMonthSize('July', $year),
            '8' => getMonthSize('August', $year),
            '9' => getMonthSize('September', $year),
            '10' => getMonthSize('October', $year),
            '11' => getMonthSize('November', $year),
            '12' => getMonthSize('December', $year)
        ];
        return $mapping[$month];
    }
    
    // 打印陣列來檢查結果
    // print_r($months);
    
    echo "<!--".monthCompare($month, $currentYear)."-->";
    $monthCompare = monthCompare($month, $year);
    // echo $monthCompare.$year;

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
            $table = 'table1';
            $date_color = 'date-color1';
            $l_date_color = 'l-date-color1';
            // $date_size = 'date-size1';
            $year_color = 'year-color1';
            $month_color = 'month-color1';
            $cz_color = 'cz-color1';
            $time_color = 'time-color1';
            $mark = 'mark1';
            // $pre_btn = 'pre-btn1';
            // $next_btn = 'next-btn1';
            $year_select = 'year-mark';
            $month_select = 'month-mark';
            break;
        case '小':  // 直式
            $bg_layout = 'small_cover';
            $bg_img = 'vertical/'.rand(1,43).'.jpg';
            $bg_position = '20% 10%';
            $bg_repeat = 'no-repeat';
            $bg_size = '35% auto';
            $table = 'table2';
            $date_color = 'date-color2';
            $l_date_color = 'l-date-color2';
            // $date_size = 'date-size2';
            $year_color = 'year-color2';
            $month_color = 'month-color2';
            $cz_color = 'cz-color2';
            $time_color = 'time-color2';
            $mark = 'mark2';
            // $pre_btn = 'pre-btn2';
            // $next_btn = 'next-btn2';
            $year_select = 'year-mark2';
            $month_select = 'month-mark2';
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
    $today = date("d");
    echo "<!--". $today ."-->"; ;
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
        // if($month == '12'){
        //     $next = 1;
        //     $pre = $month-1;
        // }
        // if($month == '1'){
        //     $pre = 12;
        //     $next = $month+1;
        // }
        // if($month < '12' && $month > '1'){
        //     $next = $month+1;
        //     $pre = $month-1;
        // }
        
        if($month-1<1){
            $pre=12;
            $pre_year=$year-1;
        }else{
            $pre=$month-1;
            $pre_year=$year;
        }
        
        if($month+1>12){
            $next=1;
            $next_year=$year+1;
        }else{
            $next=$month+1;
            $next_year=$year;
        }

        if($year < '1900' || $year > '2050') {
            $month = $today_month;
            $go_pre_year = $today_year;
            $go_next_year = $today_year;
        }else {
            $month = $month;
            $go_pre_year=$year-1;
            $go_next_year=$year+1;
        }

        if (!isset($_GET['type']) || empty($_GET['type'])) {
            $type = 'en';
            $lan_box = 'lan-en';
            $select_box = 'select-en';
            $select_box2 = 'select2-en';
        }else{
            if($_GET['type'] == 'en'){
                $type = 'en';
                $lan_box = 'lan-en';
                $select_box = 'select-en';
                $select_box2 = 'select2-en';
            }else{
                $type = 'ch';
                $lan_box = '';
                $select_box = '';
                $select_box2 = '';
            }
        }


        // $gan = array("甲", "乙", "丙", "丁", "戊", "己", "庚", "辛", "壬", "癸");
        // $zhi = array("子", "丑", "寅", "卯", "辰", "巳", "午", "未", "申", "酉", "戌", "亥");
        // $shengxiao = array("鼠", "牛", "虎", "兔", "龍", "蛇", "馬", "羊", "猴", "雞", "狗", "豬");

        // $shengxiaoIndex = ($year - 4) % 12;
        // // $ganzhi = $gan[$ganIndex] . $zhi[$zhiIndex];
        // $shengxiao = $shengxiao[$shengxiaoIndex];
        
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
            background-repeat: no-repeat;

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

        #year {
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
            appearance: none;
            text-shadow: black 0em 0em 0.2em;
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
            appearance: none;
            text-shadow: black 0em 0em 0.2em;
        }

        /* 樣式設置 option */
        .select option {
            /* background-color: #f1f1f1; */
            /* background:red; */
            color: #333;
            /* background-color: #b1b0b063; */
            padding: 10px;
            backdrop-filter: blur(10px);
            /* text-align: left; */
        }

        /* 下拉選單打開時的背景顏色 */
        .select:focus {
            /* background-color: #e1e1e1; */
            /* background: red; */
            /*backdrop-filter: blur(10px);*/ /* 設置模糊半徑 */
        }

        /* 下拉選單的選項 */
        .select {
            /*background-color: rgba(255, 255, 255, 0.5);*/ /* 半透明背景 */
            /*backdrop-filter: blur(10px);*/ /* 設置模糊半徑 */
        }

        /* 滑鼠懸停時的選項樣式 */
        .select:hover {
            /*background-color: #f0f0f0;*/ /* 滑鼠懸停時的背景色 */
            /*background-color: rgba(255, 255, 255, 0.5);*/ /* 半透明背景 */
            /*backdrop-filter: blur(10px);*/ /* 設置模糊半徑 */
        }

        .select-date {
            float: right;
            right: 10%;
            position: absolute;
            float: right;
            right: 30%;
            position: absolute;
            top: 19%;
        }

        .month_btn {
            width: 100%;
            display: inline-block;
            float: left;
        }

        .next_month_btn {
            width: 3%;
            /* float: left; */
            text-align: center;
            font-size: 18px;
            letter-spacing: 2px;
            text-shadow: black 0.1em 0.1em 0.2em;
            transition: all 0.2s;
            right: 26.5%;
            top: 18%;
            position: absolute;
        }
        .pre_month_btn {
            width: 3%;
            /* float: right; */
            text-align: center;
            font-size: 18px;
            letter-spacing: 2px;
            text-shadow: black 0.1em 0.1em 0.2em;
            transition: all 0.2s;
            left: 60%;
            top: 18%;
            position: absolute;
        }
        .pre_month_btn > a, .next_month_btn > a {
            color: white;
            text-decoration: none;
            font-size: xxx-large;
        }

        .next_year_btn {
            width: 3%;
            /* float: left; */
            text-align: center;
            font-size: 18px;
            letter-spacing: 2px;
            text-shadow: black 0.15em 0.11em 0.1em;
            transition: all 0.2s;
            right: 24.5%;
            top: 18%;
            position: absolute;
        }
        .pre_year_btn {
            width: 3%;
            /* float: right; */
            text-align: center;
            font-size: 18px;
            letter-spacing: 2px;
            text-shadow: black 0.15em 0.11em 0.1em;
            transition: all 0.2s;
            left: 58%;
            top: 18%;
            position: absolute;
        }
        .pre_year_btn > a, .next_year_btn > a {
            color: white;
            text-decoration: none;
            font-size: xxx-large;
        }


        .radio input[type="radio"] {display: none; }
        .radio input:checked + .button {background: #5e7380; color: #fff; cursor: default; }
        .radio .button {
            display: inline-block; 
            /*margin: 0 5px 10px 0; */
            padding: 10px 15px;
            background: #f7f7f7; 
            color: #333; 
            cursor: pointer; 
            font-size: larger;
        }
        /* .radio .button:hover {background: #bbb; color: #fff; } */
        .radio .round {border-radius: 5px; }
        .lan_hover {background: black!important; color: #fff!important;font-weight: 900;border-style: groove;}
        .language_box{
            position: absolute;
            left: 64%;
            top: 3%;  /* 12% */
        }
        .chinese_zodiac {
            ilter: drop-shadow(0px 0px 10px rgba(255, 255, 255, .3));
            width: 70px;
            height: auto;
            /* line-height: 57px; */
            justify-content: center;
            display: inline-flex;
            background-blend-mode: lighten;
            /* background-image: linear-gradient(#fffdfd, #fff); */
            background-color: rgba(255, 255, 255, .8);
            border-radius: 10%;
        }
        .chinese_zodiac > img {
            width: 100%;
        }
        .lan-en {
            top: 5.5%;
        }
        .select-en {
            top: 20.5%;
        }
        .select2-en {
            top: 19.5%;
        }
  </style>
  <script>
        function get_year_val() {
            var year = document.getElementById('year').value;
            $('#year').data('year',year); 
            // console.log(year);
            var y = $('#year').data('year');

            var month = document.getElementById("month").value;
            $('#month').data('month',month); 
            // console.log(month);
            var m = $('#month').data('month');

            const urlParams = new URLSearchParams(window.location.search);
            var type = urlParams.get('type');
            var re_url = '?year='+y+'&month='+m+'&type='+type;
            window.location.href = re_url;
        }

        function get_month_val() {
            var year = document.getElementById('year').value;
            $('#year').data('year',year); 
            // console.log(year);
            var y = $('#year').data('year');

            var month = document.getElementById("month").value;
            $('#month').data('month',month); 
            // console.log(month);
            var m = $('#month').data('month');

            const urlParams = new URLSearchParams(window.location.search);
            var type = urlParams.get('type');
            var re_url = '?year='+y+'&month='+m+'&type='+type;
            window.location.href = re_url;
        }

        $(document).ready(function(){
            $('.round').click(function(){
                var type = '';
                var type = $('input[name="language"]:checked').val();
                console.log('type:'+type);
                if(type == 'en' || type == 'ch') {
                    var re_url = '?year='+year+'&month='+month+'&type='+type;
                    window.location.href = re_url;
                }else{
                    var type = 'en';
                    var re_url = '?year='+year+'&month='+month+'&type='+type;
                    window.location.href = re_url;
                }
                // $('.round').removeClass('lan_hover');
                // $(this).addClass('lan_hover');
            });

            // 創建 URL 物件並解析 URL 字符串
            var url = new URL(window.location.href);

            // 獲取 URL 中的 searchParams
            var searchParams = url.searchParams;

            // if (searchParams.has("month") && searchParams.has("year")) {
            //     const urlParams = new URLSearchParams(window.location.search);
            //     var type = urlParams.get('type');
            //     if(type == 'en'){
            //         $('input[name="language"][value="en"]').attr('checked','checked');
            //     }else if(type == 'ch'){
            //         $('input[name="language"][value="ch"]').attr('checked','checked');
            //     }else{
            //         $('input[name="language"][value="en"]').attr('checked','checked');
            //     }
            // }

            // 判斷是否存在 param2 參數
            if (searchParams.has("month") && searchParams.has("year")) {
                var type = '';
                const urlParams = new URLSearchParams(window.location.search);
                var month = urlParams.get('month');
                var year = urlParams.get('year');
                var type = urlParams.get('type');
                console.log('type->'+type);
                if(type != 'en' || type != 'ch') {
                    if(type == 'en'){
                        $('input[name="language"][value="en"]').attr('checked','checked');
                        $('input[name="language"][value="en"]').parents('.round').addClass('lan_hover');
                    }else if(type == 'ch'){
                        $('input[name="language"][value="ch"]').attr('checked','checked');
                        $('input[name="language"][value="ch"]').parents('.round').addClass('lan_hover');
                    }else{
                        $('input[name="language"][value="en"]').attr('checked','checked');
                        $('input[name="language"][value="en"]').parents('.round').addClass('lan_hover');
                    }
                }else{
                    var type = 'en';
                }

                console.log(month);
                console.log(year);
                console.log('type=>'+type);

                // 定義一個函數來檢查年份是否在範圍內
                function isYearInRange(year) {
                    // return yearArray.includes(year);
                    return year >= 1900 && year <= 2050;
                }
                console.log(isYearInRange(year));

                // 定義一個函數來檢查月份是否在範圍內
                function isMonthInRange(month) {
                    return month >= 1 && month <= 12;
                }
                console.log(isMonthInRange(month));
                var type_tmp = '';

                if (isMonthInRange(month) == true && isYearInRange(year) == true) {
                    $('#month').val(month);
                    $('#year').val(year);
                    var type_tmp = urlParams.get('type');
                    if(type_tmp == 'en' || type_tmp == 'ch') {
                        
                    }else{
                        var type = 'en';
                        var re_url = '?year='+year+'&month='+month+'&type='+type;
                        window.location.href = re_url;
                    }
                    
                    console.log("年月 在設定值內.");
                } else {
                    var d = new Date();
                    // 獲取當前月份
                    var month = d.getMonth()+1;
                    // 獲取當前年份
                    var year = d.getFullYear();
                    console.log(year);
                    $('#month').val(month);
                    $('#year').val(year);
                    var type_tmp = urlParams.get('type');
                    if(type_tmp == 'en' || type_tmp == 'ch') {
                        var type = type_tmp;
                    }else{
                        var type = 'en';
                    }
                    var re_url = '?year='+year+'&month='+month+'&type='+type;
                    alert('年月 不在設定值內');
                    window.location.href = re_url;
                    console.log("年月 不在設定值內.");
                }
                
            }else{
                var d = new Date();
                var month = d.getMonth()+1;
                var year = d.getFullYear();
                console.log(year);
                $('#month').val(month);
                $('#year').val(year);
                // var type_tmp = '';
                // var type_tmp = urlParams.get('type');
                //     if(type_tmp == 'en' || type_tmp == 'ch') {
                        
                //     }else{
                //         var type = 'en';
                //         var re_url = '?year='+year+'&month='+month+'&type='+type;
                //         window.location.href = re_url;
                //     }
                var re_url = '?year='+year+'&month='+month+'&type=en';
                window.location.href = re_url;
                console.log("年月 參數有少.");
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
    <div class="language_box <?= $lan_box; ?>">
        <div class="radio">
            <label><span class="round button"><input type="radio" name="language" value="en">en </span></label>
            <label><span class="round button"><input type="radio" name="language" value="ch">ch </span></label>
        </div>
    </div>

    <div class="select-date <?= $select_box; ?>">

        <select onchange="get_year_val()" name="" id="year" class="select <?=$year_select?>">
            <!-- <option class="selectopt" value="1900">1900</option> -->
            <?php
                for ($r_year = 1900; $r_year <= 2050; $r_year++) {
                    echo "<option class='selectopt' value='$r_year'>$r_year</option>";
                }
            ?>
        </select> <!--年-->

        <select onchange="get_month_val()" name="" id="month" class="select <?=$month_select?>">
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

    

    <!-- <div class="month_btn"> -->
        <!-- <div class="next_month_btn"><a href="index.php?month=<?= $pre ?>">上個月</a></div> -->
        <!--div><?=$month?>月</!--div-->
        <!-- <div class="pre_month_btn"><a href="index.php?month=<?= $next ?>">下個月</a></div> -->
    <!-- </div> -->

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
        background-color: rgba(255, 255, 255, 0.7);
    }
    .block-table:hover {
        background-color: rgba(0, 0, 0, .1);
        /* backdrop-filter: invert(80%); */
        backdrop-filter: blur(2px);
        background-color: rgba(255, 255, 255, 0.7);
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
        /* text-shadow: none; */
        font-size: x-large;
        text-shadow: white 0.05em 0.05em 0.02em;
    }

    .date {
        font-size: 26px;
        /* letter-spacing: 2px; */
        text-align: right;
        padding-right: 20px;
        text-shadow: black 0.07em 0.07em 0.05em;
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
        color: red!important;
        text-shadow: none!important;
        font-size: large!important;
        text-shadow: white 0.07em 0.07em 0.05em!important;
    }

    .weekday > .public_holiday {
        /* font-weight: bold; */
        color: red!important;
        text-shadow: none!important;
        font-size: large!important;
        /* text-shadow: white 0.07em 0.07em 0.05em; */
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
        display: block!important;
        font-size: 14px!important;
        font-weight: 100!important;
        text-align: center!important;
        letter-spacing: 2px!important;
        padding-right: 0px!important;
    }

    .main-mark {
        display: block;
        width: 50%;
        margin: 25px auto;
        text-shadow: gray 0.2em 0.2em 0.2em;
    }

    .main-mark-year {
        font-size: 43px;
        font-family: fantasy;
        letter-spacing: 12px;
        color: white;
        text-align: left;
        text-shadow: black 0.07em 0.07em 0.01em;
    }

    .main-mark-month {
        font-size: 60px;
        font-family: fantasy;
        letter-spacing: 12px;
        color: white;
        text-align: center;
        font-weight: 900;
        /* margin: 5px; */
        text-shadow: black 0.07em 0.07em 0.01em;
    }

    .main-mark-time {
        font-size: 40px;
        font-weight: 100;
        font-family: fantasy;
        letter-spacing: 12px;
        color: white;
        text-align: left;
        margin: 15px auto;
    }

    .year-mark2 {
        color: gray !important;
        text-shadow: white 0em 0em 0.2em !important;
    }

    .month-mark2 {
        color: gray !important;
        text-shadow: white 0em 0em 0.2em !important;
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

    .table1 {
        /* text-align: right; */
    }

    .table2 {
        float: right;
    }

    .date-color1 {

    }

    .date-color2 {
        color: black;
        text-shadow: #a3a3a3 0.05em 0.05em 0.02em;
    }

    .l-date-color1 {
        text-shadow: black 0.05em 0.05em 0.07em;
        font-size: 14px!important;
        letter-spacing: 8px;
    }

    .l-date-color2 {
        color: black;
        text-shadow: initial!important;
        font-size: 14px!important;
        letter-spacing: 8px;
    }

    .date-today {
        font-size: xxx-large;
    }

    .year-color1 {

    }

    .year-color2 {
        color: black;
        text-align: right;
        text-shadow: #a3a3a3 0.1em 0.1em 0.2em;
    }

    .month-color1 {

    }

    .month-color2 {
        color: black;
        text-align: right;
        text-shadow: #a3a3a3 0.1em 0.1em 0.2em;
    }

    .cz-color1 {

    }

    .cz-color2 {
        color: black;
        text-align: right;
        text-shadow: #a3a3a3 0.1em 0.1em 0.2em;
    }

    .time-color1 {

    }

    .time-color2 {
        /* margin: 5px; */
        text-align: right;
        color: black;
        text-shadow: #a3a3a3 0.1em 0.1em 0.2em;
    }

    .mark1 {

    }

    .mark2 {
        width: 98%;
    }

    .next-btn1 {

    }

    .next-btn2 {
        right: 4%;
    }

    .pre-btn1 {

    }

    .pre-btn2 {
        left: 46%;
    }


    </style>

    <div class="pre_year_btn <?= $select_box2; ?>"><a href="index.php?year=<?= $go_pre_year ?>&month=<?= $month ?>&type=<?= $type ?>" title="上一年">‹</a></div>

    <div class="pre_month_btn <?= $select_box2; ?>"><a href="index.php?year=<?= $pre_year ?>&month=<?= $pre ?>&type=<?= $type ?>" title="上一個月">«</a></div>

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
            '星期日' => 'Sunday',
            '星期一' => 'Monday',
            '星期二' => 'Tuesday',
            '星期三' => 'Wednesday',
            '星期四' => 'Thursday',
            '星期五' => 'Friday',
            '星期六' => 'Saturday',
        ];
    
        return $mapping[$chineseWeekday];
    }


    // 宣告國定假日的關聯數組 //指定年
    // $holidays = [
    //     '2024-01-01' => '元旦',
    //     '2024-02-08' => '春節',
    //     '2024-02-09' => '春節',
    //     '2024-02-10' => '春節',
    //     '2024-02-11' => '春節',
    //     '2024-02-12' => '春節',
    //     '2024-02-13' => '春節',
    //     '2024-02-14' => '春節',
    //     '2024-02-28' => '和平紀念日',
    //     '2024-04-04' => '兒童節',
    //     '2024-04-05' => '兒童節',
    //     '2024-05-01' => '勞動節',
    //     '2024-06-10' => '端午節',
    //     '2024-09-17' => '中秋節',
    //     '2024-10-10' => '國慶日',

    //     '2024-02-03' => 'TEST',
    //     '2024-02-04' => 'TEST',
    //     '2024-01-31' => 'TEST2',
    //     '2024-01-28' => 'TEST3',
    //     '2024-01-27' => 'TEST3',
    //     '2023-12-31' => 'TEST3',
    //     // 添加更多國定假日...
    // ];

    // 宣告國定假日的關聯數組 //無指定年
    $holidays = [
        '01-01' => '元旦',
        // '02-08' => '春節',  //農曆正月初一至初三
        // '02-09' => '春節',  //農曆正月初一至初三
        // '02-10' => '春節',  //農曆正月初一至初三
        // '02-11' => '春節',  //農曆正月初一至初三
        // '02-12' => '春節',  //農曆正月初一至初三
        // '02-13' => '春節',  //農曆正月初一至初三
        // '02-14' => '春節',  //農曆正月初一至初三
        '02-28' => '和平紀念日',
        '04-04' => '兒童節',
        '04-05' => '清明節',
        '05-01' => '勞動節',
        // '06-10' => '端午節', //‍端午節：農曆五月初五
        // '09-17' => '中秋節', //‍中秋節：農曆八月十五
        '10-10' => '國慶日',

        // '02-03' => 'TEST',
        // '02-04' => 'TEST',
        // '01-31' => 'TEST2',
        // '01-28' => 'TEST3',
        // '01-27' => 'TEST3',
        // '12-31' => 'TEST3',
        // 添加更多國定假日...
    ];

    // 打印出所有的國定假日
    // foreach ($holidays as $date => $holidayName) {  // date=>2024-04-04   // $holidayName=>元旦
    //     echo "日期: $date, 國定假日: $holidayName" . PHP_EOL;
    // }

    // echo $shengxiao;
    $lunar = new Lunar();
    $l_day = $lunar->convertSolarToLunar($year,'01','01');

    $zodiac_id = $l_day[6];

    switch ($zodiac_id) {
        case '鼠':
            $zodiac = 'rat';
            break;
        case '牛':
            $zodiac = 'ox';
            break;
        case '虎':
            $zodiac = 'tiger';
            break;
        case '兔':
            $zodiac = 'rabbit';
            break;
        case '龍':
            $zodiac = 'dragon';
            break;
        case '蛇':
            $zodiac = 'snake';
            break;
        case '馬':
            $zodiac = 'horse';
            break;
        case '羊':
            $zodiac = 'goat';
            break;
        case '猴':
            $zodiac = 'monkey';
            break;
        case '雞':
            $zodiac = 'rooster';
            break;
        case '狗':
            $zodiac = 'dog';
            break;
        case '豬':
            $zodiac = 'pork';
            break; 
        default:
            # code...
            break;
    }
    // var_dump($l_day);
// echo $lun_day;
    if ($type == 'en') {
        echo "<div class='main-mark {$mark}'>";
        echo "<div class='main-mark-year {$year_color}'>$year <span class='chinese_zodiac {$cz_color}'><img src='./images/chinese-zodiac/{$zodiac}.png' alt=''></span></div>";
        echo "<div class='main-mark-month {$month_color}'>$currentEMonth</div>";
        //echo "<div class='main-mark-time'>$currentDateTime</div>";  //php 印出當下時分秒
        echo "<div class='main-mark-time {$time_color}' id='current-time'>$currentDateTime</div>";
        echo "</div>";

        echo "<div class='block-table {$table}'>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期日')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期一')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期二')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期三')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期四')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期五')."</div>";
        echo "<div class='item-header'>".chineseWeekdayToEnglish('星期六')."</div>";
        

    }else if($type == 'ch') {
        echo "<div class='main-mark {$mark}'>";
        echo "<div class='main-mark-year {$year_color}'>$year <span class='chinese_zodiac {$cz_color}'>";
        print_r($l_day[6]);
        echo "</span></div>";
        echo "<div class='main-mark-month {$month_color}'>$currentCMonth</div>";
        //echo "<div class='main-mark-time'>$currentDateTime</div>";  //php 印出當下時分秒
        echo "<div class='main-mark-time {$time_color}' id='current-time'>$currentDateTime</div>";
        echo "</div>";

        echo "<div class='block-table {$table}'>";
        echo "<div class='item-header'>星期日</div>";
        echo "<div class='item-header'>星期一</div>";
        echo "<div class='item-header'>星期二</div>";
        echo "<div class='item-header'>星期三</div>";
        echo "<div class='item-header'>星期四</div>";
        echo "<div class='item-header'>星期五</div>";
        echo "<div class='item-header'>星期六</div>";
        
    }

    

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
            $m_day=explode("-",$day)[1].'-'.explode("-",$day)[2];

            $the_year=$c_day=explode("-",$day)[0]; 
            $the_month=$c_day=explode("-",$day)[1]; 
            $the_day=$c_day=explode("-",$day)[2]; 

            // $tmp_day=solarToLunar(explode("-",$day)[0],explode("-",$day)[1],explode("-",$day)[2]);

            // 農曆宣告
            $lunar = new Lunar();
            $l_day = $lunar->convertSolarToLunar($the_year,$the_month,$the_day);
            $lunar_day = $l_day[1].'-'.$l_day[2];
            if($lunar_day == '正月-初一' || $lunar_day == '正月-初二' || $lunar_day == '正月-初三' || $lunar_day == '正月-初四' || $lunar_day == '正月-初五') {
                // $weekday_day = '春節';
                $weekday = 'weekday';
                $p_holiday = 'public_holiday';
                $lunar_date = '春節';
            }else if($lunar_day == '五月-初五') {
                // $weekday_day = '端午節';
                $weekday = 'weekday';
                $p_holiday = 'public_holiday';
                $lunar_date = '端午節';
            }else if($lunar_day == '八月-十五') {
                // $weekday_day = '中秋節';
                $weekday = 'weekday';
                $p_holiday = 'public_holiday';
                $lunar_date = '中秋節';
            }else{
                $weekday_day = '';
                $weekday = '';
                $p_holiday = '';
                $lunar_date = $l_day[2];
                if($lunar_date == '初一') {
                    $lunar_date = $l_day[1];
                }
            }

            // if (array_key_exists($day, $holidays)) {  // "指定日期是國定假日";  //只顯示當年國定假日
            if (array_key_exists($m_day, $holidays)) {  // "指定日期是國定假日";  //顯示每一年國定假日
                // if($c_month==$pre_month || ($month=='1'&&$c_month=='12') || ($month=='12'&&$c_month=='11')){ //非當月日期時
                    if($c_month != $month){
                            echo "<div class='item not-month'>";
                            echo "<div class='date'>$c_day</div>";
                            echo "<div class='public_holiday {$p_holiday}'>$holidays[$m_day] </div>";  //$holidays['2024-01-01']
                            echo "</div>";
                    }/*else if($c_month==$next_month || ($month=='1'&&$c_month=='2') || ($month=='12'&&$c_month=='1')){ //非當月日期時
                            echo "<div class='item not-month'>";
                            echo "<div class='date'>$c_day</div>";
                            echo "<div class='public_holiday'>$holidays[$day]</div>";
                            echo "</div>";
                    }*/else{
                        // $c_day=explode("-",$day)[2];  
                        $w=date("w",strtotime($day));
                        if($w==0){  //如果星期幾是 0（星期日）
                                echo "<div class='item holiday holiday-sunday {$weekday}'>";
                                echo "<div class='date'>$c_day</div>";
                                echo "<div class='public_holiday {$p_holiday}'>$holidays[$m_day] </div>";
                                echo "</div>";
                        }else if($w==6){  //如果星期幾是 6（星期六）
                                echo "<div class='item holiday holiday-saturday {$weekday}'>";
                                echo "<div class='date'>$c_day</div>";
                                echo "<div class='public_holiday {$p_holiday}'>$holidays[$m_day]</div>";
                                echo "</div>";
                        }else{  //如果是工作日（即星期一到星期五）
                                echo "<div class='item weekday {$weekday}'>";
                                echo "<div class='date'>$c_day</div>";
                                echo "<div class='public_holiday {$p_holiday}'>$holidays[$m_day]</div>";
                                echo "</div>";
                        }
                    }
            }else {  // "指定日期不是國定假日";
                // if($c_month==$pre_month || ($month=='1'&&$c_month=='12') || ($month=='12'&&$c_month=='11')){ //非當月日期時
                if($c_month != $month){
                        echo "<div class='item not-month'>";
                        echo "<div class='date'>$c_day</div>";
                        echo "<div class='date {$l_date_color}'>";
                        // echo $lunar_day;
                        echo $lunar_date;
                        echo "</div>";
                        echo "</div>";
                }/*else if($c_month==$next_month || ($month=='1'&&$c_month=='2') || ($month=='12'&&$c_month=='1')){ //非當月日期時
                        echo "<div class='item not-month'>";
                        echo "<div class='date'>$c_day</div>";
                        echo "</div>";
                }*/else{
                    // $c_day=explode("-",$day)[2];  
                    if($c_day == $today && $month == $today_month && $year == $today_year){
                        echo "<div class='item {$weekday}'>";
                        echo "<div class='date {$date_color} date-today'>$c_day</div>";
                        echo "<div class='date {$l_date_color} {$p_holiday}'>";
                        // echo $lunar_day;
                        echo $lunar_date;
                        echo "</div>";
                        echo "</div>";
                    }else{
                        $w=date("w",strtotime($day));
                        if($w==0){  //如果星期幾是 0（星期日）
                                echo "<div class='item holiday holiday-sunday {$weekday}'>";
                                echo "<div class='date'>$c_day</div>";
                                echo "<div class='date {$l_date_color} {$p_holiday}'>";
                                // echo $lunar_day;
                                echo $lunar_date;
                                echo "</div>";
                                echo "</div>";
                        }else if($w==6){  //如果星期幾是 6（星期六）
                                echo "<div class='item holiday holiday-saturday {$weekday}'>";
                                echo "<div class='date'>$c_day</div>";
                                echo "<div class='date {$l_date_color} {$p_holiday}'>";
                                // echo $lunar_day;
                                echo $lunar_date;
                                echo "</div>";
                                echo "</div>";
                        }else{  //如果是工作日（即星期一到星期五）
                                echo "<div class='item {$weekday}'>";
                                echo "<div class='date {$date_color}'>$c_day</div>";
                                echo "<div class='date {$l_date_color} {$p_holiday}'>";
                                // echo $lunar_day;
                                echo $lunar_date;
                                echo "</div>";
                                echo "</div>";
                        }
                    }
                }
            }
        }
        echo "</div>";
    

        echo "</div>";
    // }

    

    ?>
    
    <div class="next_month_btn <?= $select_box2; ?>"><a href="index.php?year=<?= $next_year ?>&month=<?= $next ?>&type=<?= $type ?>" title="下一個月">»</a></div>
    <div class="next_year_btn <?= $select_box2; ?>"><a href="index.php?year=<?= $go_next_year ?>&month=<?= $month ?>&type=<?= $type ?>" title="下一年">›</a></div>

</div>
<!-- 請在這裹撰寫你的萬年曆程式碼 -->
  
</body>
</html>