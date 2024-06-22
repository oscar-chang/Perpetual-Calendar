function get_year_val() {
    var year = document.getElementById('year').value;
    $('#year').data('year', year);
    var y = $('#year').data('year');

    var month = document.getElementById("month").value;
    $('#month').data('month', month);
    var m = $('#month').data('month');

    const urlParams = new URLSearchParams(window.location.search);
    var type = urlParams.get('type');
    var re_url = '?year=' + y + '&month=' + m + '&type=' + type;
    window.location.href = re_url;
}

function get_month_val() {
    var year = document.getElementById('year').value;
    $('#year').data('year', year);
    var y = $('#year').data('year');

    var month = document.getElementById("month").value;
    $('#month').data('month', month);
    var m = $('#month').data('month');

    const urlParams = new URLSearchParams(window.location.search);
    var type = urlParams.get('type');
    var re_url = '?year=' + y + '&month=' + m + '&type=' + type;
    window.location.href = re_url;
}

$(document).ready(function () {
    $('.round').click(function () {
        var type = '';
        var type = $('input[name="language"]:checked').val();

        if (type == 'en' || type == 'ch') {
            var re_url = '?year=' + year + '&month=' + month + '&type=' + type;
            window.location.href = re_url;
        } else {
            var type = 'en';
            var re_url = '?year=' + year + '&month=' + month + '&type=' + type;
            window.location.href = re_url;
        }
    });

    // 創建 URL 物件並解析 URL 字符串
    var url = new URL(window.location.href);

    // 獲取 URL 中的 searchParams
    var searchParams = url.searchParams;

    // 判斷是否存在 param2 參數
    if (searchParams.has("month") && searchParams.has("year")) {
        // 年月 參數沒少.
        var type = '';
        const urlParams = new URLSearchParams(window.location.search);
        var month = urlParams.get('month');
        var year = urlParams.get('year');
        var type = urlParams.get('type');
        if (type != 'en' || type != 'ch') {
            if (type == 'en') {
                $('input[name="language"][value="en"]').attr('checked', 'checked');
                $('input[name="language"][value="en"]').parents('.round').addClass('lan_hover');
            } else if (type == 'ch') {
                $('input[name="language"][value="ch"]').attr('checked', 'checked');
                $('input[name="language"][value="ch"]').parents('.round').addClass('lan_hover');
            } else {
                $('input[name="language"][value="en"]').attr('checked', 'checked');
                $('input[name="language"][value="en"]').parents('.round').addClass('lan_hover');
            }
        } else {
            var type = 'en';
        }

        // 定義一個函數來檢查年份是否在範圍內
        function isYearInRange(year) {
            // return yearArray.includes(year);
            return year >= 1900 && year <= 2050;
        }

        // 定義一個函數來檢查月份是否在範圍內
        function isMonthInRange(month) {
            return month >= 1 && month <= 12;
        }

        var type_tmp = '';
        var type_tmp = urlParams.get('type');
        // console.log(type_tmp);

        if (isMonthInRange(month) == true && isYearInRange(year) == true) {
            // console.log('年月 在設定值內');
            $('#month').val(month);
            $('#year').val(year);
            var type_tmp = urlParams.get('type');
            if (type_tmp == 'en' || type_tmp == 'ch') {

            } else {
                var type = 'en';
                var re_url = '?year=' + year + '&month=' + month + '&type=' + type;
                window.location.href = re_url;
            }
        } else {
            // console.log('年月 不在設定值內.');
            var d = new Date();
            var month = d.getMonth() + 1;  // 獲取當前月份
            var year = d.getFullYear();  // 獲取當前年份

            $('#month').val(month);
            $('#year').val(year);
            var type_tmp = urlParams.get('type');
            if (type_tmp == 'en' || type_tmp == 'ch') {
                var type = type_tmp;
            } else {
                var type = 'en';
            }
            var re_url = '?year=' + year + '&month=' + month + '&type=' + type;
            alert('年月 不在設定值內');
            window.location.href = re_url;
        }
    } else {
        // console.log('年月 參數有少');
        var d = new Date();
        var month = d.getMonth() + 1;
        var year = d.getFullYear();

        $('#month').val(month);
        $('#year').val(year);
        if (type_tmp == 'en' || type_tmp == 'ch') {
            var type = type_tmp;
        } else {
            var type = 'en';
        }
        var re_url = '?year=' + year + '&month=' + month + '&type=en';
        window.location.href = re_url;
    }
});

//使用 JavaScript 動態更新時間
function updateTime() {
    var now = new Date();
    var hours = now.getHours().toString().padStart(2, '0');
    var minutes = now.getMinutes().toString().padStart(2, '0');
    var seconds = now.getSeconds().toString().padStart(2, '0');
    var currentTime = hours + ":" + minutes + ":" + seconds;
    document.getElementById('current-time').textContent = currentTime;
    console.log("Updating time");
}

// 在整个页面加载完成后调用 updateTime 函数
window.onload = function () {
    updateTime();
    // 如果您希望定期更新时间，可以使用 setInterval
    setInterval(updateTime, 1000); // 每秒更新一次时间

    // 背景圖片在頁面加載時顯示
    // document.body.classList.add('show-background');
    document.querySelector('.box-container').classList.add('show');

    // 或者在按鈕點擊時顯示背景圖片
    // document.getElementById('showBackground').addEventListener('click', function () {
    //     document.body.classList.add('show-background');
    // });
};



