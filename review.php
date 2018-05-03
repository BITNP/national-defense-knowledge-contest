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
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/clean-blog.css" rel="stylesheet">
    <style>
        .correct{
            background-color: #8eff84;
        }
        .wrong{
            background-color: #ff7b7e;
        }
    </style>
</head>

<body>

<?php
//if(!isset($_SESSION['online']))
//    die("<script>window.location = 'signup.php'</script>");

$userid = $_SESSION['id'];
//$userid = 1;

if($_SESSION['status'] != 2){
    die("<script>window.location='index.php'</script>");
}

$name = $_SESSION['name'];
//$name = '哈哈';

$end_time = $_SESSION['end_time'];
//$end_time = date("Y-m-d H:i:s", time()+10000);

$col = $dbh->query("SELECT * FROM users WHERE id = $userid")->fetch();
$problems = $col['problems'];
$pids = explode(',', $problems);
$arr = [];
foreach ($pids as $key => $val){
    $p = $dbh->query("SELECT * FROM problems WHERE id = $val")->fetch();
    $p['choices'] = explode("||", htmlspecialchars($p['choices']));
    array_push($arr, $p);
}
if($col['score'] == NULL){
    $score = '未交卷';
    $col['myans'] = [];
    foreach ($pids as $v){
        array_push($col['myans'], -1);
    }
    $col['myans'] = implode('#', $col['myans']);
}else{
    $score = $col['score'];
}

$page_title = "查看答卷 - " . $name;
include 'header.php';
?>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>答题时间： <B><?=$end_time?></B> ，成绩： <B><?=$score?></B></p>
            <a href="certificate/" target="_blank">下载合格证书</a>
            <hr/>

            <div id="main">
            <?php
                foreach ($arr as $index => $item) {
                    echo("<p>" . ($index + 1) . '. ' . htmlspecialchars($item['description']). "</p>");
                    if ($item['type'] == 0) {
                        ?>
                        <div class="list-group">
                            <a href="javascript:void(0)" class="list-group-item list-group-item-action"><i
                                        class="fa fa-check-circle-o" aria-hidden="true"></i> 正确</a>
                            <a href="javascript:void(0)" class="list-group-item list-group-item-action"><i
                                        class="fa fa-times-circle-o" aria-hidden="true"></i> 错误</a>
                        </div>
                        <?php
                    } else {
                        ?>
                        <div class="list-group">
                            <?php
                                foreach ($item['choices'] as $index2 => $ch) {
                                    ?>
                                    <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                        <?=chr(ord('A')+$index2). ". " . $ch ?>
                                    </a>
                                    <?php
                                }
                            ?>
                        </div>
                        <?php
                    }?>
                    <p></p>
                    <br/>
                <?php
                }
            ?>
            </div>
        </div>
    </div>
</div>

<hr>

<?php
require 'footer.html'
?>
<script>
    var datakey = '<?=$col['keyans']?>';
    var datamy = '<?=$col['myans']?>';
    var keyans = datakey.split(',');
    var myans = datamy.split('#');

    var $pdiv = $('#main');

    for(i = 0; i < keyans.length; i++){
        if(myans[i] != "-1"){
            $pdiv.find('div').eq(i).find('a').eq(myans[i]).addClass('wrong');
        }else{
            $pdiv.find('p').eq(i*2+1).html('<B>本题您未作答</B>').css('color', 'red');
        }
        $pdiv.find('div').eq(i).find('a').eq(keyans[i]).removeClass('wrong').addClass('correct');
        if(myans[i] != keyans[i]){
            $pdiv.find('p').eq(i*2).css('color', '#CC0000').css('font-weight', 'bold');
        }

    }
</script>
</body>

</html>
