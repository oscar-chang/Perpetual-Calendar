<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="#">
    <title>萬年曆作業</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style.css">
    <script src="js/index.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js"></script> -->
    <script>
        // $('img.lazy').lazyload({
        //     effect:'fadeIn'
        // });
    </script>
    
    <?php
    include 'api/LunarCalendar.php';
    ?>

    <?php
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

    // 設置地區和語言為中文（台灣）
    date_default_timezone_set("Asia/Taipei");
    $today_month = date('n'); 
    $today_year = date("Y");

    if (!isset($_GET['month']) || empty($_GET['month'])) {
        $month = date('n');   //數字

        // 獲取當前的月份（英文）
        $currentEMonth = date("F");  

        // 獲取當前的月份（中文）
        $currentCMonth = mathMonthToChinese($month);
        echo "<!--"."目前中文月份(預設): " . $currentCMonth ."-->";
        echo "<!-- <br><br> -->";

    }else if($_GET['month'] > 12 || $_GET['month'] < 1){
        $month = date('n');   //數字

        // 獲取當前的月份（英文）
        $currentEMonth = date("F");  

        // 獲取當前的月份（中文）
        $currentCMonth = mathMonthToChinese($month);
    }else{
        $month = $_GET['month'];
        $currentCMonth = mathMonthToChinese($month);
        $currentEMonth = chineseMonthToEnglish($currentCMonth);
    }

    if (!isset($_GET['year']) || empty($_GET['year'])) {
        $year = date('Y');   //數字
    }else if($_GET['year'] < '1900' || $_GET['year'] > 2050){
        $year = date('Y'); 
    }else{
        $year = $_GET['year'];
    }

    $firstDay = strtotime(date(date("$year-$month-1")));
    $firstWeekStartDay = date("w",$firstDay);  //第一天是星期幾
    ?>


    <?php 
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
    
    $monthCompare = monthCompare($month, $year);

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
            $year_color = 'year-color1';
            $month_color = 'month-color1';
            $cz_color = 'cz-color1';
            $time_color = 'time-color1';
            $mark = 'mark1';
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
            $year_color = 'year-color2';
            $month_color = 'month-color2';
            $cz_color = 'cz-color2';
            $time_color = 'time-color2';
            $mark = 'mark2';
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
    

    $days = date("t",$firstDay);
    $lastDay = strtotime(date("Y-$month-$days"));
    $today = date("d");
    $currentDateTime = date("H:i:s"); // 24小時制格式（時:分:秒）

    $birthday = '1985-11-22';
    /* 生日處理判斷 */
    $replace=mb_substr($birthday,0,4);
    $replaceTo=str_replace($replace,date("Y"),$birthday);
    $spDate=strtotime($replaceTo); //生日時間戳

    $total_week = ceil(($days + ($firstWeekStartDay))/7) ;  // 當月總天數+空白天數/7 取無條件進入
    ?>

    <?php 
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
    ?>

    <style>
        body {
            background-image: url('./images/<?= $bg_img ?>');
            background-position: <?=$bg_position ?>;
            background-repeat: <?=$bg_repeat ?>;
            background-size: <?=$bg_size ?>;
        }
        .box-container {
            transition: opacity 2s ease-in; /* 2s 可以根據需要調整 */
            opacity: 0; /* 初始透明度為 0 */
        }
        .box-container.show {
            opacity: 1;
        }
    </style>
</head>

<body class="">
<!-- 請在這裹撰寫你的萬年曆程式碼 -->
    <div class="language_box <?= $lan_box; ?>">
        <div class="radio">
            <label><span class="round button"><input type="radio" name="language" value="en">en </span></label>
            <label><span class="round button"><input type="radio" name="language" value="ch">ch </span></label>
        </div>
    </div>

    <div class="select-date <?= $select_box; ?>">

        <select onchange="get_year_val()" name="" id="year" class="select <?=$year_select?>">
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

    <div class="pre_year_btn <?= $select_box2; ?>"><a href="index.php?year=<?= $go_pre_year ?>&month=<?= $month ?>&type=<?= $type ?>" title="上一年">‹</a></div>
    <div class="pre_month_btn <?= $select_box2; ?>"><a href="index.php?year=<?= $pre_year ?>&month=<?= $pre ?>&type=<?= $type ?>" title="上一個月">«</a></div>

    <?php 

    $days=[];
    for($i=0;$i<42;$i++){   //這個循環用於生成 42 個日期，這將用於填充一個月的行事曆
        $diff=$i-$firstWeekStartDay;  //計算了當前循環的日期與該月份的第一天之間的差距
        $days[]=date("Y-m-d",strtotime("$diff days",$firstDay));  //根據差距 $diff 將日期加到 $firstDay 上
    }

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

    // 宣告國定假日的關聯數組 //無指定年
    $holidays = [
        '01-01' => '元旦',
        // '02-08' => '春節',  //農曆正月初一至初三
        // '02-09' => '春節',  //農曆正月初一至初三
        // '02-10' => '春節',  //農曆正月初一至初三

        '02-28' => '和平紀念日',
        '04-04' => '兒童節',
        '04-05' => '清明節',
        '05-01' => '勞動節',
        // '06-10' => '端午節', //‍端午節：農曆五月初五
        // '09-17' => '中秋節', //‍中秋節：農曆八月十五
        '10-10' => '國慶日',

        // '02-03' => 'TEST',
        // '01-31' => 'TEST2',
        // '01-28' => 'TEST3',
        // '12-31' => 'TEST3',
        // 添加更多國定假日...
    ];

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

    if ($type == 'en') {
        echo "<div class='main-mark {$mark}'>";
        echo "<div class='main-mark-year {$year_color}'>$year <span class='chinese_zodiac {$cz_color}'><img class='lazy' src='./images/chinese-zodiac/{$zodiac}.png' alt=''></span></div>";
        echo "<div class='main-mark-month {$month_color}'>$currentEMonth</div>";
        echo "<div class='main-mark-time {$time_color}' id='current-time'>$currentDateTime</div>";
        echo "</div>";

        echo "<div class='block-table box-container {$table}'>";
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
        echo "<div class='main-mark-time {$time_color}' id='current-time'>$currentDateTime</div>";
        echo "</div>";

        echo "<div class='block-table box-container {$table}'>";
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

            $pre_month=$month-1;
            $next_month=$month+1;

            /***********************/
            $c_day=explode("-",$day)[2];  //將日期 $day 通過 - 符號拆分為數組，然後取出數組的第三個元素，即日期的天數部分
            $m_day=explode("-",$day)[1].'-'.explode("-",$day)[2];

            $the_year=$c_day=explode("-",$day)[0]; 
            $the_month=$c_day=explode("-",$day)[1]; 
            $the_day=$c_day=explode("-",$day)[2]; 

            // 農曆宣告
            $lunar = new Lunar();
            $l_day = $lunar->convertSolarToLunar($the_year,$the_month,$the_day);
            $lunar_day = $l_day[1].'-'.$l_day[2];
            if($lunar_day == '正月-初一' || $lunar_day == '正月-初二' || $lunar_day == '正月-初三' || $lunar_day == '正月-初四' || $lunar_day == '正月-初五') {
                $weekday = 'weekday';
                $p_holiday = 'public_holiday';
                $lunar_date = '春節';
            }else if($lunar_day == '五月-初五') {
                $weekday = 'weekday';
                $p_holiday = 'public_holiday';
                $lunar_date = '端午節';
            }else if($lunar_day == '八月-十五') {
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

            if (array_key_exists($m_day, $holidays)) {  // "指定日期是國定假日";  //顯示每一年國定假日
                    if($c_month != $month){
                            echo "<div class='item not-month'>";
                            echo "<div class='date'>$c_day</div>";
                            echo "<div class='public_holiday {$p_holiday}'>$holidays[$m_day] </div>";  //$holidays['2024-01-01']
                            echo "</div>";
                    }else{
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
                if($c_month != $month){
                        echo "<div class='item not-month'>";
                        echo "<div class='date'>$c_day</div>";
                        echo "<div class='date {$l_date_color}'>";
                        echo $lunar_date;
                        echo "</div>";
                        echo "</div>";
                }else{
                    if($c_day == $today && $month == $today_month && $year == $today_year){
                        echo "<div class='item {$weekday}'>";
                        echo "<div class='date {$date_color} date-today'>$c_day</div>";
                        echo "<div class='date {$l_date_color} {$p_holiday}'>";
                        echo $lunar_date;
                        echo "</div>";
                        echo "</div>";
                    }else{
                        $w=date("w",strtotime($day));
                        if($w==0){  //如果星期幾是 0（星期日）
                                echo "<div class='item holiday holiday-sunday {$weekday}'>";
                                echo "<div class='date'>$c_day</div>";
                                echo "<div class='date {$l_date_color} {$p_holiday}'>";
                                echo $lunar_date;
                                echo "</div>";
                                echo "</div>";
                        }else if($w==6){  //如果星期幾是 6（星期六）
                                echo "<div class='item holiday holiday-saturday {$weekday}'>";
                                echo "<div class='date'>$c_day</div>";
                                echo "<div class='date {$l_date_color} {$p_holiday}'>";
                                echo $lunar_date;
                                echo "</div>";
                                echo "</div>";
                        }else{  //如果是工作日（即星期一到星期五）
                                echo "<div class='item {$weekday}'>";
                                echo "<div class='date {$date_color}'>$c_day</div>";
                                echo "<div class='date {$l_date_color} {$p_holiday}'>";
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
    ?>
    
    <div class="next_month_btn <?= $select_box2; ?>"><a href="index.php?year=<?= $next_year ?>&month=<?= $next ?>&type=<?= $type ?>" title="下一個月">»</a></div>
    <div class="next_year_btn <?= $select_box2; ?>"><a href="index.php?year=<?= $go_next_year ?>&month=<?= $month ?>&type=<?= $type ?>" title="下一年">›</a></div>

</div>
<!-- 請在這裹撰寫你的萬年曆程式碼 -->
  
</body>
</html>