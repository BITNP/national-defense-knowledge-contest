<?php
/*
 * 接收post请求 -> 检查表单/session数据 -> 完成判题 储存数据
 * 表单数据：
 * $_POST['answer'] 编码后的答案
 *
 * Session数据：
 * $_SESSION['']
 *
 * 输出：
 * json object{
 *    "success" : true/false  // 是否成功
 *    "err_message" : //失败时的错误消息
 *    "score" : 分数
 * }
 */

require '../config.php';
require_once 'log.php';

if(!isset($_SERVER['HTTP_REFERER']) || !strrpos($_SERVER['HTTP_REFERER'], "paper.php")){
    die(json_encode([
        'success' => false,
        'err_message' => 'hhh'
    ]));
}

date_default_timezone_set("PRC");
session_start();

if(time() >= $END_TIME + 901){
    die(json_encode([
        'success' => false,
        'err_message' => '活动已经结束，感谢您的参与'
    ]));
}

if(!isset($_SESSION['status']) || $_SESSION['status'] != 1){
    die(json_encode([
        'success' => false,
        'err_message' => '权限校验失败，可能已经完成交卷，请尝试刷新页面！'
    ]));
}

$userid = $_SESSION['id'];

$dsn = "mysql:host=$db_host;dbname=$db_name";
try{
    $dbh = new PDO($dsn, $db_username, $db_password);
    $dbh->query("SET NAMES utf8");
    $res = $dbh->query("SELECT keyans FROM users WHERE id = $userid");
    if(!$res){
        throw new Exception("SQL Error 0x001, error message \r\n" . $dbh->errorInfo()[2]);
    }
    $keyans = $res->fetch()[0];
    $keys = explode(',', $keyans);
}catch (Exception $e){
    Log::write("judger.php\r\n" . $e->getMessage());
    die(json_encode([
        'success' => false,
        'err_message' => '数据库连接失败',
    ]));
}

if(strtotime($_SESSION['end_time']) < time()){
    $_SESSION['status'] = 2;
    $dbh->query("UPDATE users SET status = 2 WHERE id = $userid");
    $problems = $dbh->query("SELECT problems FROM users WHERE id = $userid")->fetch()[0];
    $end_time = $_SESSION['end_time'];
    $dbh->exec("INSERT INTO papers (userid, problems, keyans, end_time) VALUES($userid, '$problems', '$keyans', '$end_time')");
    die(json_encode([
        'success' => false,
        'err_message' => '答题已经截止'
    ]));
}

try{
    //data
    $raw = $_POST['answer'];
    $raw = explode('#', $raw);
    if(count($raw) !== count($keys))
        throw new Exception();
}catch (Exception $e){
    Log::write("security\r\n" . "invalid data from " . $_SESSION['name'] . ' stuID = ' . $_SESSION['stuID']);
    die(json_encode([
        'success' => false,
        'err_message' => '数据校验失败'
    ]));
}

$ans = $raw;
$score = 0;
foreach ($keys as $i => $key) {
    if($ans[$i] == $key){
        if($i <= $cnt_judge){
            $score += $score_judge;
        }else{
            $score += $score_choose;
        }
    }
}

$res = $dbh->query("SELECT problems,score FROM users where id = $userid")->fetch();
$problems = $res[0];
$mxscore = max($res[1], $score);
$myans = $_POST['answer'];
$end_time = date("Y-m-d H:i:s", time());

$SQL = "INSERT INTO papers (userid, problems, keyans, myans, score, end_time) VALUES($userid, '$problems', '$keyans', '$myans', $score, '$end_time')";
$dbh->exec($SQL);
//echo($SQL);


$dbh->query("UPDATE users SET score = $mxscore WHERE id = $userid");
$dbh->query("UPDATE users SET status = 2 WHERE id = $userid");
//$dbh->query("UPDATE users SET end_time = '" .  . "' WHERE id = $userid");
//$dbh->query("UPDATE users SET myans = '" . $_POST['answer'] . "' where id = $userid");
$_SESSION['status'] = 2;

echo json_encode([
    'success' => true, 'score' => $score
]);
?>