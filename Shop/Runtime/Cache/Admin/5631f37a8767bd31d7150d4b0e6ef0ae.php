<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 修改权限 </title>
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
    <div class="main-div">
        <form name="main_form" method="POST" action="/Admin/Auth/edit/id/1/p/1.html" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>" />
            <table cellspacing="1" cellpadding="3" width="100%">
                <tr>
                    <td class="label">上级权限：</td>
                    <td>
                        <select name="parent_id">
                            <option value="0">顶级权限</option>
                                <?php foreach($parentData as $k => $v): ?>
                                    <?php if($v['id'] == $data['id'] || in_array($v['id'], $children)) continue ; ?>
                                    <option <?php if($v['id'] == $data['pid']): ?>selected="selected"<?php endif; ?> value="<?php echo $v['id']; ?>"><?php echo str_repeat('-', 8*$v['auth_level']).$v['auth_name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">权限名称：</td>
                    <td>
                        <input type="text" name="auth_name" value="<?php echo $data['auth_name']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="label">模块名称：</td>
                    <td>
                        <input type="text" name="module_name" value="<?php echo $data['module_name']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="label">控制器名称：</td>
                    <td>
                        <input type="text" name="controller_name" value="<?php echo $data['controller_name']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="label">方法名称：</td>
                    <td>
                        <input type="text" name="action_name" value="<?php echo $data['action_name']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td class="label">上级权限的ID，0：代表顶级权限：</td>
                    <td>
                        <input type="text" name="pid" value="<?php echo $data['pid']; ?>" />
                    </td>
                </tr>
                <tr>
                    <td colspan="99" align="center">
                        <input type="submit" class="button" value="确定" />
                        <input type="reset" class="button" value="重置" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>