<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>开始答题 - 国防知识竞赛</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="css/clean-blog.css" rel="stylesheet">

</head>

<body>
<?php
require_once 'auth.php';
$page_title = '答题';
require 'header.php';
?>
<!---->
<!--<div id="login_model" style="display: none; padding-left: 15px; padding-right: 15px;">-->
<!--    <p>尚未验证身份或验证已经超时，请重新验证。</p>-->
<!---->
<!--    <div class="input-group mb-3">-->
<!--        <div class="input-group-prepend">-->
<!--            <span class="input-group-text" id="basic-addon1">学号</span>-->
<!--        </div>-->
<!--        <input type="text" class="form-control" id="stuNum" aria-label="Username" aria-describedby="basic-addon1">-->
<!--    </div>-->
<!---->
<!--    <div class="input-group mb-3">-->
<!--        <div class="input-group-prepend">-->
<!--            <span class="input-group-text" id="basic-addon1">姓名</span>-->
<!--        </div>-->
<!--        <input type="text" class="form-control" id="Name" aria-label="Username" aria-describedby="basic-addon1">-->
<!--    </div>-->
<!---->
<!--</div>-->

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h2 class="section-heading">开始答题</h2>
            <p>当前用户：<?=$_SESSION['name']?></p>

            <?php
                if($_SESSION['status'] == 1){
            ?>
                    <p><B>答题正在进行中</B>，<?=$_SESSION['end_time']?> 结束。</p>
                    <a href="paper.php" class="btn btn-primary">继续答题</a>
            <?php
                }else if($_SESSION['status'] == 0){
            ?>

                    <p>试题共30道，系统随机抽取，满分100分。最终成绩达到或超过60分即可获得一份可下载的线上证书。</p>

                    <p>答题限时15分钟，每人只有一次答题机会，中途如有退出，<strong>系统将不会保存当前答案</strong>，但可重新打开网页作答。希望同学们掌握好答题时间，并做好充分的答题准备，预祝同学们考个好成绩！</p>

                    <p>若您已做好准备，点击下面的按钮进入答题系统。</p>
                    <a href="paper.php" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> 进入答题</a>
            <?php
                }else{
            ?>
                    <p>您已经完成答题，每人仅有一次答题机会。</p>
                    <p>答题时间： <?=$_SESSION['end_time']?></p>
                    <a href="paper.php" class="btn btn-primary">查看答卷</a>
                    <a href="certificate/" target="_blank" class="btn btn-primary">下载合格证书</a>
            <?php
                }
            ?>
        </div>
    </div>
</div>
<hr>

<?php
require 'footer.html'
?>
<!--<script src="js/login.js"></script>-->
<?php
//if(!isset($_SESSION['online']))
//    echo "<script>call_login()</script>";
?>
</body>

</html>
