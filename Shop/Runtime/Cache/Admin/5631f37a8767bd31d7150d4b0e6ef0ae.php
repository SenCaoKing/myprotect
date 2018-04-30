<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--标题-->
    
    <title>管理中心 - 编辑权限</title>

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
    
    <span id="search_id"> - 编辑权限</span>


    <div style="clear:both;"></div>
</h1>

<!-- 内容主题 -->

    <div class="main-div">
        <form name="main_form" method="POST" action="/Admin/Auth/edit.html" enctype="multipart/form-data">
            <p>上级权限：<select name="parent_id">
                    <option value="0">顶级权限</option>
                    <?php foreach($parenpata as $k => $v): ?>
                        <option value="<?php echo $v['id']; ?>"><?php echo str_repeat('-', 8*$v['auth_level'].$v['auth_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </p>
            <p class="label">权限名称：<input type="text" name="auth_name" value="<?php echo $data['auth_name']; ?>" /></p>
            <p class="label">模块名称：<input type="text" name="module_name" value="<?php echo $data['module_name']; ?>" /></p>
            <p class="label">控制器名称：<input type="text" name="controller_name" value="<?php echo $data['controller_name']; ?>" /></p>
            <p class="label">方法名称：<input type="text" name="action_name" value="<?php echo $data['action_name']; ?>" /></p>
            <p class="label">上级权限的ID，0：代表顶级权限：<input type="text" name="pid" value="<?php echo $data['pid']; ?>" /></p>
            <input type="submit" class="button" value="确定" />
        </form>
    </div>


<div id="footer">版权所有，侵权必究@2017</div>
</body>
</html>