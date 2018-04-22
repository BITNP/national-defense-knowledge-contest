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

    <title>首页 - 国防知识竞赛</title>

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
    $page_title = '首页';
    require 'header.php';
?>

<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-preview">
                <a href="post.php">
                    <h2 class="post-title">
                        竞赛规则
                    </h2>
                    <h3 class="post-subtitle">
                        此处显示摘要或副标题
                    </h3>
                </a>
                <p class="post-meta">Posted
                    on September 24, 2018</p>
            </div>
            <hr>
            <div class="post-preview">
                <a href="javascript:void(0)">
                    <h2 class="post-title">
                        报名通知
                    </h2>
                </a>
                <p class="post-meta">Posted
                    on September 18, 2018</p>
            </div>
            <hr>
            <div class="post-preview">
                <a href="javascript:void(0)">
                    <h2 class="post-title">
                        Science has not yet mastered prophecy
                    </h2>
                    <h3 class="post-subtitle">
                        We predict too much for the next year and yet far too little for the next ten.
                    </h3>
                </a>
                <p class="post-meta">Posted by
                    <a href="#">Start Bootstrap</a>
                    on August 24, 2018</p>
            </div>
            <hr>
            <div class="post-preview">
                <a href="javascript:void(0)">
                    <h2 class="post-title">
                        Failure is not an option
                    </h2>
                    <h3 class="post-subtitle">
                        Many say exploration is part of our destiny, but it’s actually our duty to future generations.
                    </h3>
                </a>
                <p class="post-meta">Posted by
                    <a href="#">Start Bootstrap</a>
                    on July 8, 2018</p>
            </div>
            <hr>
            <!-- Pager -->
            <div class="clearfix">
                <a class="btn btn-primary float-right" href="ready.php">现在答题 &rarr;</a>
            </div>
        </div>
    </div>
</div>

<hr>
<?php
require 'footer.html'
?>

</body>

</html>
