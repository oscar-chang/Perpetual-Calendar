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
    // $date=$year.'-'.$month.'-'.$i*7+$j-($firstWeekStartDay-1);
    /* 生日處理判斷 */
    $replace=mb_substr($birthday,0,4);
    $replaceTo=str_replace($replace,date("Y"),$birthday);
    $spDate=strtotime($replaceTo); //生日時間戳
    // $dateSec=strtotime($date); //當下時間戳

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
        <div class="next_month_btn"><a href="index.php?month=<?= $pre ?>">上個月</a></div>
        <div><?=$month?></div>
        <div class="pre_month_btn"><a href="index.php?month=<?= $next ?>">下個月</a></div>
    </div>

    <?php 
    echo "<hr>";
    ?>
    

    <style>
    .block-table{
        width:730px;
        display:flex;
        flex-wrap:wrap;
        margin: 0 auto;
    }
    .item{
        margin-left:-1px;
        margin-top:-1px;
        display:inline-block;
        width:100px;
        height:100px;
        border:2px solid lightgray;
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
        width:100px;
        height: 50px;
        line-height: 50px;
        border:2px solid lightgray;
        text-align: center;
        background-color: lightgray; 
        color: white; 
        border-right-color: white;
        border-right-style: dashed;
    }
    .item:hover{
        background: white;
        transform: scale(1.1);
        font-weight:bold;
        /* color: gray; */
        transition: all 0.3s;
        z-index:10;

    }

    .holiday{
        /* background:pink; */
        font-weight: bold;
    }

    .holiday-sunday {
        color:red;
    }

    .holiday-saturday {
        color:red;
    }

    .date {
        text-align: right;
        padding-right: 20px;
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

    function chineseWeekdayToEnglish($chineseMonth) {
        $mapping = [
            '星期一' => 'Sunday',
            '星期二' => 'Monday',
            '星期三' => 'Tuesday',
            '星期四' => 'Wednesday',
            '星期五' => 'Thursday',
            '星期六' => 'Friday',
            '星期日' => 'Saturday',
        ];
    
        return $mapping[$chineseMonth];
    }

    echo "<div class='block-table'>";
    echo "<div class='item-header'>".chineseWeekdayToEnglish('星期一')."</div>";
    echo "<div class='item-header'>".chineseWeekdayToEnglish('星期二')."</div>";
    echo "<div class='item-header'>".chineseWeekdayToEnglish('星期三')."</div>";
    echo "<div class='item-header'>".chineseWeekdayToEnglish('星期四')."</div>";
    echo "<div class='item-header'>".chineseWeekdayToEnglish('星期五')."</div>";
    echo "<div class='item-header'>".chineseWeekdayToEnglish('星期六')."</div>";
    echo "<div class='item-header'>".chineseWeekdayToEnglish('星期日')."</div>";
    foreach($days as $day){
        $format=explode("-",$day)[2];
        $w=date("w",strtotime($day));
        if($w==0){
            echo "<div class='item holiday holiday-sunday'><div class='date'>$format</div></div>";
        }else if($w==6){
            echo "<div class='item holiday holiday-saturday'><div class='date'>$format</div></div>";
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