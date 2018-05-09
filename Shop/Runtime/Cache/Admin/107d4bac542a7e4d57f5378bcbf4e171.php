<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--标题-->
    
    <title>管理中心 - 编辑会员级别</title>

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
    <span id="search_id"> - 编辑会员级别</span>


    <div style="clear:both;"></div>
</h1>

<!-- 内容主题 -->

    <div class="main-div">
        <form method="POST" style="margin:5px;" action="/Admin/MemberLevel/edit/id/1.html">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <p>级别名称:
                <input type="text" name="level_name" value="<?php echo $data['level_name']; ?>" />
            </p>
            <p>积分下限:
                <input type="text" name="bottom_num" value="<?php echo $data['bottom_num']; ?>" />
            </p>
            <p>积分上限:
                <input type="text" name="top_num" value="<?php echo $data['top_num']; ?>" />
            </p>
            <p>折扣率，90位9折:
                <input type="text" name="rate" value="<?php echo $data['rate']; ?>" />
            </p>
            <p><input type="submit" class="btn btn-primary" value="确定" /></p>
        </form>
    </div>


<div id="footer">版权所有，侵权必究@2017</div>
</body>
</html>