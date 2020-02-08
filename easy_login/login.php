<?php
header("Content-type:text/html;charset=utf-8");
$link = mysql_connect("localhost", "root", "jsjl246jsjl?");
if ($link) {
    $select = mysql_select_db("login", $link);
    if ($select) {
        if (isset($_POST["subl"])) {
            $name = $_POST["usernamel"];
            $password = $_POST["passwordl"];
            if ($name == "" || $password == "") //判断是否为空
            {
                echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.alert" . "(" . "\"" . "请填写正确的信息！" . "\"" . ")" . ";" . "</script>";
                echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.location=" . "\"" . "http://127.0.0.1:9096/project/login.html" . "\"" . "</script>";
                exit;
            }
            $str = "select password from register where username=" . "'" . "$name" . "'";
            mysql_query('SET NAMES UTF8');
            $result = mysql_query($str, $link);
            $pass = mysql_fetch_row($result);
            $pa = $pass[0];
            // 接收用户登录时提交的验证码
            session_start();
            // 获取用户提交的验证码
            $captcha = $_POST["captcha"];
            if (strtolower($_SESSION["captcha"]) == strtolower($captcha)) {
                echo"验证码正确";
                $_SESSION["captcha"] = "";
                if ($pa == $password) //判断密码与注册时密码是否一致
                {
                    echo "登录成功！";
                    echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.location=" . "\"" . "http://127.0.0.1:9096/project/success.html" . "\"" . "</script>";
                } else {
                    echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.alert" . "(" . "\"" . "登录失败！" . "\"" . ")" . ";" . "</script>";
                    echo "<script type=" . "\"" . "text/javascript" . "\"" . ">" . "window.location=" . "\"" . "http://127.0.0.1:9096/project/login.html" . "\"" . "</script>";
                }
            } else {
                echo "验证码提交不正确！";
            }
        }
    }
}
?>