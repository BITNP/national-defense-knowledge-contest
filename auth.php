<?php
date_default_timezone_set("PRC");
require_once 'CAS/CAS.php';
require_once 'config.php';
require_once 'control/log.php';

phpCAS::setDebug();
phpCAS::setVerbose(true);
phpCAS::client(CAS_VERSION_2_0, $cas_host, $cas_port, $cas_uri);
phpCAS::setNoCasServerValidation();
phpCAS::forceAuthentication();
if (isset($_REQUEST['logout'])) {
    session_destroy();
    phpCAS::logout();
    die();
}

$dsn = "mysql:host=$db_host;dbname=$db_name";
$authres = [];
try{
    $dbh = new PDO($dsn, $db_username, $db_password);
    $dbh->query("SET NAMES utf8");
    $CASid = phpCAS::getUser();
    $res = $dbh->query("SELECT * FROM users WHERE casid = '$CASid'");
    if(!$res){
        throw new Exception("SQL Error 0x001, error message \r\n" . $dbh->errorInfo()[2]);
    }
    if(!$res->fetch())
    {
        //new user
        //random select problems
        $p1 = $dbh->query("SELECT * FROM problems WHERE type = 1 ORDER by rand() limit $cnt_choose");
        $problems = [];
        $keyans = [];
        foreach ($p1 as $row){
            array_push($problems, $row['id']);
            array_push($keyans, $row['answer']);
        }
        $p1 = $dbh->query("SELECT * FROM problems WHERE type = 0 ORDER by rand() limit $cnt_judge");
        foreach ($p1 as $row)
        {
            array_push($problems, $row['id']);
            array_push($keyans, $row['answer']);
        }
        $problems = implode(',', $problems);
        $keyans = implode(',', $keyans);

        $SQL = "INSERT INTO users(casid, name, stuNum, status, problems, keyans) VALUES('$CASid', '$CASid', '$CASid', 0, '$problems', '$keyans')";

        $dbh->exec($SQL);
    }

    $res = $dbh->query("SELECT * FROM users WHERE casid = '$CASid'");
    if(!$res){
        throw new Exception("SQL Error 0x002, error message \r\n" . $dbh->errorInfo()[2]);
    }
    $data = $res->fetch();
    $_SESSION['id'] = $data['id'];
    $_SESSION['name'] = $data['name'];
    $_SESSION['stuID'] = $CASid;
    $_SESSION['status'] = $data['status'];
    if($data['status'] == 2){
        $_SESSION['score'] = $data['score'];
    }
    $_SESSION['end_time'] = $data['end_time'];
}catch (Exception $e){
    Log::write("auth.php\r\n" . $e->getMessage());
    die("
            <script src='vendor/jquery/jquery.min.js'></script>
            <script src='layer/layer.js'></script>
            <script>
                layer.alert('连接数据库出现错误，请稍后再尝试访问', {
                    icon : 2,
                    title : 'Error' ,
                    scrollbar : false,
                    btn : ['返回首页'],
                    closeBtn : false,
                    yes : function() {
                        window.location = 'index.php';
                    }
                });
            </script>
        ");
}
?>
