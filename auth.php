<?php
require_once 'CAS/CAS.php';
require_once 'config.php';
require_once 'control/log.php';
require_once 'control/PaperManager.php';

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
//    **************************
//    var_dump(phpCAS::getAttributes());
//    **************************
    $res = $dbh->query("SELECT * FROM users WHERE casid = '$CASid'");
    if(!$res){
        throw new Exception("SQL Error 0x001, error message \r\n" . $dbh->errorInfo()[2]);
    }
    if(!$res->fetch())
    {
        //new user
        //random select problems
        $res = PaperManager::generate_problems();
        $problems = $res[0];
        $keyans = $res[1];

        $school = phpCAS::getAttribute('eduPersonOrgDN');
        $cname = phpCAS::getAttribute('cn');
        $stuNum = phpCAS::getAttribute('uid');

        $SQL = "INSERT INTO users(casid, name, stuNum, school, status, problems, keyans) VALUES('$CASid', '$cname', '$stuNum', '$school', 2, '$problems', '$keyans')";

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
