<?php
class Log{
    public static function write($info){
        $log = fopen("log.txt", "a");
        fwrite($log, $info);
        fwrite($log, "\r\n" . date("Y-m-d H:i:s", time()) . "\r\n\r\n");
        fclose($log);
    }
}