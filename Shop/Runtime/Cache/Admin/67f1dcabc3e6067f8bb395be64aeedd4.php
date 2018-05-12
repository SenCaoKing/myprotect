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
                <th>商品名称</th>
                <th>市场价</th>
                <th>本店价</th>
                <th>赠送积分</th>
                <th>赠送经验值</th>
                <th>用积分兑换<br/>需要的积分数</th>
                <th>是否促销</th>
                <th>促销价</th>
                <th>促销开始时间</th>
                <th>促销结束时间</th>
                <th>logo原图</th>
                <th>是否热卖</th>
                <th>是否新品</th>
                <th>是否精品</th>
                <th>是否上架</th>
                <th>seo关键字</th>
                <th>seo描述</th>
                <th>排序数字</th>
                <th>商品描述</th>
                <th width="150">操作</th>
            </tr>
            <?php if(is_array($data)): foreach($data as $key=>$v): ?><tr>
                    <td><?php echo ($v['goods_name']); ?></td>
                    <td><?php echo ($v['market_price']); ?></td>
                    <td><?php echo ($v['shop_price']); ?></td>
                    <td><?php echo ($v['jifen']); ?></td>
                    <td><?php echo ($v['jyz']); ?></td>
                    <td><?php echo ($v['jifen_price']); ?></td>
                    <td><?php echo ($v['is_promote']?'是':'否'); ?></td>
                    <td><?php echo ($v['promote_price']); ?></td>
                    <td><?php echo date('Y-m-d',$v['promote_start_time']); ?></td>
                    <td><?php echo date('Y-m-d',$v['promote_end_time']); ?></td>
                    <td><?php echo showImage($v['logo']);?></td>
                    <td><?php echo ($v['is_hot']?'是':'否'); ?></td>
                    <td><?php echo ($v['is_new']?'是':'否'); ?></td>
                    <td><?php echo ($v['is_best']?'是':'否'); ?></td>
                    <td><?php echo ($v['is_on_sale']?'是':'否'); ?></td>
                    <td><?php echo ($v['seo_keyword']); ?></td>
                    <td><?php echo ($v['seo_description']); ?></td>
                    <td><?php echo ($v['sort_num']); ?></td>
                    <td><?php echo ($v['goods_desc']); ?></td>
                    <td>
                        <a href="<?php echo U('edit',array('id'=>$v['id'],'p'=>I('get.p',1)));?>" title="编辑">编辑</a>
                        <a onclick="return confirm('确定要删除吗?')" href="<?php echo U('delete',array('id'=>$v['id'],'p'=>I('get.p',1)));?>" title="移除">移除</a>
                    </td>
                </tr><?php endforeach; endif; ?>
            <?php if(preg_match('/\d', $page)): ?>
                <tr><td align="right" nowrap="true" colspan="99" height="30"><?php echo $page; ?></td></tr>
            <?php endif; ?>
        </table>
    </div>


<div id="footer">版权所有，侵权必究@2017</div>
</body>
</html>