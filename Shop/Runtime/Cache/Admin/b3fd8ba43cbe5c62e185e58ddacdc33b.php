<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--标题-->
    
    <title>管理中心 - 新增管理员 </title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/bootstrap/js/jquery.min.js"></script>
    <!-- 其他样式 -->
    
</head>
<body>
<h1 style="font-size: 14px;">
    <span><a href="<?php echo U('Index/main');?>" style="color:#9cf;">管理中心</a></span>

    <!--具体操作-->
    
    <span class="action-span"><a href="<?php echo U('Admin/Admin/lst');?>">返回</a></span>
    <span id="search_id"> - 新增管理员</span>


    <div style="clear:both;"></div>
</h1>

<!-- 内容主题 -->

    <div class="main-div">
        <form method="POST" action="/Admin/Admin/add.html"  style="margin-left:5px;">
            <p>账号：<input type="text" name="username" /></p>
            <p>密码：<input type="password" size="25" name="password" /></p>
            是否启用 1：启用 0：禁用
            <input type="radio" name="is_use" value="1" checked="checked" />启用
            <input type="radio" name="is_use" value="0" />禁用
            <p><input type="submit" class="btn btn-primary" value="确定" /></p>
        </form>
    </div>


<div id="footer">版权所有，侵权必究@2017</div>
</body>
</html>