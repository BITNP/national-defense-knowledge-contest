<?php
require_once '../auth.php';

if($_SESSION['status'] != 2 || $_SESSION['score'] < 60)
{
    if($_SESSION['status'] == 2){
        $msg = '您成绩未达到要求，未能获取证书！';
    }else{
        $msg = '您还未完成答题！';
    }
    die("
            <style>
                body{
                    font-family : 'Microsoft YaHei';
                }
            </style>
            <script src='../vendor/jquery/jquery.min.js'></script>
            <script src='../layer/layer.js'></script>
            <script>
                layer.alert('$msg', {
                    icon : 2,
                    title : 'Error' ,
                    scrollbar : false,
                    btn : ['关闭'],
                    closeBtn : false,
                    yes : function() {
                        window.close();
                    }
                });
            </script>
        ");
}

//指定图片路径
$src = 'model.jpg';
//获取图片信息
$info = getimagesize($src);
//获取图片扩展名
$type = image_type_to_extension($info[2],false);
//动态的把图片导入内存中
$fun = "imagecreatefrom{$type}";
$image = $fun($src);

//给图片添加文字
$font = 'msyh.ttc';//字体
$black = imagecolorallocate($image, 0x00, 0x00, 0x00);//字体颜色
imagefttext($image, 15, 0, 145, 317, $black, $font, $_SESSION['name']);
imagefttext($image, 13, 0, 352, 623, $black, $font, date('Y 年 n 月 j 日', strtotime($_SESSION['end_time'])));
//指定输入类型
header('Content-type:'.$info['mime']);
//动态的输出图片到浏览器中
$func = "image{$type}";
$func($image);
//销毁图片
imagedestroy($image);
?>