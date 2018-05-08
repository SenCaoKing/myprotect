<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--标题-->
    
    <title>管理中心 - 商品列表</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/bootstrap/js/jquery.min.js"></script>
    <!-- 其他样式 -->
    
<style type="text/css">
    td{text-align: center;}
    a{color:#9cf !important}
</style>

</head>
<body>
<h1 style="font-size: 14px;">
    <span><a href="<?php echo U('Index/main');?>" style="color:#9cf;">管理中心</a></span>

    <!--具体操作-->
    
    <span class="action-span"><a href="<?php echo U('add');?>">添加商品</a></span>
    <span id="search_id"> - 商品列表</span>


    <div style="clear:both;"></div>
</h1>

<!-- 内容主题 -->

    <!-- 搜索 -->
    <div class="form-div search_form_div">
        <form method="GET" name="search_form">
            <p>
                商品名称：
                <input type="text" name="goods_name" size="30" value="<?php echo I('get.goods_name');?>" />
            </p>
            <p>
                主分类的id：
                <input type="text" name="cat_id" size="30" value="<?php echo I('get.cat_id');?>" />
            </p>
            <p>
                品牌的id：
                <input type="text" name="brand_id" size="30" value="<?php echo I('get.brand_id');?>" />
            </p>
            <p>
                本店价：
                从 <input id="shop_pricefrom" type="text" name="shop_pricefrom" size="15" value="<?php echo I('get.shop_pricefrom');?>" />
                到 <input id="shop_priceto" type="text" name="shop_priceto" size="15" value="<?php echo I('get.shop_priceto');?>" />
            </p>
            <p>
                是否热卖：
                <input type="radio" value="-1" name="is_hot" <?php if(I('get.is_hot', -1) == -1) echo 'checked="checked"'; ?> />全部
                <input type="radio" value="1" name="is_hot" <?php if(I('get.is_hot', -1) == 1) echo 'checked="checked"'; ?> />是
                <input type="radio" value="0" name="is_hot" <?php if(I('get.is_hot', -1) == 0) echo 'checked="checked"'; ?> />否
            </p>
            <p>
                是否新品：
                <input type="radio" value="-1" name="is_new" <?php if(I('get.is_new', -1) == -1) echo 'checked="checked"'; ?> />全部
                <input type="radio" value="1" name="is_new" <?php if(I('get.is_new', -1) == 1) echo 'checked="checked"'; ?> />是
                <input type="radio" value="0" name="is_new" <?php if(I('get.is_new', -1) == 0) echo 'checked="checked"'; ?> />否
            </p>
            <p>
                是否精品：
                <input type="radio" value="-1" name="is_best" <?php if(I('get.is_best', -1) == -1) echo 'checked="checked"'; ?> />全部
                <input type="radio" value="1" name="is_best" <?php if(I('get.is_best', -1) == 1) echo 'checked="checked"'; ?> />是
                <input type="radio" value="0" name="is_best" <?php if(I('get.is_best', -1) == 0) echo 'checked="checked"'; ?> />否
            </p>
            <p>
                是否上架：1：上架，0：下架：
                <input type="radio" value="-1" name="is_on_sale" <?php if(I('get.is_on_sale', -1) == -1) echo 'checked="checked"'; ?> />全部
                <input type="radio" value="1" name="is_on_sale" <?php if(I('get.is_on_sale', -1) == 1) echo 'checked="checked"'; ?> />上架
                <input type="radio" value="0" name="is_on_sale" <?php if(I('get.is_on_sale', -1) == 0) echo 'checked="checked"'; ?> />下架
            </p>
            <p>
                商品类型id：
                <input type="text" name="type_id" size="30" value="<?php echo I('get.type_id');?>" />
            </p>
            <p>
                添加时间：
                从 <input id="startTime" type="text" name="startTime" size="15" value="<?php echo I('get.startTime');?>" />
                到 <input id="endTime" type="text" name="endTime" size="15" value="<?php echo I('get.endTime');?>" />
            </p>
            <p><input type="submit" value="搜索" class="button" /></p>
        </form>
    </div>
    <!-- 列表 -->
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tr>
                <th>id</th>
                <th>添加时间</th>
                <th>商品名称</th>
                <th>LOGO</th>
                <th>价格</th>
                <th>描述</th>
                <th>是否上架</th>
                <th>是否删除</th>
                <th>操作</th>
            </tr>
            <?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
                    <td><?php echo ($v["id"]); ?></td>
                    <td><?php echo (date("Y-m-d H:i:s",$v["addtime"])); ?></td>
                    <td><?php echo ($v["goods_name"]); ?></td>
                    <td><img src="/PUBLIC/Uploads<?php echo substr($v['sm_logo'],16); ?>" /></td>
                    <td><?php echo ($v["shop_price"]); ?></td>
                    <td><?php echo ($v["goods_desc"]); ?></td>
                    <td><?php if($v["is_on_sale"] == 1): ?>上架<?php else: ?>下架<?php endif; ?></td>
                    <td><?php if($v["is_delete"] == 1): ?>是<?php else: ?>否<?php endif; ?></td>
                    <td>
                    <a href="<?php echo U('edit',array('id'=>$v['id'],'p'=>I('get.p',1)));?>" class="action">修改</a>
                    <a onclick="return confirm('确定要删除吗?')" href="<?php echo U('delete',array('id'=>$v['id'],'p'=>I('get.p',1)));?>" class="action">删除</a>
                    </td>
                </tr><?php endforeach; endif; ?>
            <tr><td colspan="9"><?php echo ($page); ?></td></tr>
        </table>
    </div>


<div id="footer">版权所有，侵权必究@2017</div>
</body>
</html>