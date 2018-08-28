<?php
/**
 * Created by PhpStorm.
 * User: sdzczy
 * Date: 2018/8/24
 * Time: 13:12
 */

//require '../config.php';

class PaperManager{
    static function get_dbh(){
        global $db_host, $db_name, $db_username, $db_password;
        $dsn = "mysql:host=$db_host;dbname=$db_name";
        $dbh = new PDO($dsn, $db_username, $db_password);
        return $dbh;
    }

    static function generate_problems(){
        global $cnt_choose, $cnt_judge;

        $dbh = PaperManager::get_dbh();
        $dbh->query("SET NAMES utf8");
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
        return [$problems, $keyans];
    }

    static function get_paper_count($id){
        $dbh = PaperManager::get_dbh();
        return $dbh->query("SELECT count(*) FROM papers WHERE userid = $id")->fetch()[0];
    }

    static function get_paper_list($id){
        $dbh = PaperManager::get_dbh();
        $res = $dbh->query("SELECT * FROM papers WHERE userid = $id");
        $arr = [];
        while($one = $res->fetch()){
            array_push($arr, $one);
        }
        return $arr;
    }
}

?>