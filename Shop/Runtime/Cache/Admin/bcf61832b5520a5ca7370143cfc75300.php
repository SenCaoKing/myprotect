<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

    <!--标题-->
    
    <title>管理中心 - 添加新商品</title>


    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    <!-- 其他样式 -->
    
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript">
    UE.getEditor('goods_desc',{
        'initialFrameWidth':'100%',
        'initialFrameHeight':200,
        'maximumWords':200
    });
</script>


</head>
<body>
<h1 style="font-size: 14px;">
    <span><a href="<?php echo U('Index/main');?>" style="color:#9cf;">管理中心</a></span>

    <!--具体操作-->
    
    <span id="search_id"> - 添加新商品</span>


    <div style="clear:both;"></div>
</h1>

<!-- 内容主题 -->

    <div class="tab-div">
        <div id="tabbar-div">
            <p>
                <span class="tab-front" id="general-tab">通用信息</span>
            </p>
        </div>
        <div id="tabbody-div">
            <form method="POST" action="/Admin/Goods/add.html" enctype="multipart/form-data">
                商品名称:<input type="text" name="goods_name" /><br />
                商品价格:<input type="text" name="shop_price" /><br />
                商品logo:<input type="file" name="logo" /><br />
                商品描述:<textarea name="goods_desc" id="goods_desc"></textarea><br />
                是否上架:
                <input type="radio" name="is_on_sale" value="1" checked="checked" />上架
                <input type="radio" name="is_on_sale" value="0" />下架
                <br />
                <input type="submit" value="提交" />
            </form>
        </div>
    </div>


<div id="footer">版权所有，侵权必究@2017</div>
</body>
</html>