<?php
require_once 'auth.php';
?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>开始答题 - 军旅知识竞赛</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/clean-blog.css" rel="stylesheet">

</head>

<body>
<?php
$page_title = '答题';
require 'header.php';
require 'config.php';
$tried = PaperManager::get_paper_count($_SESSION['id']);
?>

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
            }else if($_SESSION['status'] == 2){
                if(time() < $END_TIME && $tried < $CHANCE){
                    ?>
                    <p>军旅知识竞赛，分为线上网络资格赛和线下现场竞赛，线上资格赛连队参与率将会决定连队是否有资格参与线下现场竞赛。资格赛共10道题，每道题10分，由系统随机抽取。每人有5次答题机会，每次答题时长为3分钟，中途若有退出3次，系统将直接交卷。希望同学们掌握好答题时间，并做好充分的答题准备，预祝同学们考个好成绩！</p>
                    <p>本活动由学工处武装部北京理工大学国防教育协会主办并承办，感谢北京理工大学网络开拓者协会的技术配合。</p>
                    <p>每人共有 5 次答题机会，您已经完成 <B><?=$tried?></B> 次答题。<a href="info.php">查看历史</a></p>
                    <p>若您已做好准备，点击下面的按钮进入答题系统。</p>
                    <a href="paper.php" class="btn btn-primary"><i class="fa fa-check" aria-hidden="true"></i> 进入答题</a>
                <?php   } else if($tried >= $CHANCE){ ?>
                    <p>您已经用完五次答题机会，感谢您的参与。</p>
                    <a href="index.php" class="btn btn-primary">返回首页</a>
                <?php   } else { ?>
                    <p>本次活动已经结束，感谢您的参与。</p>
                    <a href="index.php" class="btn btn-primary">返回首页</a>
                <?php   }
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
