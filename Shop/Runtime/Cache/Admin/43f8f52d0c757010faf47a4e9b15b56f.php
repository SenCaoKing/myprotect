<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 权限列表 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
<link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
<style type="text/css">
h1{font-size: 14px}
a{color:#9cf !important}
</style>
</head>
<body>
    <div class="list-div" id="listDiv">
            <table cellspacing="1" cellpadding="3">
                <tr>
                    <th>权限名称</th>
                    <th>模块名称</th>
                    <th>控制器名称</th>
                    <th>方法名称</th>
                    <th>上级权限的ID，0：代表顶级权限</th>
                    <th width="60">操作</th>
                </tr>
                <?php foreach($data as $k => $v): ?>
                    <tr class="tron">
                        <td><?php echo str_repeat('-', 8*$v['auth_level']); echo $v['auth_name']; ?></td>
                        <td><?php echo $v['module_name']; ?></td>
                        <td><?php echo $v['controller_name']; ?></td>
                        <td><?php echo $v['action_name']; ?></td>
                        <td><?php echo $v['pid']; ?></td>
                        <td align="center">
                            <a href="<?php echo U('edit?id='.$v['id'].'&p='.I('get.p')); ?>" title="编辑">编辑</a> |
                            <a href="<?php echo U('delete?id='.$v['id'].'&p='.I('get.p')); ?>" onclick="return confirm('确定要删除吗？');" title="移除">移除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
    </div>
</body>
</html>