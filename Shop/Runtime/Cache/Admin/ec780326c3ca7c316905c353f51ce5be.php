<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <!--标题-->
    
    <title>管理中心 - 编辑商品</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="/Public/Admin/Styles/general.css" rel="stylesheet" type="text/css" />
    <link href="/Public/Admin/Styles/main.css" rel="stylesheet" type="text/css" />
    <link href="/Public/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/bootstrap/js/jquery.min.js"></script>
    <!-- 其他样式 -->
    
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/ueditor.all.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/ueditor/lang/zh-cn/zh-cn.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/datepicker/jquery-ui-1.9.2.custom.min.css" />
<script type="text/javascript" charset="utf-8" src="/Public/datepicker/jquery-ui-1.9.2.custom.min.js"></script>
<style type="text/css">
    .content{display:none;}
</style>
<script type="text/javascript">
    UE.getEditor('goods_desc',{
        'initialFrameWidth':'100%',
        'initialFrameHeight':200,
        'maximumWords':200
    });
    $(function(){
        // 时间选择器
        $('#promote_start_time').datepicker({dateFormat:"yy-mm-dd"});
        $('#promote_end_time').datepicker({dateFormat:"yy-mm-dd"});

        // 选项卡切换
        $("#tabbar-div p span").click(function(){
            var index=$(this).index();
            $(this).removeClass('tab-back').addClass('tab-front').siblings().removeClass('tab-front').addClass('tab-back');
            $('.content').eq(index).show().siblings('.content').hide();
        });

        // 下拉框选择
        $('select[name=type_id]').change(function(){
            // 获取选中的类型的id
            var type_id=$(this).val();
            $.get("<?php echo U('ajaxGetAttr');?>",{'type_id':type_id},function(res){
                var json=JSON.parse(res);
                console.log(json);
                if(json==null){
                    $('#attr_container').html('');
                    return;
                }
                var html='';
                for(var i=0;i<json.length;i++){
                    html+='<p>'+json[i].attr_name+': ';
                    // 1.如果属性是可选的，那就有一个+号
                    // 2.如果属性有可选值，那就是一个下拉框
                    // 3.如果属性是唯一的，那就是一个文本框
                    if(json[i].attr_type==1)
                        html+='<a href="javascript:void(0)" onclick="addNew(this)">[+]</a>';
                    if(json[i].attr_option_values==''){ // 是否有可选值
                        html+='<input type="text" name="attr['+json[i].id+'][]" />';
                    }else{
                        var attrs=json[i].attr_option_values.split(',');
                        html+='<select name="attr['+json[i].id+'][]">';
                        html+='<option values="请选择"></option>';
                        for(var j=0;j<attrs.length;j++){
                            html+='<option values="'+attrs[j]+'">'+attrs[j]+'</option>';
                        }
                        html='</select>';
                    }
                    if(json[i].attr_type==1)
                        html+='属性价格：￥<input type="text" name="attr_price['+json[i].id+'][]" />元';
                    html+='</p>';
                }
                $('#attr_container').html(html);
            });
        });

        // 是否促销
        $('#is_promote').click(function(){
            if($(this).is(':checked'))
                $('.promote_price').removeAttr('disabled');
            else $('.promote_price').attr('disabled','disabled');
        });

        // 添加商品图片
        $('#addImg').click(function(){
            $(this).parent().parent().append('<input type="file" name="pics[]">');
        });
    });
    function addNew(a){
        var p=$(a).parent();
        if($(a).html()=='[+]'){
            var newP=p.clone();
            newP.find('a').html('[-]');
            p.after(newP);
        }else{
            p.remove();
        }
    }
    function addCat(btn){
        var sel=$(btn).next();
        var newSel=sel.clone();
        $(btn).parent().append(newSel);
    }
</script>

</head>
<body>
<h1 style="font-size: 14px;">
    <span><a href="<?php echo U('Index/main');?>" style="color:#9cf;">管理中心</a></span>

    <!--具体操作-->
    
    <span class="action-span"><a href="<?php echo U('lst');?>">返回</a></span>
    <span id="search_id"> - 编辑商品</span>


    <div style="clear:both;"></div>
</h1>

<!-- 内容主题 -->

    <div class="tab-div">
        <div id="tabbar-div">
            <p>
                <span class="tab-front" id="general-tab">基本信息</span>
                <span class="tab-back" id="general-tab">商品描述</span>
                <span class="tab-back" id="general-tab">会员价格</span>
                <span class="tab-back" id="general-tab">商品属性</span>
                <span class="tab-back" id="general-tab">商品相册</span>
            </p>
        </div>
        <div id="tabbody-div">
            <form method="POST" action="/Admin/Goods/edit/id/6/p/1.html" style="margin:5px;" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo ($data["id"]); ?>">
                <input type="hidden" name="old_type_id" value="<?php echo ($data["type_id"]); ?>">
                <!-- 基本信息 -->
                <div class="content" style="display:block;">
                    <p>商品名称:<input type="text" name="goods_name" value="<?php echo ($data["goods_name"]); ?>" /></p>
                    <p>主分类：
                        <select name="cat_id">
                            <option value="">选择分类</option>
                            <?php foreach ($catData as $k => $v): if($v['id'] == $data['cat_id']) $select = 'selected="selected"'; else $select = ''; ?>
                                <option <?php echo ($select); ?> value="<?php echo ($v["id"]); ?>"><?php echo str_repeat('-',8*$v['level']).$v['cat_name'];?></option> 
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <p>其他分类：
                        <input type="button" value="添加" class="btn btn-info" onclick="addCat(this)">
                        <?php  foreach ($extCatId as $k1 => $v1): ?>
                                <select name="ext_cat_id[]">
                                    <option value="">选择分类</option>
                                    <?php foreach ($catData as $k => $v): if($v['id'] == $v1['cat_id']) $select = 'selected="selected"'; else $select = ''; ?>
                                        <option <?php echo ($select); ?> value="<?php echo ($v["id"]); ?>"><?php echo str_repeat('-',8*$v['level']).$v['cat_name'];?></option> 
                                    <?php endforeach; ?>
                                </select>
                        <?php endforeach; ?>
                    </p>
                    <p>品牌：
                        <select name="brand_id">
                            <option value="">选择品牌</option>
                            <?php foreach ($brandData as $k => $v): if($v['id'] == $data['brand_id']) $select = 'selected="selected"'; else $select = ''; ?>
                                <option <?php echo ($select); ?> value="<?php echo ($v["id"]); ?>"><?php echo ($v['brand_name']); ?></option> 
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <p>市场价：￥<input type="text" name="market_price" value="<?php echo ($data["market_price"]); ?>" /></p>
                    <p>本店价：￥<input type="text" name="shop_price" value="<?php echo ($data["shop_price"]); ?>" /></p>
                    <p>赠送积分：<input type="text" name="jifen" value="<?php echo ($data["jifen"]); ?>" /></p>
                    <p>赠送经验值：<input type="text" name="jyz" value="<?php echo ($data["jyz"]); ?>" /></p>
                    <p>如果要用积分兑换，需要的积分数：
                        <input type="text" name="jifen_price" value="<?php echo ($data["jifen_price"]); ?>" />
                    </p>
                    <p><input type="checkbox" <?php if($data['is_promote']==1) echo 'checked="checked"'; ?> value="1" name="is_promote" id="is_promote">
                        促销价：<input type="text" <?php if($data['is_promote']==0) echo 'disabled="disabled"'; ?> name="promote_price" class="promote_price" value="<?php echo ($data["promote_price"]); ?>" /></p>
                    <p>促销开始时间：<input <?php if($data['is_promote']==0) echo 'disabled="disabled"'; ?> id="promote_start_time" type="text" name="promote_start_time" class="promote_price" value="<?php if($data['promote_start_time']) echo date('Y-m-d H:i', $data['promote_start_time']); ?>" /></p>
                    <p>促销结束时间：<input <?php if($data['is_promote']==0) echo 'disabled="disabled"'; ?> id="promote_end_time" type="text" name="promote_end_time" class="promote_price" value="<?php if($data['promote_end_time']) echo date('Y-m-d H:i', $data['promote_end_time']); ?>" /></p>
                    <p>logo原图：<?php showImage($data['sm_logo']); ?><br/>
                        <input type="file" name="logo" /></p>
                    <p>是否热卖：
                        <input type="radio" name="is_hot" value="1" <?php if($data['is_hot'] == 1) echo 'checked="checked"'; ?> />是
                        <input type="radio" name="is_hot" value="0" <?php if($data['is_hot'] == 0) echo 'checked="checked"'; ?> />否
                    </p>
                    <p>是否新品：
                        <input type="radio" name="is_new" value="1" <?php if($data['is_new'] == 1) echo 'checked="checked"'; ?> />是
                        <input type="radio" name="is_new" value="0" <?php if($data['is_new'] == 0) echo 'checked="checked"'; ?> />否
                    </p>
                    <p>是否精品：
                        <input type="radio" name="is_best" value="1" <?php if($data['is_best'] == 1) echo 'checked="checked"'; ?> />是
                        <input type="radio" name="is_best" value="0" <?php if($data['is_best'] == 0) echo 'checked="checked"'; ?> />否
                    </p>
                    <p>是否上架：1：上架，0：下架：
                        <input type="radio" name="is_on_sale" value="1" <?php if($data['is_on_sale'] == 1) echo 'checked="checked"'; ?> />上架
                        <input type="radio" name="is_on_sale" value="0" <?php if($data['is_on_sale'] == 0) echo 'checked="checked"'; ?> />下架
                    </p>
                    <p>seo优化[搜索引擎【百度、谷歌等】优化]_关键字：
                        <input type="text" name="seo_keyword" value="<?php echo ($data["seo_keyword"]); ?>" />
                    </p>
                    <p>seo优化[搜索引擎【百度、谷歌等】优化]_描述：
                        <input type="text" name="seo_description" value="<?php echo ($data["seo_description"]); ?>" />
                    </p>
                    <p>排序数字：<input type="text" name="sort_num" value="<?php echo ($data["sort_num"]); ?>" /></p>
                </div>
                <!-- 商品描述 -->
                <div class="content">
                    <p><textarea name="goods_desc" id="goods_desc"><?php echo ($data["goods_desc"]); ?></textarea></p>
                </div>
                <!-- 会员价格 -->
                <div class="content">
                    <p>会员价格(如果没有设置，则按照这个级别的折扣率来计算)</p>
                    <p>
                        <?php  foreach ($mlData as $k => $v): ?>
                        <?php echo ($v["id"]); ?> - <?php echo ($v["level_name"]); ?>(<?php echo $v['rate']/10; ?>折)
                            ￥<input type="text" size="10" name="mp[<?php echo ($v["id"]); ?>]" value="<?php echo $mpData[$v['id']]; ?>" />元<br/>
                        <?php endforeach; ?>
                    </p>
                </div>
                <!-- 商品属性 -->
                <div class="content">
                    <p>商品类型：
                        <select name="type_id">
                            <option value="">选择类型</option>
                            <?php foreach ($typeData as $k => $v): if($v['id'] == $data['type_id']) $select = 'selected="selected"'; else $select = ''; ?>
                                <option <?php echo ($select); ?> value="<?php echo ($v["id"]); ?>"><?php echo ($v["type_name"]); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </p>
                    <div id="attr_container">
                        <?php
 $attrId = array(); ?>
                    </div>
                </div>
                <!-- 商品相册 -->
                <div class="content">
                    <p><input type="button" class="btn btn-info" id="addImg" value="添加商品图片"></p>
                </div>

                <p><input type="submit" class="btn btn-primary" value="确定" /></p>
            </form>
        </div>
    </div>


<div id="footer">版权所有，侵权必究@2017</div>
</body>
</html>