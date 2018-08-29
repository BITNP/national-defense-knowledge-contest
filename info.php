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

    <title>个人中心 - 军旅知识竞赛</title>

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
$score = $dbh->query("SELECT score FROM users WHERE id = " . $_SESSION['id'])->fetch()[0];
$tried = PaperManager::get_paper_count($_SESSION['id']);
$list = PaperManager::get_paper_list($_SESSION['id']);
?>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h2 class="section-heading">个人中心</h2>
            <p>当前用户：<?=$_SESSION['name']?></p>
            <p>试题满分100分，最终成绩达到或超过 60 分即可获得一份可下载的线上证书。</p>
            <?php if($tried > 0) { ?>
                <p>最高成绩：<B <?=$score>=60 ? "style='color: #2ca02c;'": ""?>><?=$score?></B> </p>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">完成时间</th>
                        <th scope="col">得分</th>
                        <th scope="col">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $rank=>$rec){ ?><tr>
                        <th scope="row"><?=$rank+1?></th>
                        <td><?=date("m-d H:i:s", strtotime($rec['end_time']))?></td>
                        <td <?=$rec['score'] >= 60 ? "style=\"color: #2ca02c;\"" : ""?>><B><?=isset($rec['score'])?$rec['score']:"未交卷"?></B></td>
                        <td><a href="review.php?id=<?=$rec['id']?>" target="_blank"><i class="fa fa-search" aria-hidden="true"></i> <u>查看</u></a><td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            <?php }else{  ?>
                <p>最高成绩：<B>未答题</B></p>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">完成时间</th>
                        <th scope="col">得分</th>
                        <th scope="col">操作</th>
                    </tr>
                    </thead>
                    <tbody align="center">
                        <td colspan="4" style="color: gray">未答题</td>
                    </tbody>
                </table>
            <?php } ?>
            <a href="ready.php" class="btn btn-primary">前往答题</a>
<!--            <a href="certificate/" target="_blank" class="btn btn-primary">下载合格证书</a>-->
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
