/*
    ErrorCode List (While Submitting Paper)
    1:  ajax error
    2:  json decode error
    3:  backend-defined error
*/

var focus_cnt = 0;
var ans = new Array(pcnt), timeleft = $('#timer').val();
var text = $.ajax({url:"test.txt",async:false}).responseText.split('|');
for(var i = 0; i < pcnt; i++) ans[i] = -1;

function tostr(x)
{
    return (x<10?'0':'') + x.toString();
}

var noticed = false, submitted = false;

function dectime()
{
    if(submitted)   return;
    timeleft--;
    select_check();
    $('.navbar_time').text(tostr(parseInt(timeleft/60)) + ':' + tostr(timeleft%60));
    switch(true)
    {
        //2 minutes
        case timeleft <= 120:
            $('.navbar_time').css('color', 'red');
            if(!noticed)
            {
                noticed = true;
                layer.alert(text[0], {icon: 7});
            }
            break;
        //5 minutes
        case timeleft <= 300:
            $('.navbar_time').css('color', 'orange');
            break;

        case timeleft <= 900:
            $('.navbar_time').css('color', 'blue');
            break;
    }
    if(timeleft > 0)
        setTimeout(function() {dectime() }, 1000);
    else{
        layer.msg(text[2], {time : 1300});
        real_submit();
    }
}

function encode_answer()
{
    var res = "";
    for(var i = 0; i < pcnt; i++)
        res += (i==0?'':'#') + ans[i].toString();
    return res;
}

$('#submit_button').click(function ()
{
    var done = true, str, icon;
    for (var i = 0; i < pcnt; i++)
        if (ans[i] == -1)
            done = false;
    if (!done){
        str = '您仍有题目未作答，确认交卷？';
        icon = 7;
    }
    else{
        str = '是否确认交卷？';
        icon = 3;
    }
    layer.confirm(str, {
        icon: icon,
        title: '交卷',
        yes: function (index) {
            layer.close(index);
            real_submit();
        }
    });
});

function show_error(msg, errcode)
{
    layer.open({
        title : '交卷错误',
        content : msg + '<br/>errcode=' + errcode.toString(),
        icon : 2
    });
}

function real_submit()
{
    $.ajax({
        url : "control/judger.php",
        type : "POST",
        data : {
            answer : encode_answer()
        },
        cache : false,
        success: function(msg) {
            try{
                obj = $.parseJSON(msg);
            } catch(e){
                show_error('服务器出现错误，请稍后再尝试交卷!', 2);
                return;
            }
            if(obj.success) {
                var $scoreboard = $('#score');
                $scoreboard.html(obj.score);
                if(obj.score < 60)
                    $scoreboard.css('color', 'red');
                else
                    $scoreboard.css('color', 'green');
                layer.open({
                    type : 1,
                    title: '提示',
                    content: $('#result'),
                    // scrollbar: false,
                    clostBtn : false,
                    icon: 1,
                    btn: ['返回首页', '查看试题'],
                    yes: function () {
                        window.location = 'index.php';
                    },
                    btn2: function() {
                        window.location = 'review.php';
                    }
                });
                submitted = true;
                $(window).unbind();
                $this = $("#submit_button");
                $this.prop("disabled", true);
                $('#back_button').show();
            }else{
                show_error(obj.err_message, 3);
            }
        },
        error: function () {
            show_error('服务器出现错误，请稍后再尝试交卷!', 1);
        }
    });
}

var $pdiv = $('#problems'), $body = $('body');

//检测禁用文本选择的相关css是否被修改
function select_check()
{
    if($body.css('-webkit-user-select') != 'none' && $body.css('-webkit-user-select') != undefined
        || $body.css('user-select') != 'none' ||
        $body.css('-moz-user-select') != 'none' && $body.css('-moz-user-select') != undefined)
    {
        $body.css('-webkit-user-select', 'none');
        $body.css('user-select', 'none');
        $body.css('-moz-user-select', 'none');
        // layer.alert('请诚信答题，停止修改css', {
        //     title : ':)',
        //     icon:6
        // });
    }
}

//监听焦点丢失事件

$(window).blur(function() {
    focus_cnt++;
    layer.alert(text[1] + focus_cnt.toString(),{
        icon : 7
    })
});
$(window).bind('beforeunload',function(){
    return 1;
});
$pdiv.find('.list-group').find('a').click(function(){
    $this = $(this);
    var pid = $pdiv.find('.list-group').index($this.parent());
    var cid = $this.parent().find('a').index($this);
    if(ans[pid] != -1)
        $this.parent().find('a').eq(ans[pid]).removeClass('active');
    $this.addClass('active');
    ans[pid] = cid;
});

layer.msg('答题开始', {icon: 1, time : 1300});
dectime();