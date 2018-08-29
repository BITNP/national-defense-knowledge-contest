<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="zh-cmn-Hans">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>首页 - 军旅知识竞赛</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/clean-blog.css" rel="stylesheet">

</head>

<body>

<?php
    $page_title = '首页';
    require 'header.php';
?>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <h2 class="section-heading">竞赛简介</h2>

            <p>军旅知识竞赛，分为线上网络资格赛和线下现场竞赛，线上资格赛连队参与率将会决定连队是否有资格参与线上部分军旅知识竞赛。资格赛共10道题，每道题10分，由系统随机抽取。每人有5次答题机会，每次答题时长为3分钟，中途若有退出3次以上，系统将直接交卷。希望同学们掌握好答题时间，并做好充分的答题准备，预祝同学们考个好成绩！</p>

            <p>本活动由学工处武装部北京理工大学国防教育协会主办并承办，感谢北京理工大学网络开拓者协会的技术配合。</p>

            <p>每人有5次答题机会，每次答题时间3分钟，答题期间设备不允许进行答题以外其他操作，否则答题无效。</p>

            <hr/>
            <!-- Pager -->
            <div class="clearfix">
                <a class="btn btn-primary float-right" href="ready.php">现在答题 &rarr;</a>
            </div>
        </div>
    </div>
</div>

<br/>
<?php
require 'footer.html'
?>

</body>

</html>
