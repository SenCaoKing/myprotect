<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>管理中心 - 编辑商品 </title>
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
<h1>
    <span><a href="<?php echo U('Index/main');?>">管理中心</a></span>
    <span id="search_id"> - 编辑商品 </span>
    <div style="clear:both"></div>
</h1>

<div class="tab-div">
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="general-tab">通用信息</span>
        </p>
    </div>
    <div id="tabbody-div">
            <form method="POST" action="/Admin/Goods/edit/id/3/p/1.html" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo ($data['id']); ?>">
            商品名称:<input type="text" name="goods_name" value="<?php echo ($data["goods_name"]); ?>"/><br />
            商品价格:<input type="text" name="shop_price" value="<?php echo ($data["shop_price"]); ?>" /><br />
            <img src="/PUBLIC/Uploads<?php echo substr($data['sm_logo'],16); ?>" />
            商品logo:<input type="file" name="logo"  /><br />
            商品描述:<textarea name="goods_desc" id="goods_desc"><?php echo ($data["goods_desc"]); ?></textarea><br />
            是否上架:
            <input type="radio" name="is_on_sale" value="1" <?php if($data['is_on_sale']==1) echo 'checked="checked"' ?> />上架
            <input type="radio" name="is_on_sale" value="0" <?php if($data['is_on_sale']==0) echo 'checked="checked"' ?> />下架
            <br />
            <input type="submit" value="提交" />
        </form>
    </div>
</div>

<div id="footer">
共执行 9 个查询，用时 0.025161 秒，Gzip 已禁用，内存占用 3.258 MB<br />
版权所有 &copy; 2005-2012 上海商派网络科技有限公司，并保留所有权利。
</div>
<script type="text/javascript">
    UE.getEditor('goods_desc',{
        'initialFrameWidth':'100%',
        'initialFrameHeight':200,
        'maximumWords':200
    });
</script>
</body>
</html>