<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--标题-->
    
    <title>管理中心 - 新增属性</title>

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
    
    <span class="action-span"><a href="<?php echo U('lst');?>">返回</a></span>
    <span id="search_id"> - 添加属性</span>


    <div style="clear:both;"></div>
</h1>

<!-- 内容主题 -->

    <div class="main-div">
        <form method="POST" action="/Admin/Attr/add" enctype="multipart/form-data">
            所在的类型的id：
            <p><input type="text" name="type_id" value="" /></p>
            属性名：
            <p><input type="text" name="attr_name" value="" /></p>
            属性的类型0：唯一 1：可选：
            <p><input type="text" name="type_type" value="" /></p>
            属性的可选值，多个可选值用，隔开：
            <p><input type="text" name="attr_option_values" value="" /></p>
            <p><input type="submit" class="btn btn-primary" value="确定" /></p>
        </form>
    </div>


<div id="footer">版权所有，侵权必究@2017</div>
</body>
</html>