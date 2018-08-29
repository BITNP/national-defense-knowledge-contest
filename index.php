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

            <p>北理国防知识竞赛，分为线上网络答题和线下现场竞赛，由学工处武装部北京理工大学国防教育协会主办并承办，这里特别感谢北京理工大学网络开拓者协会的技术配合。我们旨在让北理学子增长国防知识提高国防意识，让学校国防教育内容更加丰富，所以我们举办此次北理国防知识竞赛。</p>

            <p>共30道题，满分100分，60分及格，系统随机抽取。其中选择题（单项选择）20道，每道4分，选择题共80分；判断题10道，每道2分，判断题共20分。最终成绩达到或超过60分即可获得一份可下载的线上证书。</p>

            <p>答题限时15分钟，每人只有一次答题机会，中途如有退出，系统将不会保存当前答案，但可重新打开网页作答。希望同学们掌握好答题时间，并做好充分的答题准备，预祝同学们考个好成绩！</p>

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
