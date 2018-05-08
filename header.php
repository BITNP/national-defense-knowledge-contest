<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="javascript:void(0)"><?=$page_title?></a>
        <?php
        if(!isset($paper_mode))
        {
            ?>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">主页</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="ready.php">答题</a>
                    </li>
                    <?php if(isset($_SESSION['status'])){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="auth.php?logout=">退出登录</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <?php
        }else{
            ?>
            <div class="nav-time">
                剩余时间 : <span class="navbar_time"></span>
            </div>
        <?php } ?>
    </div>
</nav>

<!-- Page Header -->
<header class="masthead" style="background-image: url('img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <span class="subheading">北京理工大学第一届</span>
                    <h1>国防知识竞赛</h1>
                    <span class="subheading">2018 年 5 月</span>
                </div>
            </div>
        </div>
    </div>
</header>