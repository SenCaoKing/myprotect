<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--标题-->
    
    <title>管理中心 - 管理员列表</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/bootstrap/js/jquery.min.js"></script>
    <!-- 其他样式 -->
    
    <style type="text/css">
        td{text-align: center;}
    </style>

</head>
<body>
<h1 style="font-size: 14px;">
    <span><a href="<?php echo U('Index/main');?>" style="color:#9cf;">管理中心</a></span>

    <!--具体操作-->
    
    <span class="action-span"><a href="<?php echo U('add');?>">添加管理员</a></span>
    <span id="search_id"> - 管理员列表</span>


    <div style="clear:both;"></div>
</h1>

<!-- 内容主题 -->

    <div class="list-div" id="listDiv">
        <table cellspacing="1" cellpadding="3">
            <tr>
                <th width="60">操作</th>
            </tr>
            <tr class="tron">
                <td align="center">
                    <a href="<?php echo U('edit'); ?>" title="编辑" style="color:#9cf;">编辑</a> |
                    <a href="<?php echo U('delete'); ?>" onclick="return confirm('确定要删除吗？');" title="移除" style="color:#9cf;">移除</a>
                </td>
            </tr>
            <tr><td align="right" nowrap="true" colspan="99" height="30"><?php echo '分页'; ?></td></tr>
        </table>
    </div>


<div id="footer">版权所有，侵权必究@2017</div>
</body>
</html>