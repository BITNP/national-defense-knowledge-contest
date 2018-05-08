<?php require 'auth.php'; ?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>答题 - 国防知识竞赛</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/clean-blog.css" rel="stylesheet">
</head>

<body class='pb'>

<?php

function myrev($str)
{
    $ret = '';
    for($i = mb_strlen($str)-1; $i >= 0; $i--){
        $ret .= mb_substr($str, $i, 1);
    }
    return $ret;
}

function uglify($str, $ano, $using_a_tag = true)
{
    $str = htmlspecialchars($str);
    $len = mb_strlen($str); $len2 = mb_strlen($ano);
    $ret = "";
    $pos = [-1];
    for($i = 1; $i < $len-1; $i++) {
        if (rand(0, 2) == 1) {
            array_push($pos, $i);
        }
    }
    array_push($pos, $len-1);
    foreach($pos as $i => $p)
    {
        if($i==0)   continue;
        $ret .= mb_substr($str, $pos[$i-1]+1, $p-$pos[$i-1]);
        $randpos = rand(0, $len2-1);
        switch(rand(1, $using_a_tag ? 3 : 2))
        {
            case 1:
                $head = '<msk>';
                $tail = '</msk>';
                break;
            case 2:
                $head = "<span class='hid'>";
                $tail = "</span>";
                break;
            case 3:
                $head = "<a class='hid'>";
                $tail = "</a>";
                break;
        }
        $ret .= $head . myrev(mb_substr($ano, $randpos, min(rand(3, 5), $len2-$randpos))) . $tail;
    }
    return $ret;
}

$userid = $_SESSION['id'];

if($_SESSION['status'] == 0)
{
    if(time() >= $END_TIME) {
        die("<script>window.location='ready.php'</script>");
    }
    $_SESSION['status'] = 1;
    $timestamp = time()+15*60-1;
    $_SESSION['end_time'] = date("Y-m-d H:i:s", $timestamp);
    $dbh->query("UPDATE users SET status = 1 WHERE id = $userid");
    $dbh->query("UPDATE users SET end_time = '" . date("Y-m-d H:i:s", $timestamp+1) . "' where id = $userid");
}else if($_SESSION['status'] == 2){
    die("<script>window.location='review.php'</script>");
}

$name = $_SESSION['name'];
//$name = '哈哈';

$end_time = $_SESSION['end_time'];
//$end_time = date('Y-m-d H:i:s', time()+10000);

$problems = $dbh->query("SELECT problems FROM users WHERE id = $userid")->fetch()[0];
$pids = explode(',', $problems);
$arr = [];
foreach ($pids as $key => $val){
    $p = $dbh->query("SELECT * FROM problems WHERE id = $val")->fetch();
    $p['choices'] = explode("||", htmlspecialchars($p['choices']));
    array_push($arr, $p);
}

$paper_mode = true;
$page_title = "正在答题 - " . $name;
include 'header.php';
?>

<div id="result" style="display: none; padding-left: 15px; padding-right: 15px;">
    <p>交卷成功！</p>
    <p>您的得分是 <strong><span id="score">-99</span></strong>，成绩高于 60 分可到个人中心下载证书</p>
</div>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>你好，<?=$name?></p>
            <p>你将有 15 分钟时间答题，<?=$end_time?> 停止交卷，还剩 <span class="navbar_time"></span> </p>
            <hr/>

            <input style="display: none" id='timer' value=<?=strtotime($end_time)?> />

            <div id="problems">
            <?php
                foreach ($arr as $index => $item) {
                    echo("<p>" . ($index + 1) . '. ' . uglify($item['description'], $arr[max($index-1,0)]['description']) . "</p>");
                    if ($item['type'] == 0) {
                        ?>
                        <div class="list-group">
                            <a href="javascript:void(0)" class="list-group-item list-group-item-action"><i
                                        class="fa fa-check-circle-o" aria-hidden="true"></i> 正确</a>
                            <a href="javascript:void(0)" class="list-group-item list-group-item-action"><i
                                        class="fa fa-times-circle-o" aria-hidden="true"></i> 错误</a>
                        </div>
                        <br/>
                        <?php
                    } else {
                        ?>
                        <div class="list-group">
                            <?php
                                foreach ($item['choices'] as $index2 => $ch) {
                                    ?>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                        <?=chr(ord('A')+$index2). ". " . uglify($ch, $item['description'], false) ?>
                                    </a>
                                    <?php
                                }
                            ?>
                        </div>
                        <br/>
                        <?php
                    }
                }
            ?>
            </div>
            <button class="btn btn-primary float-lg-right" id="submit_button">交卷</button>
            <a class="btn btn-success" id="back_button" href="index.php" style="display: none;">返回首页</a>
        </div>
    </div>
</div>

<hr>

<?php
require 'footer.html'
?>
<script>
    var pcnt = <?=$cnt_judge+$cnt_choose?>;
</script>
<script src="js/paper.min.js"></script>

</body>

</html>
